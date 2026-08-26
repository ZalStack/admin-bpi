<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Bahasa extends Model
{
    use HasFactory;

    protected $table = 'bahasa';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'kode',
        'nama',
        'aktif',
        'is_default',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'is_default' => 'boolean',
    ];

    public static function defaultKode(): string
    {
        return static::query()->where('is_default', true)->value('kode')
            ?? config('app.fallback_locale', 'id');
    }

    /**
     * Get default language code with caching (1 hour TTL).
     * Use this instead of defaultKode() for high-frequency calls.
     */
    public static function defaultKodeCached(): string
    {
        return Cache::remember('bahasa_default_kode', 3600, function () {
            return static::query()->where('is_default', true)->value('kode')
                ?? config('app.fallback_locale', 'id');
        });
    }

    public static function activeKodes()
    {
        return static::query()
            ->where('aktif', true)
            ->orderByDesc('is_default')
            ->orderBy('nama')
            ->pluck('kode');
    }

    /**
     * Get active language codes with caching (1 hour TTL).
     */
    public static function activeKodesCached()
    {
        return Cache::remember('bahasa_active_kodes', 3600, function () {
            return static::query()
                ->where('aktif', true)
                ->orderByDesc('is_default')
                ->orderBy('nama')
                ->pluck('kode');
        });
    }

    public static function activeLanguages()
    {
        return static::query()
            ->where('aktif', true)
            ->orderByDesc('is_default')
            ->orderBy('nama')
            ->get();
    }

    /**
     * Get active languages with caching (1 hour TTL).
     */
    public static function activeLanguagesCached()
    {
        return Cache::remember('bahasa_active_languages', 3600, function () {
            return static::query()
                ->where('aktif', true)
                ->orderByDesc('is_default')
                ->orderBy('nama')
                ->get();
        });
    }

    /**
     * Check if a language code is valid and active with caching (1 hour TTL).
     */
    public static function isValidKodeCached(string $kode): bool
    {
        $validKodes = static::activeKodesCached();

        return $validKodes->contains($kode);
    }

    /**
     * Clear all Bahasa caches. Call this when bahasa data is modified.
     */
    public static function clearCache(): void
    {
        Cache::forget('bahasa_default_kode');
        Cache::forget('bahasa_active_kodes');
        Cache::forget('bahasa_active_languages');
    }
}
