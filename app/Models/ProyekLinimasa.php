<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekLinimasa extends Model
{
    use HasFactory;

    protected $table = 'proyek_linimasa';

    protected $fillable = [
        'proyek_id',
        'tahun',
        'deskripsi',
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
