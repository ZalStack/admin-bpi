<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekTranslation extends Model
{
    use HasFactory;

    protected $table = 'proyek_translations';

    protected $fillable = [
        'proyek_id',
        'bahasa',
        'judul',
        'kategori',
        'deskripsi_singkat',
        'deskripsi',
        'lokasi',
        'icon',
        'ruang_lingkup',
        'status_proyek',
        'timeline',
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }

    public function tujuan()
    {
        return $this->hasMany(ProyekTujuan::class, 'proyek_translations_id');
    }

    public function dampakCapaian()
    {
        return $this->hasMany(ProyekDampakCapaian::class, 'proyek_translations_id');
    }

    public function kegiatanUtama()
    {
        return $this->hasMany(ProyekKegiatanUtama::class, 'proyek_translations_id');
    }

    public function linimasa()
    {
        return $this->hasMany(ProyekLinimasa::class, 'proyek_translations_id');
    }
}
