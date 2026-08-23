<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
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
    }

    public function down()
    {
        Schema::dropIfExists('proyek_dampak_capaian_translations');
    }
};
