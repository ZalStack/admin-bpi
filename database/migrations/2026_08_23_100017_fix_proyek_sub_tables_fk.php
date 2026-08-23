<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('proyek_tujuan_translations');
        Schema::dropIfExists('proyek_dampak_capaian_translations');
        Schema::dropIfExists('proyek_kegiatan_utama_translations');

        Schema::table('proyek_tujuan', function (Blueprint $table) {
            $table->dropForeign(['proyek_id']);
            $table->dropIndex('proyek_tujuan_proyek_id_foreign');
            $table->renameColumn('proyek_id', 'proyek_translations_id');
            $table->text('deskripsi')->after('icon');
            $table->foreign('proyek_translations_id', 'pt_proj_fk')
                ->references('id')->on('proyek_translations')->cascadeOnDelete();
        });

        Schema::table('proyek_dampak_capaian', function (Blueprint $table) {
            $table->dropForeign(['proyek_id']);
            $table->dropIndex('proyek_dampak_capaian_proyek_id_foreign');
            $table->renameColumn('proyek_id', 'proyek_translations_id');
            $table->text('deskripsi')->after('total_capaian');
            $table->foreign('proyek_translations_id', 'pdc_proj_fk')
                ->references('id')->on('proyek_translations')->cascadeOnDelete();
        });

        Schema::table('proyek_kegiatan_utama', function (Blueprint $table) {
            $table->dropForeign(['proyek_id']);
            $table->dropIndex('proyek_kegiatan_utama_proyek_id_foreign');
            $table->renameColumn('proyek_id', 'proyek_translations_id');
            $table->text('deskripsi')->after('icon');
            $table->foreign('proyek_translations_id', 'pkut_proj_fk')
                ->references('id')->on('proyek_translations')->cascadeOnDelete();
        });

        Schema::table('proyek_linimasa', function (Blueprint $table) {
            $table->dropForeign(['proyek_id']);
            $table->dropIndex('proyek_linimasa_proyek_id_foreign');
            $table->renameColumn('proyek_id', 'proyek_translations_id');
            $table->foreign('proyek_translations_id', 'pl_proj_fk')
                ->references('id')->on('proyek_translations')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('proyek_tujuan', function (Blueprint $table) {
            $table->dropForeign(['proyek_translations_id']);
            $table->dropColumn('deskripsi');
            $table->renameColumn('proyek_translations_id', 'proyek_id');
            $table->foreign('proyek_id')->references('id')->on('proyek')->cascadeOnDelete();
        });

        Schema::table('proyek_dampak_capaian', function (Blueprint $table) {
            $table->dropForeign(['proyek_translations_id']);
            $table->dropColumn('deskripsi');
            $table->renameColumn('proyek_translations_id', 'proyek_id');
            $table->foreign('proyek_id')->references('id')->on('proyek')->cascadeOnDelete();
        });

        Schema::table('proyek_kegiatan_utama', function (Blueprint $table) {
            $table->dropForeign(['proyek_translations_id']);
            $table->dropColumn('deskripsi');
            $table->renameColumn('proyek_translations_id', 'proyek_id');
            $table->foreign('proyek_id')->references('id')->on('proyek')->cascadeOnDelete();
        });

        Schema::table('proyek_linimasa', function (Blueprint $table) {
            $table->dropForeign(['proyek_translations_id']);
            $table->renameColumn('proyek_translations_id', 'proyek_id');
            $table->foreign('proyek_id')->references('id')->on('proyek')->cascadeOnDelete();
        });

        Schema::create('proyek_tujuan_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyek_tujuan_id');
            $table->string('bahasa', 5);
            $table->text('deskripsi');
            $table->timestamps();
            $table->foreign('proyek_tujuan_id', 'pt_parent_fk')
                ->references('id')->on('proyek_tujuan')->cascadeOnDelete();
            $table->unique(['proyek_tujuan_id', 'bahasa'], 'pt_unique');
            $table->foreign('bahasa', 'pt_bahasa_fk')
                ->references('kode')->on('bahasa')->cascadeOnDelete();
        });

        Schema::create('proyek_dampak_capaian_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyek_dampak_capaian_id');
            $table->string('bahasa', 5);
            $table->text('deskripsi');
            $table->timestamps();
            $table->foreign('proyek_dampak_capaian_id', 'pdct_parent_fk')
                ->references('id')->on('proyek_dampak_capaian')->cascadeOnDelete();
            $table->unique(['proyek_dampak_capaian_id', 'bahasa'], 'pdct_unique');
            $table->foreign('bahasa', 'pdct_bahasa_fk')
                ->references('kode')->on('bahasa')->cascadeOnDelete();
        });

        Schema::create('proyek_kegiatan_utama_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyek_kegiatan_utama_id');
            $table->string('bahasa', 5);
            $table->text('deskripsi');
            $table->timestamps();
            $table->foreign('proyek_kegiatan_utama_id', 'pkut_parent_fk')
                ->references('id')->on('proyek_kegiatan_utama')->cascadeOnDelete();
            $table->unique(['proyek_kegiatan_utama_id', 'bahasa'], 'pkut_unique');
            $table->foreign('bahasa', 'pkut_bahasa_fk')
                ->references('kode')->on('bahasa')->cascadeOnDelete();
        });
    }
};
