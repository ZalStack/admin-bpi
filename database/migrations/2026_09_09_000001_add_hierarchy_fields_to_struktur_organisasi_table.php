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
                $table->string('kategori')->nullable()->after('divisi');
            }
            if (!Schema::hasColumn('struktur_organisasi', 'sub_kategori')) {
                $table->string('sub_kategori')->nullable()->after('kategori');
            }
            if (!Schema::hasColumn('struktur_organisasi', 'departemen')) {
                $table->string('departemen')->nullable()->after('sub_kategori');
            }
            if (!Schema::hasColumn('struktur_organisasi', 'level')) {
                $table->integer('level')->default(1)->after('departemen');
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
    }
};
