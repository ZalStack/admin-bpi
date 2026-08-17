<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    use HasFactory;

    protected $table = 'tentang';

    protected $fillable = [
        'section',
        'judul_id',
        'judul_en',
        'subjudul_id',
        'subjudul_en',
        'deskripsi_id',
        'deskripsi_en',
        'gambar',
        'icon',
        'urutan',
        'status'
    ];
}
