<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proyek_kegiatan_utama_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyek_kegiatan_utama_id');
            $table->string('bahasa', 5);
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('proyek_kegiatan_utama_id', 'pkut_parent_fk')
                ->references('id')->on('proyek_kegiatan_utama')->cascadeOnDelete();
            $table->unique(['proyek_kegiatan_utama_id', 'bahasa'], 'pkut_unique');
            $table->foreign('bahasa', 'pkut_bahasa_fk')
                ->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proyek_kegiatan_utama_translations');
    }
};
