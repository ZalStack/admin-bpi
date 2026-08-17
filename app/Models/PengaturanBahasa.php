<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanBahasa extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_bahasa';

    protected $fillable = [
        'bahasa_default',
        'bahasa_tersedia',
        'status'
    ];
}
