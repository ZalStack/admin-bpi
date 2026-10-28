<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class KontenHalaman extends Model
{
    use HasTranslations;

    protected $table = 'konten_halaman';

    /** Kolom kosong = website memakai teks bawaannya, jadi jangan disalin dari bahasa default. */
    protected bool $salinDariBahasaDefault = false;

    protected $fillable = [
        'halaman',
        'kunci',
        'grup',
        'label',
        'tipe',
        'urutan',
    ];
}
