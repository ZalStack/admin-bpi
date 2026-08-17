<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beranda extends Model
{
    use HasFactory;

    protected $table = 'beranda';

    protected $fillable = [ 
        'section',
        'judul_id',
        'judul_en',
        'deskripsi_id',
        'deskripsi_en',
        'gambar',
        'icon',
        'urutan',
        'status'
    ];
}
