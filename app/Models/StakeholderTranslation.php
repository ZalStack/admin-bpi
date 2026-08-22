<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StakeholderTranslation extends Model
{
    use HasFactory;

    protected $table = 'stakeholder_translations';

    protected $fillable = [
        'stakeholder_id',
        'bahasa',
        'nama',
        'deskripsi',
    ];
}
