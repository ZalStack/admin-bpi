<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyekMitra extends Model
{
    protected $table = 'proyek_mitra';

    protected $fillable = [
        'proyek_id',
        'mitra_id',
    ];
}
