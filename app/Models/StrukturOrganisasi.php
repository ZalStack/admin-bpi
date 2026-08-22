<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'struktur_organisasi';

    protected $fillable = [
        'nama',
        'foto',
        'linkedin',
        'instagram',
        'email',
        'telepon',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
