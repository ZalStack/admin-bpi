<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraIntro extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'mitra_intro';

    protected $fillable = [
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
        return $this->gambar ? asset('storage/mitra/' . $this->gambar) : null;
    }
}
