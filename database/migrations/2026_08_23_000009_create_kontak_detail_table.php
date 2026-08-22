<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
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
    }

    public function down()
    {
        Schema::dropIfExists('kontak_detail');
    }
};
