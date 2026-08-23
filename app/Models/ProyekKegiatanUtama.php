<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekKegiatanUtama extends Model
{
    use HasFactory;

    protected $table = 'proyek_kegiatan_utama';

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
