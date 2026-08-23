<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kontak_phone', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kontak_id')->constrained('kontak')->cascadeOnDelete();
            $table->string('number', 100);
            $table->string('type', 50)->default('phone');
            $table->string('url', 500)->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kontak_phone');
    }
};
