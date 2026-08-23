<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekLinimasa extends Model
{
    use HasFactory;

    protected $table = 'proyek_linimasa';

    protected $fillable = [
        'proyek_translations_id',
        'tahun',
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
