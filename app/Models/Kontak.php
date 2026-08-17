<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontak';

    protected $fillable = [
        'judul_id',
        'judul_en',
        'deskripsi_id',
        'deskripsi_en',
        'alamat_id',
        'alamat_en',
        'email',
        'telepon',
        'whatsapp',
        'media_sosial',
        'latitude',
        'longitude',
        'status'
    ];
}
