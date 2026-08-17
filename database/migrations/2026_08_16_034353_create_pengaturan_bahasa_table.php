<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengaturan_bahasa', function (Blueprint $table) {
            $table->id();
            $table->string('bahasa_default', 10)->default('id');
            $table->string('bahasa_tersedia', 100)->default('id,en');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengaturan_bahasa');
    }
};
