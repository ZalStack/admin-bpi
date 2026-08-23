<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekDampakCapaianTranslation extends Model
{
    use HasFactory;

    protected $table = 'proyek_dampak_capaian_translations';

    protected $fillable = [
        'proyek_dampak_capaian_id',
        'bahasa',
        'deskripsi',
    ];
}
