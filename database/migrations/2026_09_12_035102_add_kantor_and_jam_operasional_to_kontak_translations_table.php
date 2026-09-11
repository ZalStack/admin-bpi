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
        Schema::table('kontak_translations', function (Blueprint $table) {
            $table->string('nama_kantor', 255)->nullable()->after('judul');
            $table->string('jam_operasional', 255)->nullable()->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kontak_translations', function (Blueprint $table) {
            $table->dropColumn(['nama_kantor', 'jam_operasional']);
        });
    }
};
