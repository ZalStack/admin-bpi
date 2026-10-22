<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * QR meng-encode short URL (bila shortlink_id terisi) atau url_tujuan
     * langsung. Gambar dirender di browser CMS dari kolom gaya di bawah.
     */
    public function up(): void
    {
        Schema::create('qrcode', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            // Restrict: shortlink yang masih dipakai QR tidak boleh dihapus,
            // karena QR yang sudah dicetak akan mati.
            $table->foreignId('shortlink_id')->nullable()->constrained('shortlink')->restrictOnDelete();
            $table->string('url_tujuan', 2048)->nullable();
            $table->string('warna_depan', 7)->default('#16336D');
            $table->string('warna_latar', 7)->default('#FFFFFF');
            $table->string('logo_mode', 10)->default('bpi'); // none | bpi | upload
            $table->string('logo')->nullable();
            $table->string('caption', 60)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qrcode');
    }
};
