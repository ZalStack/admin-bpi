<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('berita_galeri_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('berita_galeri_id')->constrained('berita_galeri')->cascadeOnDelete();
            $table->string('bahasa', 5);
            $table->string('caption', 255)->nullable();
            $table->timestamps();

            $table->unique(['berita_galeri_id', 'bahasa']);
            $table->foreign('bahasa')->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('berita_galeri_translations');
    }
};
