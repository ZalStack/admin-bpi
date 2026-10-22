<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use RuntimeException;

class Shortlink extends Model
{
    protected $table = 'shortlink';

    /** Huruf kecil & angka tanpa karakter yang mudah tertukar (0/o, 1/l/i). */
    protected const KODE_ALPHABET = 'abcdefghjkmnpqrstuvwxyz23456789';

    public const KODE_PATTERN = '/^[a-z0-9]+(?:-[a-z0-9]+)*$/';

    protected $fillable = [
        'kode',
        'url_tujuan',
        'judul',
        'status',
        'created_by',
    ];

    protected $casts = [
        'status' => 'boolean',
        'jumlah_klik' => 'integer',
        'terakhir_diklik_at' => 'datetime',
    ];

    public function qrcodes(): HasMany
    {
        return $this->hasMany(Qrcode::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function baseUrl(): string
    {
        return rtrim((string) config('shortlink.base_url'), '/');
    }

    public function getShortUrlAttribute(): string
    {
        return static::baseUrl().'/'.$this->kode;
    }

    public static function normalizeKode(?string $kode): string
    {
        return trim(Str::lower(trim((string) $kode)), '/');
    }

    public static function isReserved(string $kode): bool
    {
        return in_array($kode, (array) config('shortlink.reserved', []), true);
    }

    /**
     * Kode acak unik, dipakai saat admin mengosongkan kode.
     */
    public static function generateKode(): string
    {
        $length = (int) config('shortlink.kode_length', 6);
        $max = strlen(self::KODE_ALPHABET) - 1;

        for ($attempt = 0; $attempt < 10; $attempt++) {
            $kode = '';
            for ($i = 0; $i < $length; $i++) {
                $kode .= self::KODE_ALPHABET[random_int(0, $max)];
            }

            if (! static::isReserved($kode) && ! static::query()->where('kode', $kode)->exists()) {
                return $kode;
            }
        }

        throw new RuntimeException('Failed to generate a unique shortlink code.');
    }
}
