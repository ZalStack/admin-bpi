<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kategori_berita', function (Blueprint $table) {
            $table->string('warna', 50)->nullable()->default('#68001C')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori_berita', function (Blueprint $table) {
            $table->dropColumn('warna');
        });
    }
};
