<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitraIntroTranslation extends Model
{
    protected $table = 'mitra_intro_translations';

    protected $fillable = [
        'mitra_intro_id',
        'bahasa',
        'judul',
        'subjudul',
        'deskripsi',
    ];
}
