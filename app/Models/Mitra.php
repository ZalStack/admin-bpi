<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mitra extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'mitra';

    protected $fillable = [
        'logo',
        'website',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $appends = [
        'logo_url',
    ];

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset('storage/mitra/' . $this->logo) : null;
    }

    public function proyek(): BelongsToMany
    {
        return $this->belongsToMany(Proyek::class, 'proyek_mitra', 'mitra_id', 'proyek_id');
    }
}
