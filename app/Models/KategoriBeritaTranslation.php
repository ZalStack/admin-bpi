<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBeritaTranslation extends Model
{
    use HasFactory;

    protected $table = 'kategori_berita_translations';

    protected $fillable = [
        'kategori_berita_id',
        'bahasa',
        'judul',
        'slug',
    ];
}
