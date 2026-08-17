<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kontak', function (Blueprint $table) {
            $table->id();
            $table->string('judul_id', 255);
            $table->string('judul_en', 255);
            $table->text('deskripsi_id');
            $table->text('deskripsi_en');
            $table->text('alamat_id')->nullable();
            $table->text('alamat_en')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon', 100)->nullable();
            $table->string('whatsapp', 100)->nullable();
            $table->string('media_sosial', 255)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kontak');
    }
};
