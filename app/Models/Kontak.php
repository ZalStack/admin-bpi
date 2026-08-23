<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'kontak';

    protected $fillable = [
        'latitude',
        'longitude',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function socialMedia()
    {
        return $this->hasMany(KontakSocialMedia::class, 'kontak_id');
    }

    public function emails()
    {
        return $this->hasMany(KontakEmail::class, 'kontak_id');
    }

    public function phones()
    {
        return $this->hasMany(KontakPhone::class, 'kontak_id');
    }
}
