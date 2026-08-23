<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakSocialMedia extends Model
{
    use HasFactory;

    protected $table = 'kontak_social_media';

    protected $fillable = [
        'kontak_id',
        'platform',
        'username',
        'url',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function kontak()
    {
        return $this->belongsTo(Kontak::class, 'kontak_id');
    }
}
