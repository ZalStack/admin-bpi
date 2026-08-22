<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerandaTranslation extends Model
{
    use HasFactory;

    protected $table = 'beranda_translations';

    protected $fillable = [
        'beranda_id',
        'bahasa',
        'judul',
        'deskripsi',
    ];
}
