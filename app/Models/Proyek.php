<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Proyek extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'proyek';

    protected $fillable = [
        'slug',
        'gambar_utama',
        'tahun',
        'status',
        'urutan',
    ];

    protected $appends = [
        'gambar_utama_url',
    ];

    public function getGambarUtamaUrlAttribute(): ?string
    {
        return $this->gambar_utama ? asset('storage/proyek/' . $this->gambar_utama) : null;
    }

    public function galeri()
    {
        return $this->hasMany(ProyekGaleri::class, 'proyek_id');
    }

    public function mitra(): BelongsToMany
    {
        return $this->belongsToMany(Mitra::class, 'proyek_mitra', 'proyek_id', 'mitra_id');
    }
}
