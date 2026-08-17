<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('judul_id', 255);
            $table->string('judul_en', 255);
            $table->text('ringkasan_id');
            $table->text('ringkasan_en');
            $table->text('isi_id');
            $table->text('isi_en');
            $table->string('gambar_utama')->nullable();
            $table->string('kategori_id', 100);
            $table->string('kategori_en', 100);
            $table->string('penulis', 255);
            $table->date('tanggal_publikasi');
            $table->text('kutipan_id')->nullable();
            $table->text('kutipan_en')->nullable();
            $table->string('status', 50)->default('draft');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('berita');
    }
};
