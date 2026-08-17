<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaGaleri extends Model
{
    use HasFactory;

    protected $table = 'berita_galeri';

    protected $fillable = [
        'berita_id',
        'gambar',
        'caption_id',
        'caption_en',
        'urutan',
        'status'
    ];

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'berita_id');
    }
}
