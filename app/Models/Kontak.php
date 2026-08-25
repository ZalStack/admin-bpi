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

    public function social_media()
    {
        return $this->hasMany(KontakSocialMedia::class, 'kontak_id')->orderBy('urutan');
    }

    public function socialMedia()
    {
        return $this->social_media();
    }

    public function email()
    {
        return $this->hasMany(KontakEmail::class, 'kontak_id')->orderBy('urutan');
    }

    public function emails()
    {
        return $this->email();
    }

    public function phone()
    {
        return $this->hasMany(KontakPhone::class, 'kontak_id')->orderBy('urutan');
    }

    public function phones()
    {
        return $this->phone();
    }
}
