<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('struktur_organisasi_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('struktur_organisasi_id')->constrained('struktur_organisasi')->cascadeOnDelete();
            $table->string('bahasa', 5);
            $table->string('jabatan', 255);
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->unique(['struktur_organisasi_id', 'bahasa'], 'struktur_organisasi_translations_unique');
            $table->foreign('bahasa')->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('struktur_organisasi_translations');
    }
};
