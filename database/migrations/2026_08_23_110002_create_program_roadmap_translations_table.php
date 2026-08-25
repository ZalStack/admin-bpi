<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('program_roadmap_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_roadmap_id')->constrained('program_roadmap')->cascadeOnDelete();
            $table->string('bahasa', 5);
            $table->string('judul', 255);
            $table->text('deskripsi');
            $table->json('items')->nullable();
            $table->timestamps();

            $table->unique(['program_roadmap_id', 'bahasa']);
            $table->foreign('bahasa')->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('program_roadmap_translations');
    }
};
