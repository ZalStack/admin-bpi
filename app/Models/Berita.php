<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'slug',
        'judul_id',
        'judul_en',
        'ringkasan_id',
        'ringkasan_en',
        'isi_id',
        'isi_en',
        'gambar_utama',
        'kategori_id',
        'kategori_en',
        'penulis',
        'tanggal_publikasi',
        'kutipan_id',
        'kutipan_en',
        'status'
    ];

    public function galeri()
    {
        return $this->hasMany(BeritaGaleri::class, 'berita_id');
    }
}
