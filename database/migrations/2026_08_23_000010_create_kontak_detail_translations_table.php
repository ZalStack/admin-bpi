<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kontak_detail_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kontak_detail_id')->constrained('kontak_detail')->cascadeOnDelete();
            $table->string('bahasa', 5);
            $table->string('judul', 255);
            $table->text('deskripsi')->nullable();
            $table->string('nilai')->nullable();
            $table->timestamps();

            $table->unique(['kontak_detail_id', 'bahasa']);
            $table->foreign('bahasa')->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kontak_detail_translations');
    }
};
