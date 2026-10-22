<?php

namespace App\Console\Commands;

use App\Models\BannerHalaman;
use App\Models\Beranda;
use App\Models\Berita;
use App\Models\BeritaGaleri;
use App\Models\Mitra;
use App\Models\MitraIntro;
use App\Models\Program;
use App\Models\ProgramRoadmap;
use App\Models\Proyek;
use App\Models\ProyekGaleri;
use App\Models\Qrcode;
use App\Models\Stakeholder;
use App\Models\StrukturOrganisasi;
use App\Models\Tentang;
use App\Support\ImageOptimizer;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OptimizeImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:optimize
        {--dry-run : Tampilkan perkiraan hasil tanpa mengubah file maupun database}
        {--rename : Ganti juga nama file lama yang masih acak menjadi nama yang terbaca (tanpa kompres ulang)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kompres gambar yang sudah terupload ke WebP berukuran kecil dan perbarui referensinya di database';

    /**
     * [model, field, folder storage, sisi terpanjang maksimal].
     * Ukuran mengikuti $imageMaxSize di controller masing-masing.
     */
    private const TARGETS = [
        [BannerHalaman::class, 'gambar', 'banners', 1920],
        [Beranda::class, 'gambar', 'beranda', 1920],
        [Berita::class, 'gambar_utama', 'berita', 1920],
        [BeritaGaleri::class, 'gambar', 'berita/galeri', 1920],
        [Mitra::class, 'logo', 'mitra', 600],
        [MitraIntro::class, 'gambar', 'mitra', 1920],
        [Program::class, 'gambar', 'program', 1920],
        [ProgramRoadmap::class, 'gambar', 'program', 1920],
        [Proyek::class, 'gambar_utama', 'proyek', 1920],
        [ProyekGaleri::class, 'gambar', 'proyek/galeri', 1920],
        [Qrcode::class, 'logo', 'qrcode', 512],
        [Stakeholder::class, 'gambar', 'stakeholder', 800],
        [StrukturOrganisasi::class, 'foto', 'struktur', 1000],
        [Tentang::class, 'gambar', 'tentang', 1920],
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $disk = Storage::disk('public');
        $dryRun = (bool) $this->option('dry-run');
        $rename = (bool) $this->option('rename');
        $stats = ['converted' => 0, 'renamed' => 0, 'skipped' => 0, 'missing' => 0, 'before' => 0, 'after' => 0];

        $targets = collect(self::TARGETS)
            ->map(fn (array $t) => [$t[0], (new $t[0])->getTable(), $t[1], $t[2], $t[3]])
            ->filter(fn (array $t) => Schema::hasColumn($t[1], $t[2]));

        // Dikelompokkan per folder: satu file bisa dipakai beberapa record/model
        // (cth Mitra & MitraIntro sama-sama di folder mitra).
        foreach ($targets->groupBy(3) as $folder => $group) {
            $files = [];

            foreach ($group as [, $table, $field, , $maxSize]) {
                DB::table($table)->whereNotNull($field)->where($field, '!=', '')
                    ->distinct()->pluck($field)
                    ->each(function (string $name) use (&$files, $maxSize) {
                        $files[$name] = min($files[$name] ?? PHP_INT_MAX, $maxSize);
                    });
            }

            foreach ($files as $name => $maxSize) {
                $path = $folder.'/'.$name;

                if (! $disk->exists($path)) {
                    $stats['missing']++;
                    $this->warn("  hilang   {$path}");

                    continue;
                }

                $absolute = $disk->path($path);
                $before = $disk->size($path);

                // WebP yang ukurannya sudah sesuai tidak di-encode ulang (hindari penurunan kualitas berulang).
                $dimensions = @getimagesize($absolute);
                $alreadyFine = str_ends_with(strtolower($name), '.webp')
                    && $dimensions && max($dimensions[0], $dimensions[1]) <= $maxSize;

                $webp = $alreadyFine ? null : ImageOptimizer::toWebp($absolute, $maxSize);

                if ($webp === null) {
                    if (! $rename || ! $this->isRandomName($name)) {
                        $stats['skipped']++;
                        $this->line("  lewati   {$path} (".$this->size($before).')');

                        continue;
                    }

                    // --rename: hanya ganti nama, isi file tidak diubah.
                    $newName = ImageOptimizer::filename($folder, $this->label($group, $name), pathinfo($name, PATHINFO_EXTENSION));
                    $stats['renamed']++;
                    $this->info("  rename   {$path} -> {$newName}");

                    if (! $dryRun) {
                        $disk->copy($path, $folder.'/'.$newName);
                        $this->replaceReferences($group, $path, $name, $newName);
                    }

                    continue;
                }

                $newName = ImageOptimizer::filename($folder, $this->label($group, $name), 'webp');
                $after = strlen($webp);
                $stats['converted']++;
                $stats['before'] += $before;
                $stats['after'] += $after;
                $this->info("  kompres  {$path} -> {$newName}: ".$this->size($before).' -> '.$this->size($after));

                if (! $dryRun) {
                    $disk->put($folder.'/'.$newName, $webp);
                    $this->replaceReferences($group, $path, $name, $newName);
                }
            }
        }

        $this->newLine();
        $this->info(($dryRun ? '[dry-run] ' : '')."Dikompres: {$stats['converted']}, diganti nama: {$stats['renamed']}, dilewati: {$stats['skipped']}, file hilang: {$stats['missing']}");

        if ($stats['converted'] > 0) {
            $this->info('Total ukuran: '.$this->size($stats['before']).' -> '.$this->size($stats['after']));
        }

        return self::SUCCESS;
    }

    /**
     * Arahkan semua record ke file baru, baru hapus file lama.
     * Bila terhenti di tengah, paling buruk tersisa file yatim; link tidak pernah rusak.
     */
    private function replaceReferences(Collection $group, string $oldPath, string $oldName, string $newName): void
    {
        DB::transaction(function () use ($group, $oldName, $newName) {
            foreach ($group as [, $table, $field]) {
                DB::table($table)->where($field, $oldName)->update([$field => $newName]);
            }
        });

        Storage::disk('public')->delete($oldPath);
    }

    /**
     * Label nama file: judul/nama record pertama yang memakai file ini,
     * lalu nama file lama bila masih terbaca, lalu nama modulnya.
     */
    private function label(Collection $group, string $name): string
    {
        foreach ($group as [$model, , $field]) {
            $record = $model::query()->where($field, $name)->first();

            if (! $record) {
                continue;
            }

            $label = method_exists($record, 'translateField')
                ? ($record->translateField('judul') ?: $record->translateField('nama'))
                : '';
            $label = $label ?: ($record->getAttribute('judul') ?: $record->getAttribute('nama'));

            if (is_string($label) && trim($label) !== '') {
                return $label;
            }

            if ($this->isRandomName($name)) {
                return Str::kebab(class_basename($model));
            }
        }

        return pathinfo($name, PATHINFO_FILENAME);
    }

    /**
     * Nama acak 40 karakter dari skema penamaan lama (hashName / Str::random(40)).
     */
    private function isRandomName(string $name): bool
    {
        return (bool) preg_match('/^[A-Za-z0-9]{40}$/', pathinfo($name, PATHINFO_FILENAME));
    }

    private function size(int $bytes): string
    {
        return $bytes >= 1024 * 1024
            ? round($bytes / 1024 / 1024, 2).' MB'
            : round($bytes / 1024, 1).' KB';
    }
}
