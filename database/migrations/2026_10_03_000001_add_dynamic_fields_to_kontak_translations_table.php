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
            $table->text('deskripsi_sosial_media')->nullable()->after('judul');
            $table->text('deskripsi_email')->nullable()->after('deskripsi_sosial_media');
            $table->text('deskripsi_telepon')->nullable()->after('deskripsi_email');
            $table->string('form_badge', 255)->nullable()->after('deskripsi_telepon');
            $table->string('form_judul', 255)->nullable()->after('form_badge');
            $table->text('form_deskripsi')->nullable()->after('form_judul');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kontak_translations', function (Blueprint $table) {
            $table->dropColumn([
                'deskripsi_sosial_media',
                'deskripsi_email',
                'deskripsi_telepon',
                'form_badge',
                'form_judul',
                'form_deskripsi',
            ]);
        });
    }
};
