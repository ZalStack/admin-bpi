<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontakDetailTranslation extends Model
{
    protected $table = 'kontak_detail_translations';

    protected $fillable = [
        'kontak_detail_id',
        'bahasa',
        'judul',
        'deskripsi',
        'nilai',
    ];
}
