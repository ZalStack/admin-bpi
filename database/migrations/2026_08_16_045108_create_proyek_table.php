<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proyek', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('judul_id', 255);
            $table->string('judul_en', 255);
            $table->string('kategori_id', 255);
            $table->string('kategori_en', 255);
            $table->text('deskripsi_singkat_id');
            $table->text('deskripsi_singkat_en');
            $table->text('deskripsi_id');
            $table->text('deskripsi_en');
            $table->string('gambar_utama')->nullable();
            $table->string('lokasi_id', 255);
            $table->string('lokasi_en', 255);
            $table->string('tahun', 20);
            $table->text('tujuan_id');
            $table->text('tujuan_en');
            $table->text('dampak_id');
            $table->text('dampak_en');
            $table->text('kegiatan_utama_id');
            $table->text('kegiatan_utama_en');
            $table->text('capaian_id');
            $table->text('capaian_en');
            $table->text('timeline_id');
            $table->text('timeline_en');
            $table->string('status', 50)->default('draft');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proyek');
    }
};
