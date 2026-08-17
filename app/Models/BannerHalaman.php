<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerHalaman extends Model
{
    use HasFactory;

    protected $table = 'banner_halaman';

    protected $fillable = [
        'halaman',
        'judul_id',
        'judul_en',
        'deskripsi_id',
        'deskripsi_en',
        'gambar',
        'status'
    ];
}
