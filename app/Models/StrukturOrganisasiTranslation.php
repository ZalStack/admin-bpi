<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasiTranslation extends Model
{
    use HasFactory;

    protected $table = 'struktur_organisasi_translations';

    protected $fillable = [
        'struktur_organisasi_id',
        'bahasa',
        'jabatan',
        'deskripsi',
    ];
}
