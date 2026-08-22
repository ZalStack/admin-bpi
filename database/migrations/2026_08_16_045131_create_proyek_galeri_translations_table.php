<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proyek_galeri_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_galeri_id')->constrained('proyek_galeri')->cascadeOnDelete();
            $table->string('bahasa', 5);
            $table->string('judul', 255)->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->unique(['proyek_galeri_id', 'bahasa']);
            $table->foreign('bahasa')->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proyek_galeri_translations');
    }
};
