<?php

namespace App\Traits;

use App\Models\Bahasa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasTranslations
{
    public function translations(): HasMany
    {
        return $this->hasMany(static::class.'Translation');
    }

    /**
     * Simpan translations dari payload keyed per bahasa.
     * Format: ['id' => ['judul' => '...'], 'en' => ['judul' => '...']]
     * Bahasa baru cukup ditambahkan sebagai data, tanpa perubahan schema.
     * Kolom kunci (id, bahasa, foreign key) dari payload diabaikan agar
     * terjemahan tidak bisa dipindahkan ke record atau bahasa lain.
     */
    public function storeTranslations(array $translations): void
    {
        $protected = array_flip(['id', 'bahasa', $this->translations()->getForeignKeyName()]);

        $translations = $this->isiDariBahasaDefault($translations);

        foreach ($translations as $kode => $fields) {
            if (! is_array($fields)) {
                continue;
            }

            $fields = array_diff_key($fields, $protected);

            if ($fields === []) {
                continue;
            }

            $this->translations()->updateOrCreate(
                ['bahasa' => $kode],
                $fields
            );
        }
    }

    /**
     * Field bahasa non-default yang dikosongkan diisi salinan teks bahasa default,
     * agar website tetap menampilkan teks (bahasa default) dan kolom NOT NULL tidak gagal.
     * Sumbernya isian bahasa default di payload, atau yang sudah tersimpan jika tidak dikirim.
     * Model bisa mematikannya dengan property $salinDariBahasaDefault = false
     * (cth. KontenHalaman: kosong berarti pakai teks bawaan website).
     */
    protected function isiDariBahasaDefault(array $translations): array
    {
        if (property_exists($this, 'salinDariBahasaDefault') && ! $this->salinDariBahasaDefault) {
            return $translations;
        }

        $tersimpan = $this->exists
            ? ($this->translations()->where('bahasa', Bahasa::defaultKode())->first()?->toArray() ?? [])
            : [];

        return static::lengkapiDariBahasaDefault($translations, $tersimpan);
    }

    /**
     * Isi field bahasa non-default yang kosong dengan isian bahasa default.
     * Field berupa daftar (cth. tujuan proyek, poin roadmap) dianggap kosong
     * jika tidak ada satu pun isian selain ikon; daftar itu lalu disalin utuh.
     * Hanya field yang dikirim untuk bahasa tersebut yang diisi.
     */
    public static function lengkapiDariBahasaDefault(array $translations, array $tersimpanDefault = []): array
    {
        $default = Bahasa::defaultKode();
        $sumber = array_merge($tersimpanDefault, (array) ($translations[$default] ?? []));

        foreach ($translations as $kode => $fields) {
            if ($kode === $default || ! is_array($fields)) {
                continue;
            }

            foreach ($fields as $field => $value) {
                $pengganti = $sumber[$field] ?? null;

                $kosong = is_array($value) ? ! static::daftarTerisi($value) : static::teksKosong($value);
                $adaPengganti = is_array($pengganti) ? static::daftarTerisi($pengganti) : (is_string($pengganti) && ! static::teksKosong($pengganti));

                if ($kosong && $adaPengganti) {
                    $translations[$kode][$field] = $pengganti;
                }
            }
        }

        return $translations;
    }

    public static function teksKosong(mixed $value): bool
    {
        return $value === null || (is_string($value) && trim($value) === '');
    }

    protected static function daftarTerisi(array $items): bool
    {
        foreach ($items as $item) {
            foreach ((array) $item as $key => $value) {
                if ($key !== 'icon' && is_scalar($value) && ! static::teksKosong((string) $value)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Ambil terjemahan satu bahasa dengan fallback:
     * bahasa diminta -> bahasa default -> terjemahan pertama yang tersedia.
     */
    public function translate(?string $kode = null): array
    {
        $rows = $this->getRelationValue('translations');

        if ($rows instanceof Collection && $rows->isEmpty()) {
            return [];
        }

        $default = Bahasa::defaultKode();
        $target = $kode ?: $default;

        $row = $rows->firstWhere('bahasa', $target)
            ?? $rows->firstWhere('bahasa', $default)
            ?? $rows->first();

        return $row ? $row->toArray() : [];
    }

    public function translateField(string $field, ?string $kode = null): string
    {
        return (string) ($this->translate($kode)[$field] ?? '');
    }

    /**
     * Ambil baris translation EKSAK untuk satu bahasa (tanpa fallback).
     * Berguna untuk form edit agar bahasa yang belum diterjemahkan tampil kosong.
     */
    public function translationFor(?string $kode = null): ?Model
    {
        return $this->getRelationValue('translations')
            ->firstWhere('bahasa', $kode ?: Bahasa::defaultKode());
    }

    public function scopeWithLocale(Builder $query, ?string $kode = null): Builder
    {
        return $query->with(['translations' => function (HasMany $q) use ($kode) {
            if ($kode) {
                $q->where('bahasa', $kode);
            }
        }]);
    }
}
