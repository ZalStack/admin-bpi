<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriStakeholderTranslation extends Model
{
    protected $table = 'kategori_stakeholder_translations';

    protected $fillable = [
        'kategori_stakeholder_id',
        'bahasa',
        'nama',
    ];
}
