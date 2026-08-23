<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekDampakCapaian extends Model
{
    use HasTranslations, HasFactory;

    protected $table = 'proyek_dampak_capaian';

    protected $fillable = [
        'proyek_id',
        'icon',
        'total_capaian',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }
}
