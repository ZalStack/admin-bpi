<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakPhone extends Model
{
    use HasFactory;

    protected $table = 'kontak_phone';

    protected $fillable = [
        'kontak_id',
        'number',
        'type',
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
