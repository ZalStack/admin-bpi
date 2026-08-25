<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berita_galeri_translations', function (Blueprint $table) {
            if (! Schema::hasColumn('berita_galeri_translations', 'judul')) {
                $table->string('judul', 255)->nullable()->after('bahasa');
            }
            if (! Schema::hasColumn('berita_galeri_translations', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('judul');
            }
        });

        // Copy existing caption to judul if judul is null
        if (Schema::hasColumn('berita_galeri_translations', 'caption')) {
            DB::statement('UPDATE berita_galeri_translations SET judul = caption WHERE judul IS NULL AND caption IS NOT NULL');
        }
    }

    public function down(): void
    {
        Schema::table('berita_galeri_translations', function (Blueprint $table) {
            $table->dropColumn(['judul', 'deskripsi']);
        });
    }
};
