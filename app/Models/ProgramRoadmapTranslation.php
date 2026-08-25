<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramRoadmapTranslation extends Model
{
    use HasFactory;

    protected $table = 'program_roadmap_translations';

    protected $fillable = [
        'program_roadmap_id',
        'bahasa',
        'judul',
        'deskripsi',
        'items',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    public function roadmap()
    {
        return $this->belongsTo(ProgramRoadmap::class, 'program_roadmap_id');
    }
}
