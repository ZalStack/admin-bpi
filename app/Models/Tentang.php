<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'tentang';

    protected $fillable = [
        'section',
        'gambar',
        'icon',
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
        return $this->gambar ? asset('storage/tentang/' . $this->gambar) : null;
    }

    public function poin()
    {
        return $this->hasMany(TentangPoin::class, 'tentang_id');
    }
}
