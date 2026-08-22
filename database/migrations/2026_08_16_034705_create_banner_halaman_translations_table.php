<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('banner_halaman_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('banner_halaman_id')->constrained('banner_halaman')->cascadeOnDelete();
            $table->string('bahasa', 5);
            $table->string('judul', 255);
            $table->text('deskripsi');
            $table->timestamps();

            $table->unique(['banner_halaman_id', 'bahasa']);
            $table->foreign('bahasa')->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banner_halaman_translations');
    }
};
