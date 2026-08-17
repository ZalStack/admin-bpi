<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $table = 'mitra';

    protected $fillable = [
        'nama_id',
        'nama_en',
        'kategori_id',
        'kategori_en',
        'deskripsi_id',
        'deskripsi_en',
        'logo',
        'website',
        'alamat_id',
        'alamat_en',
        'urutan',
        'status'
    ];
}
