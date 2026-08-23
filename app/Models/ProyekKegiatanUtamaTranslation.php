<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekKegiatanUtamaTranslation extends Model
{
    use HasFactory;

    protected $table = 'proyek_kegiatan_utama_translations';

    protected $fillable = [
        'proyek_kegiatan_utama_id',
        'bahasa',
        'deskripsi',
    ];
}
