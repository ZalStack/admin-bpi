<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakTranslation extends Model
{
    use HasFactory;

    protected $table = 'kontak_translations';

    protected $fillable = [
        'kontak_id',
        'bahasa',
        'judul',
        'deskripsi',
        'alamat',
    ];
}
