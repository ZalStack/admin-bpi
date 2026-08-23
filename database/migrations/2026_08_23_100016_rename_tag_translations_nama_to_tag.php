<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tag_translations', function (Blueprint $table) {
            $table->renameColumn('nama', 'tag');
        });
    }

    public function down()
    {
        Schema::table('tag_translations', function (Blueprint $table) {
            $table->renameColumn('tag', 'nama');
        });
    }
};
