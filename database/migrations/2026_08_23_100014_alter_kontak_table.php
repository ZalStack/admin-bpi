<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->dropColumn(['email', 'telepon', 'whatsapp', 'media_sosial']);
        });
    }

    public function down()
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('telepon', 100)->nullable();
            $table->string('whatsapp', 100)->nullable();
            $table->string('media_sosial', 255)->nullable();
        });
    }
};
