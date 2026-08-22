<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerHalaman extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'banner_halaman';

    protected $fillable = [
        'halaman',
        'gambar',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
