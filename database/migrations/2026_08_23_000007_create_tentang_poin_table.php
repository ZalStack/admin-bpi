<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tentang_poin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tentang_id')->constrained('tentang')->cascadeOnDelete();
            $table->string('icon')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tentang_poin');
    }
};
