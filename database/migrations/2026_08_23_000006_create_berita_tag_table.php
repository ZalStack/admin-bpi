<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('berita_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('berita_id')->constrained('berita')->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('tags')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['berita_id', 'tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('berita_tag');
    }
};
