<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMitra extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'kategori_mitra';

    protected $fillable = [
        'slug',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
