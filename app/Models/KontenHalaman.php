<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class KontenHalaman extends Model
{
    use HasTranslations;

    protected $table = 'konten_halaman';

    protected $fillable = [
        'halaman',
        'kunci',
        'grup',
        'label',
        'tipe',
        'urutan',
    ];
}
