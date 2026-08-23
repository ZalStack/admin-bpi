<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekDampakCapaian extends Model
{
    use HasFactory;

    protected $table = 'proyek_dampak_capaian';

    protected $fillable = [
        'proyek_translations_id',
        'icon',
        'total_capaian',
        'deskripsi',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function translation()
    {
        return $this->belongsTo(ProyekTranslation::class, 'proyek_translations_id');
    }
}
