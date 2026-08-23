<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekTujuanTranslation extends Model
{
    use HasFactory;

    protected $table = 'proyek_tujuan_translations';

    protected $fillable = [
        'proyek_tujuan_id',
        'bahasa',
        'deskripsi',
    ];
}
