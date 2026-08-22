<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaGaleriTranslation extends Model
{
    use HasFactory;

    protected $table = 'berita_galeri_translations';

    protected $fillable = [
        'berita_galeri_id',
        'bahasa',
        'caption',
    ];
}
