<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaTranslation extends Model
{
    use HasFactory;

    protected $table = 'berita_translations';

    protected $fillable = [
        'berita_id',
        'bahasa',
        'judul',
        'ringkasan',
        'isi',
        'kategori',
        'kutipan',
    ];
}
