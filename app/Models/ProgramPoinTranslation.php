<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramPoinTranslation extends Model
{
    protected $table = 'program_poin_translations';

    protected $fillable = [
        'program_poin_id',
        'bahasa',
        'judul',
        'deskripsi',
    ];
}
