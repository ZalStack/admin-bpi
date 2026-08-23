<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
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
    }

    public function down()
    {
        Schema::dropIfExists('proyek_tujuan_translations');
    }
};
