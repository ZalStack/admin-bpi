<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shortlink', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique();
            $table->string('url_tujuan', 2048);
            $table->string('judul')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('jumlah_klik')->default(0);
            $table->timestamp('terakhir_diklik_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shortlink');
    }
};
