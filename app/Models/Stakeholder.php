<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stakeholder extends Model
{
    use HasFactory;

    protected $table = 'stakeholder';

    protected $fillable = [
        'nama_id',
        'nama_en',
        'deskripsi_id',
        'deskripsi_en',
        'icon',
        'gambar',
        'urutan',
        'status'
    ];
}
