<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mitra', function (Blueprint $table) {
            $table->id();
            $table->string('nama_id', 255);
            $table->string('nama_en', 255);
            $table->string('kategori_id', 100);
            $table->string('kategori_en', 100);
            $table->text('deskripsi_id');
            $table->text('deskripsi_en');
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->text('alamat_id')->nullable();
            $table->text('alamat_en')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mitra');
    }
};
