<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterTranslation extends Model
{
    use HasFactory;

    protected $table = 'footer_translations';

    protected $fillable = [
        'footer_id',
        'bahasa',
        'judul',
        'deskripsi',
        'link_nama',
    ];
}
