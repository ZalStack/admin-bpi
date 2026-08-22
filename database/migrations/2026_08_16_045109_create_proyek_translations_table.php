<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proyek_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('proyek')->cascadeOnDelete();
            $table->string('bahasa', 5);
            $table->string('judul', 255);
            $table->string('kategori', 255);
            $table->text('deskripsi_singkat');
            $table->text('deskripsi');
            $table->string('lokasi', 255);
            $table->text('tujuan');
            $table->text('dampak');
            $table->text('kegiatan_utama');
            $table->text('capaian');
            $table->text('timeline');
            $table->timestamps();

            $table->unique(['proyek_id', 'bahasa']);
            $table->foreign('bahasa')->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proyek_translations');
    }
};
