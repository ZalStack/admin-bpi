<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('mitra_translations', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->change();
            $table->text('alamat')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('mitra_translations', function (Blueprint $table) {
            $table->text('deskripsi')->nullable(false)->change();
        });
    }
};
