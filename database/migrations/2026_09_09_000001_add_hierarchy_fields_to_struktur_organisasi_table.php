<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table(" struktur_organisasi\, function (Blueprint ) {
 ->string(\kategori\, 50)->default(\bidang\)->after(\nama\);
 ->string(\sub_kategori\, 50)->nullable()->after(\kategori\);
 ->string(\departemen\, 255)->nullable()->after(\sub_kategori\);
 ->tinyInteger(\level\)->default(3)->after(\departemen\);
 });

 Schema::table(\struktur_organisasi_translations\, function (Blueprint ) {
 ->string(\departemen\, 255)->nullable()->after(\jabatan\);
 });
 }

 public function down()
 {
 Schema::table(\struktur_organisasi\, function (Blueprint ) {
 ->dropColumn([\kategori\, \sub_kategori\, \departemen\, \level\]);
 });

 Schema::table(\struktur_organisasi_translations\, function (Blueprint ) {
 ->dropColumn([\departemen\]);
 });
 }
};
