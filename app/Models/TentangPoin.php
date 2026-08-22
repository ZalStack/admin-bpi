<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangPoin extends Model
{
    use HasTranslations, HasFactory;

    protected $table = 'tentang_poin';

    protected $fillable = [
        'tentang_id',
        'icon',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function tentang()
    {
        return $this->belongsTo(Tentang::class, 'tentang_id');
    }
}
