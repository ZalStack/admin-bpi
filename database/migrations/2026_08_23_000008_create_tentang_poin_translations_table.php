<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tentang_poin_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tentang_poin_id')->constrained('tentang_poin')->cascadeOnDelete();
            $table->string('bahasa', 5);
            $table->string('judul', 255);
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->unique(['tentang_poin_id', 'bahasa']);
            $table->foreign('bahasa')->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tentang_poin_translations');
    }
};
