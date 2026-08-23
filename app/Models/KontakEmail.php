<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakEmail extends Model
{
    use HasFactory;

    protected $table = 'kontak_email';

    protected $fillable = [
        'kontak_id',
        'email',
        'description',
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
