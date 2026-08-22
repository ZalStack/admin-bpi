<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tentang_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tentang_id')->constrained('tentang')->cascadeOnDelete();
            $table->string('bahasa', 5);
            $table->string('judul', 255);
            $table->string('subjudul', 255)->nullable();
            $table->text('deskripsi');
            $table->timestamps();

            $table->unique(['tentang_id', 'bahasa']);
            $table->foreign('bahasa')->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tentang_translations');
    }
};
