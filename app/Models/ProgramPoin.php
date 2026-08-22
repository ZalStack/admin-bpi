<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramPoin extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'program_poin';

    protected $fillable = [
        'program_id',
        'icon',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
