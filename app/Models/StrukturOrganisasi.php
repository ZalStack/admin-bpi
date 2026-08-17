<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'struktur_organisasi';

    protected $fillable = [
        'nama',
        'jabatan_id',
        'jabatan_en',
        'foto',
        'deskripsi_id',
        'deskripsi_en',
        'linkedin',
        'instagram',
        'email',
        'telepon',
        'urutan',
        'status'
    ];
}
