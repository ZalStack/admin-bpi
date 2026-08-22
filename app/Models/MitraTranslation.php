<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraTranslation extends Model
{
    use HasFactory;

    protected $table = 'mitra_translations';

    protected $fillable = [
        'mitra_id',
        'bahasa',
        'nama',
        'kategori',
        'deskripsi',
        'alamat',
    ];
}
