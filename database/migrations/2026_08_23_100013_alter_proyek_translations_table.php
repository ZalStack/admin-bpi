<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('proyek_translations', function (Blueprint $table) {
            $table->string('icon', 100)->nullable()->after('bahasa');
            $table->string('ruang_lingkup', 255)->nullable()->after('lokasi');
            $table->string('status_proyek', 100)->nullable()->after('ruang_lingkup');
            $table->dropColumn(['tujuan', 'dampak', 'kegiatan_utama', 'capaian']);
        });
    }

    public function down()
    {
        Schema::table('proyek_translations', function (Blueprint $table) {
            $table->dropColumn(['icon', 'ruang_lingkup', 'status_proyek']);
            $table->text('tujuan');
            $table->text('dampak');
            $table->text('kegiatan_utama');
            $table->text('capaian');
        });
    }
};
