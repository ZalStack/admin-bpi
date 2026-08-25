<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kategori_mitra', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();
            $table->integer('urutan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('kategori_mitra_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_mitra_id')->constrained('kategori_mitra')->cascadeOnDelete();
            $table->string('bahasa', 5);
            $table->string('nama', 255);
            $table->timestamps();

            $table->unique(['kategori_mitra_id', 'bahasa']);
            $table->foreign('bahasa')->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_mitra_translations');
        Schema::dropIfExists('kategori_mitra');
    }
};
