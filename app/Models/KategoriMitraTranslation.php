<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriMitraTranslation extends Model
{
    protected $table = 'kategori_mitra_translations';

    protected $fillable = [
        'kategori_mitra_id',
        'bahasa',
        'nama',
    ];
}
