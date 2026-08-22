<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerHalamanTranslation extends Model
{
    use HasFactory;

    protected $table = 'banner_halaman_translations';

    protected $fillable = [
        'banner_halaman_id',
        'bahasa',
        'judul',
        'deskripsi',
    ];
}
