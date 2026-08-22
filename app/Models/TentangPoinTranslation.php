<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TentangPoinTranslation extends Model
{
    protected $table = 'tentang_poin_translations';

    protected $fillable = [
        'tentang_poin_id',
        'bahasa',
        'judul',
        'deskripsi',
    ];
}
