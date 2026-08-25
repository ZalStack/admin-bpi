<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_roadmap', function (Blueprint $table) {
            if (!Schema::hasColumn('program_roadmap', 'gambar')) {
                $table->string('gambar', 255)->nullable()->after('icon');
            }
        });
    }

    public function down(): void
    {
        Schema::table('program_roadmap', function (Blueprint $table) {
            if (Schema::hasColumn('program_roadmap', 'gambar')) {
                $table->dropColumn('gambar');
            }
        });
    }
};
