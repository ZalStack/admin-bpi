<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mitra_intro', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->integer('urutan')->default(1);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('mitra_intro_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_intro_id')->constrained('mitra_intro')->cascadeOnDelete();
            $table->string('bahasa', 5);
            $table->string('judul', 255);
            $table->string('subjudul', 255)->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->unique(['mitra_intro_id', 'bahasa']);
            $table->foreign('bahasa')->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mitra_intro_translations');
        Schema::dropIfExists('mitra_intro');
    }
};
