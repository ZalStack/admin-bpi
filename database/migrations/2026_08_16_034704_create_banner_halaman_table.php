<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('banner_halaman', function (Blueprint $table) {
            $table->id();
            $table->string('halaman', 50);
            $table->string('judul_id', 255);
            $table->string('judul_en', 255);
            $table->text('deskripsi_id');
            $table->text('deskripsi_en');
            $table->string('gambar')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banner_halaman');
    }
};
