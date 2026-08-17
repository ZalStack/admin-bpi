<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekGaleri extends Model
{
    use HasFactory;

    protected $table = 'proyek_galeri';

    protected $fillable = [
        'proyek_id',
        'gambar',
        'judul_id',
        'judul_en',
        'deskripsi_id',
        'deskripsi_en',
        'urutan',
        'status'
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }
}
