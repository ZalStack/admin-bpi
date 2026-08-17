<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $table = 'footer';

    protected $fillable = [
        'section',
        'judul_id',
        'judul_en',
        'deskripsi_id',
        'deskripsi_en',
        'link_nama_id',
        'link_nama_en',
        'link_url',
        'icon',
        'urutan',
        'status'
    ];
}
