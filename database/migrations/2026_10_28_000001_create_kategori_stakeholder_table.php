<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kategori_stakeholder', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();
            $table->integer('urutan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('kategori_stakeholder_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_stakeholder_id');
            $table->string('bahasa', 5);
            $table->string('nama', 255);
            $table->timestamps();

            // Nama index eksplisit: nama otomatis melebihi batas 64 karakter MySQL
            $table->foreign('kategori_stakeholder_id', 'kat_stakeholder_trans_kat_id_foreign')
                ->references('id')->on('kategori_stakeholder')->cascadeOnDelete();
            $table->unique(['kategori_stakeholder_id', 'bahasa'], 'kat_stakeholder_trans_kat_id_bahasa_unique');
            $table->foreign('bahasa', 'kat_stakeholder_trans_bahasa_foreign')
                ->references('kode')->on('bahasa')->cascadeOnDelete();
        });

        // Slug kategori disimpan di record stakeholder (netral, tidak per bahasa)
        Schema::table('stakeholder', function (Blueprint $table) {
            $table->string('kategori', 100)->nullable()->after('gambar')->index();
        });
    }

    public function down()
    {
        Schema::table('stakeholder', function (Blueprint $table) {
            $table->dropIndex(['kategori']);
            $table->dropColumn('kategori');
        });

        Schema::dropIfExists('kategori_stakeholder_translations');
        Schema::dropIfExists('kategori_stakeholder');
    }
};
