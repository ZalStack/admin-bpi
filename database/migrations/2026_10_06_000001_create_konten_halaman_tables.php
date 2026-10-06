<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Teks statis per halaman frontend (judul, subjudul, deskripsi section)
 * yang bisa diedit dari CMS. Kunci didefinisikan lewat migration;
 * admin hanya mengubah nilainya.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konten_halaman', function (Blueprint $table) {
            $table->id();
            $table->string('halaman', 50);
            $table->string('kunci', 100);
            $table->string('grup', 100);
            $table->string('label', 150);
            $table->string('tipe', 20)->default('text');
            $table->integer('urutan')->default(0);
            $table->timestamps();

            $table->unique(['halaman', 'kunci']);
        });

        Schema::create('konten_halaman_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konten_halaman_id')->constrained('konten_halaman')->cascadeOnDelete();
            $table->string('bahasa', 5);
            $table->text('nilai')->nullable();
            $table->timestamps();

            $table->unique(['konten_halaman_id', 'bahasa']);
            $table->foreign('bahasa')->references('kode')->on('bahasa')->cascadeOnDelete();
        });

        $this->seedTentang();
    }

    public function down(): void
    {
        Schema::dropIfExists('konten_halaman_translations');
        Schema::dropIfExists('konten_halaman');
    }

    /**
     * Isi awal = teks yang saat ini tampil di halaman Tentang,
     * sehingga tampilan situs tidak berubah sebelum admin mengedit.
     */
    private function seedTentang(): void
    {
        $structureSection = 'Structure Section';
        $orgChart = 'Organizational Chart';
        $departments = 'Strategic Departments';
        $units = 'Committees, Working Groups & Taskforces';

        $items = [
            ['struktur.judul', $structureSection, 'Section Title', 'text',
                'Struktur Organisasi Kami',
                'Our Organizational Structure'],
            ['struktur.deskripsi', $structureSection, 'Section Description', 'textarea',
                'Tata kelola hierarkis Badan Perfilman Indonesia yang menaungi Pengurus Harian, Dewan-dewan, Pokja-pokja, Satgas, dan Komite.',
                'The hierarchical governance framework of the Indonesian Film Agency, overseeing the executive board, advisory boards, working groups, task forces, and committees.'],

            ['bagan.pimpinan', $orgChart, 'Leadership Label', 'text',
                'Pimpinan Pusat',
                'Central Leadership'],
            ['bagan.dewan_pengawas', $orgChart, 'Supervisory Board Title', 'text',
                'Dewan Pengawas',
                'Supervisory Board'],
            ['bagan.dewan_penasihat', $orgChart, 'Advisory Board Title', 'text',
                'Dewan Penasihat',
                'Advisory Board'],
            ['bagan.dewan_pakar', $orgChart, 'Expert Board Title', 'text',
                'Dewan Pakar',
                'Expert Board'],
            ['bagan.sekretariat', $orgChart, 'Secretariat Box Title', 'text',
                'Sekretariat & Perbendaharaan',
                'Secretariat & Treasury'],
            ['bagan.sekjen', $orgChart, 'Secretary-General Label', 'text',
                'Sekretaris Jenderal',
                'Secretary-General'],
            ['bagan.wasekjen', $orgChart, 'Deputy Secretary-General Label', 'text',
                'Wakil Sekretaris Jenderal',
                'Deputy Secretary-General'],
            ['bagan.bendahara', $orgChart, 'Treasurer Label', 'text',
                'Bendahara Umum',
                'Treasurer'],

            ['bagan.bidang_judul', $departments, 'Title', 'text',
                'BIDANG-BIDANG STRATEGIS',
                'STRATEGIC DEPARTMENTS'],
            ['bagan.bidang_deskripsi', $departments, 'Subtitle', 'textarea',
                'Beragam bidang strategis yang bertugas menjalankan program kerja di bawah arahan Pengurus Harian Badan Perfilman Indonesia.',
                'Various strategic departments responsible for executing work programs under the direction of the Indonesian Film Agency Executive Board.'],

            ['bagan.unit_judul', $units, 'Title', 'text',
                'KOMITE, POKJA, DAN SATGAS',
                'COMMITTEES, WORKING GROUPS & TASK FORCES'],
            ['bagan.unit_deskripsi', $units, 'Subtitle', 'textarea',
                'Unit kerja khusus yang dibentuk untuk menangani isu, program, dan target spesifik Badan Perfilman Indonesia.',
                'Specialized units established to handle specific issues, programs, and targets of the Indonesian Film Agency.'],
            ['bagan.unit_periode', $units, 'Caption on Units Without Members (e.g. period)', 'text',
                'Unit Kerja BPI 2026–2030',
                'BPI Working Unit 2026–2030'],
        ];

        // Terjemahan hanya diisi untuk bahasa yang sudah terdaftar (FK ke tabel bahasa).
        // Pada instalasi baru (bahasa belum di-seed) entri tetap dibuat dan
        // frontend memakai teks cadangannya.
        $bahasa = DB::table('bahasa')->whereIn('kode', ['id', 'en'])->pluck('kode')->all();
        $now = now();

        foreach ($items as $urutan => [$kunci, $grup, $label, $tipe, $nilaiId, $nilaiEn]) {
            $id = DB::table('konten_halaman')->insertGetId([
                'halaman' => 'tentang',
                'kunci' => $kunci,
                'grup' => $grup,
                'label' => $label,
                'tipe' => $tipe,
                'urutan' => $urutan + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach (['id' => $nilaiId, 'en' => $nilaiEn] as $kode => $nilai) {
                if (in_array($kode, $bahasa, true)) {
                    DB::table('konten_halaman_translations')->insert([
                        'konten_halaman_id' => $id,
                        'bahasa' => $kode,
                        'nilai' => $nilai,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
};
