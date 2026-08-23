<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kontak_social_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kontak_id')->constrained('kontak')->cascadeOnDelete();
            $table->string('platform', 100);
            $table->string('username', 255);
            $table->string('url', 500);
            $table->integer('urutan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kontak_social_media');
    }
};
