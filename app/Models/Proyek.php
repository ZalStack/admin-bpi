<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function galeri()
    {
        return $this->hasMany(ProyekGaleri::class, 'proyek_id');
    }
}
