<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('kontak_detail_translations');
        Schema::dropIfExists('kontak_detail');
    }

    public function down()
    {
        Schema::create('kontak_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kontak_id')->constrained('kontak')->cascadeOnDelete();
            $table->string('icon')->nullable();
            $table->string('link_url')->nullable();
            $table->string('link_nama')->nullable();
            $table->string('handle')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

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
};
