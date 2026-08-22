<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proyek_mitra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('proyek')->cascadeOnDelete();
            $table->foreignId('mitra_id')->constrained('mitra')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['proyek_id', 'mitra_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('proyek_mitra');
    }
};
