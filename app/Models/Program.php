<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'program';

    protected $fillable = [
        'judul_id',
        'judul_en',
        'deskripsi_id',
        'deskripsi_en',
        'icon',
        'gambar',
        'urutan',
        'status'
    ];
}
