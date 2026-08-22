<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'berita';

    protected $fillable = [
        'slug',
        'gambar_utama',
        'penulis',
        'tanggal_publikasi',
        'status',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'date:Y-m-d',
    ];

    public function galeri()
    {
        return $this->hasMany(BeritaGaleri::class, 'berita_id');
    }
}
