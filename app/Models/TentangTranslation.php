<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangTranslation extends Model
{
    use HasFactory;

    protected $table = 'tentang_translations';

    protected $fillable = [
        'tentang_id',
        'bahasa',
        'judul',
        'subjudul',
        'deskripsi',
    ];
}
