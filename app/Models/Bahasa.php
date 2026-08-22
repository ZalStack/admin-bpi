<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function activeKodes()
    {
        return static::query()
            ->where('aktif', true)
            ->orderByDesc('is_default')
            ->orderBy('nama')
            ->pluck('kode');
    }

    public static function activeLanguages()
    {
        return static::query()
            ->where('aktif', true)
            ->orderByDesc('is_default')
            ->orderBy('nama')
            ->get();
    }
}
