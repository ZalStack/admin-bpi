<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('footer', function (Blueprint $table) {
            $table->id();
            $table->string('section', 100);
            $table->string('judul_id', 255);
            $table->string('judul_en', 255);
            $table->text('deskripsi_id')->nullable();
            $table->text('deskripsi_en')->nullable();
            $table->string('link_nama_id', 255)->nullable();
            $table->string('link_nama_en', 255)->nullable();
            $table->string('link_url', 255)->nullable();
            $table->string('icon')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('footer');
    }
};
