<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekGaleri extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'proyek_galeri';

    protected $fillable = [
        'proyek_id',
        'gambar',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $appends = [
        'gambar_url',
    ];

    public function getGambarUrlAttribute(): ?string
    {
        return $this->gambar ? asset('storage/proyek/galeri/' . $this->gambar) : null;
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }
}
