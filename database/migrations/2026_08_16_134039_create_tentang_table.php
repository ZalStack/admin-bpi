<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tentang', function (Blueprint $table) {
            $table->id();
            $table->string('section', 100);
            $table->string('judul_id', 255);
            $table->string('judul_en', 255);
            $table->string('subjudul_id', 255)->nullable();
            $table->string('subjudul_en', 255)->nullable();
            $table->text('deskripsi_id');
            $table->text('deskripsi_en');
            $table->string('gambar')->nullable();
            $table->string('icon')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tentang');
    }
};
