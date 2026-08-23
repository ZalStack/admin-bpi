<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekTujuan extends Model
{
    use HasFactory;

    protected $table = 'proyek_tujuan';

    protected $fillable = [
        'proyek_translations_id',
        'deskripsi',
        'icon',
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
