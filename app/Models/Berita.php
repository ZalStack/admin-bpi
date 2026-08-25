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

    protected $appends = [
        'gambar_utama_url',
    ];

    public function getGambarUtamaUrlAttribute(): ?string
    {
        return $this->gambar_utama ? asset('storage/berita/' . $this->gambar_utama) : null;
    }

    public function galeri()
    {
        return $this->hasMany(BeritaGaleri::class, 'berita_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'berita_tag', 'berita_id', 'tag_id')->withPivot('id');
    }
}
