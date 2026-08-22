<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakDetail extends Model
{
    use HasTranslations, HasFactory;

    protected $table = 'kontak_detail';

    protected $fillable = [
        'kontak_id',
        'icon',
        'link_url',
        'link_nama',
        'handle',
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
