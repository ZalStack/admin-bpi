<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'tags';

    protected $fillable = [
        'slug',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function berita()
    {
        return $this->belongsToMany(Berita::class, 'berita_tag', 'tag_id', 'berita_id');
    }
}
