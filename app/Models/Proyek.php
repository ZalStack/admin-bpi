<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'proyek';

    protected $fillable = [
        'slug',
        'judul_id',
        'judul_en',
        'kategori_id',
        'kategori_en',
        'deskripsi_singkat_id',
        'deskripsi_singkat_en',
        'deskripsi_id',
        'deskripsi_en',
        'gambar_utama',
        'lokasi_id',
        'lokasi_en',
        'tahun',
        'tujuan_id',
        'tujuan_en',
        'dampak_id',
        'dampak_en',
        'kegiatan_utama_id',
        'kegiatan_utama_en',
        'capaian_id',
        'capaian_en',
        'timeline_id',
        'timeline_en',
        'status',
        'urutan'
    ];

    public function galeri()
    {
        return $this->hasMany(ProyekGaleri::class, 'proyek_id');
    }
}
