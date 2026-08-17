<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakForm extends Model
{
    use HasFactory;

    protected $table = 'kontak_form';

    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan',
        'status'
    ];
}
