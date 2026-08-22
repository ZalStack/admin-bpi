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
     */
    public function storeTranslations(array $translations): void
    {
        foreach ($translations as $kode => $fields) {
            if (! is_array($fields) || $fields === []) {
                continue;
            }

            $this->translations()->updateOrCreate(
                ['bahasa' => $kode],
                $fields
            );
        }
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
