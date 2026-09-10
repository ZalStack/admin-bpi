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
        Schema::table('struktur_organisasi', function (Blueprint $table) {
            if (!Schema::hasColumn('struktur_organisasi', 'kategori')) {
                $table->string('kategori', 50)->default('bidang')->nullable();
            }
            if (!Schema::hasColumn('struktur_organisasi', 'sub_kategori')) {
                $table->string('sub_kategori', 50)->nullable();
            }
            if (!Schema::hasColumn('struktur_organisasi', 'departemen')) {
                $table->string('departemen', 255)->nullable();
            }
            if (!Schema::hasColumn('struktur_organisasi', 'level')) {
                $table->tinyInteger('level')->default(3);
            }
        });

        Schema::table('struktur_organisasi_translations', function (Blueprint $table) {
            if (!Schema::hasColumn('struktur_organisasi_translations', 'departemen')) {
                $table->string('departemen', 255)->nullable()->after('jabatan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('struktur_organisasi', function (Blueprint $table) {
            $columnsToDrop = [];
            if (Schema::hasColumn('struktur_organisasi', 'kategori')) {
                $columnsToDrop[] = 'kategori';
            }
            if (Schema::hasColumn('struktur_organisasi', 'sub_kategori')) {
                $columnsToDrop[] = 'sub_kategori';
            }
            if (Schema::hasColumn('struktur_organisasi', 'departemen')) {
                $columnsToDrop[] = 'departemen';
            }
            if (Schema::hasColumn('struktur_organisasi', 'level')) {
                $columnsToDrop[] = 'level';
            }
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });

        Schema::table('struktur_organisasi_translations', function (Blueprint $table) {
            if (Schema::hasColumn('struktur_organisasi_translations', 'departemen')) {
                $table->dropColumn('departemen');
            }
        });
    }
};
