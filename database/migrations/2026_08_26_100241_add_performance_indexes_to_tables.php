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
        Schema::table('berita', function (Blueprint $table) {
            $table->index('status');
            $table->index('tanggal_publikasi');
            $table->index(['status', 'created_at']);
        });

        Schema::table('berita_translations', function (Blueprint $table) {
            $table->index('kategori');
        });

        Schema::table('proyek', function (Blueprint $table) {
            $table->index('status');
            $table->index('urutan');
            $table->index(['status', 'urutan']);
        });

        Schema::table('proyek_translations', function (Blueprint $table) {
            $table->index('kategori');
        });

        Schema::table('kontak_form', function (Blueprint $table) {
            $table->index('status');
            $table->index(['status', 'created_at']);
        });

        Schema::table('banner_halaman', function (Blueprint $table) {
            $table->index('halaman');
        });

        Schema::table('bahasa', function (Blueprint $table) {
            $table->index('aktif');
            $table->index('is_default');
        });

        Schema::table('mitra', function (Blueprint $table) {
            $table->index('status');
            $table->index('urutan');
        });

        Schema::table('stakeholder', function (Blueprint $table) {
            $table->index('status');
            $table->index('urutan');
        });

        Schema::table('program', function (Blueprint $table) {
            $table->index('status');
            $table->index('urutan');
        });

        Schema::table('beranda', function (Blueprint $table) {
            $table->index('urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['tanggal_publikasi']);
            $table->dropIndex(['status', 'created_at']);
        });

        Schema::table('berita_translations', function (Blueprint $table) {
            $table->dropIndex(['kategori']);
        });

        Schema::table('proyek', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['urutan']);
            $table->dropIndex(['status', 'urutan']);
        });

        Schema::table('proyek_translations', function (Blueprint $table) {
            $table->dropIndex(['kategori']);
        });

        Schema::table('kontak_form', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['status', 'created_at']);
        });

        Schema::table('banner_halaman', function (Blueprint $table) {
            $table->dropIndex(['halaman']);
        });

        Schema::table('bahasa', function (Blueprint $table) {
            $table->dropIndex(['aktif']);
            $table->dropIndex(['is_default']);
        });

        Schema::table('mitra', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['urutan']);
        });

        Schema::table('stakeholder', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['urutan']);
        });

        Schema::table('program', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['urutan']);
        });

        Schema::table('beranda', function (Blueprint $table) {
            $table->dropIndex(['urutan']);
        });
    }
};
