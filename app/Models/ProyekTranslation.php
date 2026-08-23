<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekTranslation extends Model
{
    use HasFactory;

    protected $table = 'proyek_translations';

    protected $fillable = [
        'proyek_id',
        'bahasa',
        'judul',
        'kategori',
        'deskripsi_singkat',
        'deskripsi',
        'lokasi',
        'icon',
        'ruang_lingkup',
        'status_proyek',
        'timeline',
    ];
}
