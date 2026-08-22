<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekGaleriTranslation extends Model
{
    use HasFactory;

    protected $table = 'proyek_galeri_translations';

    protected $fillable = [
        'proyek_galeri_id',
        'bahasa',
        'judul',
        'deskripsi',
    ];
}
