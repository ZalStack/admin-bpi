<?php

namespace App\Support;

use App\Models\Bahasa;
use GdImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

/**
 * Kompres gambar upload: perkecil sampai sisi terpanjang <= $maxSize
 * lalu simpan sebagai WebP. Transparansi PNG/GIF dipertahankan dan
 * orientasi EXIF foto kamera diterapkan sebelum metadata dibuang.
 *
 * Jika gambar tidak bisa/tidak layak diproses (format lain, GIF animasi,
 * file rusak, memori kurang, atau hasil WebP tidak lebih kecil), file
 * asli yang disimpan sehingga upload tidak pernah gagal karena kompresi.
 */
class ImageOptimizer
{
    public const DEFAULT_MAX_SIZE = 1920;

    public const QUALITY = 80;

    /**
     * Simpan file upload ke folder $dir pada disk, return nama filenya.
     * Nama file = slug $label + kode acak pendek (lihat filename()); ekstensi
     * dari klien tidak dipakai.
     */
    public static function store(UploadedFile $file, string $dir, int $maxSize = self::DEFAULT_MAX_SIZE, ?string $label = null, string $disk = 'public'): string
    {
        $label ??= pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $webp = static::toWebp($file->getRealPath(), $maxSize);

        if ($webp === null) {
            // Ekstensi ditebak dari isi file (MIME), bukan dari nama file klien.
            $name = static::filename($dir, $label, $file->guessExtension() ?: 'bin', $disk);

            return basename($file->storeAs($dir, $name, $disk));
        }

        $name = static::filename($dir, $label, 'webp', $disk);
        Storage::disk($disk)->put($dir.'/'.$name, $webp);

        return $name;
    }

    /**
     * Nama file yang mudah dikenali namun tetap unik & aman,
     * cth "Partner A" -> "partner-a-x7k2p9.webp".
     */
    public static function filename(string $dir, ?string $label, string $extension, string $disk = 'public'): string
    {
        $slug = Str::slug((string) $label) ?: 'gambar';

        // Judul panjang dipotong di batas kata, maks 60 karakter.
        if (strlen($slug) > 60) {
            $cut = substr($slug, 0, 61);
            $slug = str_contains($cut, '-') ? Str::beforeLast($cut, '-') : substr($slug, 0, 60);
        }

        do {
            $name = $slug.'-'.Str::lower(Str::random(6)).'.'.$extension;
        } while (Storage::disk($disk)->exists($dir.'/'.$name));

        return $name;
    }

    /**
     * Label nama file dari isian form: judul/nama pada bahasa default,
     * bahasa lain, lalu field netral. Null = pakai nama file asli.
     */
    public static function labelFromRequest(Request $request): ?string
    {
        $translations = (array) $request->input('translations', []);
        $default = (array) ($translations[Bahasa::defaultKode()] ?? []);
        $candidates = [$default, ...array_values(array_filter($translations, 'is_array')), $request->all()];

        foreach ($candidates as $values) {
            foreach (['judul', 'nama'] as $field) {
                if (is_string($values[$field] ?? null) && trim($values[$field]) !== '') {
                    return $values[$field];
                }
            }
        }

        return null;
    }

    /**
     * Encode file gambar menjadi WebP yang sudah diperkecil.
     * Null berarti file asli sebaiknya dipakai apa adanya.
     */
    public static function toWebp(string $path, int $maxSize = self::DEFAULT_MAX_SIZE): ?string
    {
        if (! function_exists('imagewebp')) {
            return null;
        }

        $info = @getimagesize($path);
        if (! $info) {
            return null;
        }

        [$width, $height, $type] = $info;

        if (! in_array($type, [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP], true)) {
            return null;
        }

        // GD hanya membaca frame pertama; animasi dibiarkan utuh.
        if ($type === IMAGETYPE_GIF && static::isAnimatedGif($path)) {
            return null;
        }

        // Sumber + hasil rotasi EXIF + kanvas tujuan, ~5 byte per piksel.
        $scale = min(1, $maxSize / max($width, $height, 1));
        $needed = (int) ((2 * $width * $height + $width * $height * $scale * $scale) * 5);

        if (! static::ensureMemory($needed)) {
            return null;
        }

        try {
            $image = match ($type) {
                IMAGETYPE_JPEG => @imagecreatefromjpeg($path),
                IMAGETYPE_PNG => @imagecreatefrompng($path),
                IMAGETYPE_GIF => @imagecreatefromgif($path),
                IMAGETYPE_WEBP => @imagecreatefromwebp($path), // WebP animasi gagal di sini -> file asli
            };

            if (! $image) {
                return null;
            }

            if ($type === IMAGETYPE_JPEG) {
                $image = static::applyExifOrientation($image, $path);
            }

            if (! imageistruecolor($image)) {
                imagepalettetotruecolor($image);
            }

            $resized = static::resize($image, $maxSize);
            $webp = static::encode($resized ?? $image);
        } catch (Throwable) {
            return null;
        }

        if ($webp === null) {
            return null;
        }

        // Tanpa resize dan hasilnya tidak lebih kecil: file asli sudah optimal.
        if ($resized === null && strlen($webp) >= (int) @filesize($path)) {
            return null;
        }

        return $webp;
    }

    /**
     * Perkecil proporsional bila sisi terpanjang melebihi $maxSize.
     * Null berarti ukuran sudah sesuai.
     */
    protected static function resize(GdImage $image, int $maxSize): ?GdImage
    {
        $width = imagesx($image);
        $height = imagesy($image);

        if (max($width, $height) <= $maxSize) {
            imagesavealpha($image, true);

            return null;
        }

        $scale = $maxSize / max($width, $height);
        $newWidth = max(1, (int) round($width * $scale));
        $newHeight = max(1, (int) round($height * $scale));

        $canvas = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);
        imagefill($canvas, 0, 0, imagecolorallocatealpha($canvas, 0, 0, 0, 127));
        imagecopyresampled($canvas, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        return $canvas;
    }

    protected static function encode(GdImage $image): ?string
    {
        ob_start();

        try {
            $ok = imagewebp($image, null, static::QUALITY);
        } finally {
            $data = ob_get_clean();
        }

        return $ok && is_string($data) && $data !== '' ? $data : null;
    }

    /**
     * Foto kamera/HP sering disimpan miring + tag Orientation.
     * WebP dari GD tidak membawa EXIF, jadi rotasinya diterapkan ke piksel.
     */
    protected static function applyExifOrientation(GdImage $image, string $path): GdImage
    {
        if (! function_exists('exif_read_data')) {
            return $image;
        }

        $exif = @exif_read_data($path);
        $orientation = (int) ($exif['Orientation'] ?? 1);

        $rotated = match ($orientation) {
            3 => imagerotate($image, 180, 0),
            6 => imagerotate($image, -90, 0),
            8 => imagerotate($image, 90, 0),
            default => false,
        };

        return $rotated ?: $image;
    }

    protected static function isAnimatedGif(string $path): bool
    {
        $contents = @file_get_contents($path);

        // Lebih dari satu Graphic Control Extension yang diikuti frame = animasi.
        return $contents !== false
            && preg_match_all('#\x21\xF9\x04.{4}\x00[\x2C\x21]#s', $contents) > 1;
    }

    /**
     * Pastikan sisa memory_limit cukup untuk decode gambar; naikkan bila perlu.
     */
    protected static function ensureMemory(int $bytes): bool
    {
        $limit = static::toBytes((string) ini_get('memory_limit'));

        if ($limit < 0) {
            return true;
        }

        $required = memory_get_usage() + $bytes + 16 * 1024 * 1024;

        if ($required <= $limit) {
            return true;
        }

        return @ini_set('memory_limit', (string) $required) !== false;
    }

    protected static function toBytes(string $value): int
    {
        $value = trim($value);

        if ($value === '' || $value === '-1') {
            return -1;
        }

        $number = (int) $value;

        return match (strtolower(substr($value, -1))) {
            'g' => $number * 1024 ** 3,
            'm' => $number * 1024 ** 2,
            'k' => $number * 1024,
            default => $number,
        };
    }
}
