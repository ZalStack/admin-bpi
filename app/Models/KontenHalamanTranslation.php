<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontenHalamanTranslation extends Model
{
    protected $table = 'konten_halaman_translations';

    protected $fillable = [
        'konten_halaman_id',
        'bahasa',
        'nilai',
    ];
}
