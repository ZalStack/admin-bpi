<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramRoadmap extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'program_roadmap';

    protected $fillable = [
        'tahun',
        'icon',
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
        return $this->gambar ? asset('storage/program/' . $this->gambar) : null;
    }
}
