<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaGaleri extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'berita_galeri';

    protected $fillable = [
        'berita_id',
        'gambar',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $appends = [
        'gambar_url',
    ];

    public function getGambarUrlAttribute(): ?string
    {
        return $this->gambar ? asset('storage/berita/galeri/' . $this->gambar) : null;
    }

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'berita_id');
    }
}
