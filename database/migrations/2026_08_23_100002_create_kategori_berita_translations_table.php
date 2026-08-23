<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kategori_berita_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_berita_id')->constrained('kategori_berita')->cascadeOnDelete();
            $table->string('bahasa', 5);
            $table->string('judul', 255);
            $table->string('slug', 255);
            $table->timestamps();

            $table->unique(['kategori_berita_id', 'bahasa']);
            $table->foreign('bahasa')->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_berita_translations');
    }
};
