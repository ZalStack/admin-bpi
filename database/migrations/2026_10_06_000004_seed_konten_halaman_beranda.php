<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Teks halaman Beranda (judul section, badge, tombol) yang bisa diedit dari CMS.
 * Isi awal = teks yang saat ini tampil. Urutan/tampil section tetap diatur
 * di menu Homepage (tabel beranda).
 */
return new class extends Migration
{
    private const HALAMAN = 'beranda';

    public function up(): void
    {
        $banner = 'Hero Banner';
        $about = 'About Us Section';
        $projects = 'Collaborative Projects Section';
        $programs = 'Strategic Programs Section';
        $news = 'Articles & News Section';
        $partners = 'Partners Section';

        $items = [
            ['banner.tombol', $banner, 'Button (links to Stakeholders page)', 'text', 'LIHAT 50+ STAKEHOLDERS', 'EXPLORE 50+ STAKEHOLDERS'],

            ['tentang.tombol', $about, 'Button (links to About page)', 'text', 'SELENGKAPNYA', 'LEARN MORE'],

            ['proyek.judul', $projects, 'Title', 'text', 'PROYEK KOLABORASI', 'COLLABORATIVE PROJECTS'],
            ['proyek.tombol', $projects, 'Button (links to Projects page)', 'text', 'Lihat Semua Proyek', 'View All Projects'],

            ['program.badge', $programs, 'Badge', 'text', 'PILAR UTAMA', 'KEY PILLARS'],
            ['program.judul', $programs, 'Title', 'text', 'PROGRAM STRATEGIS', 'STRATEGIC PROGRAMS'],
            ['program.tombol', $programs, 'Button (links to Projects page)', 'text', 'Lihat Detail Program', 'View Program Details'],

            ['berita.judul', $news, 'Title', 'text', 'ARTIKEL & BERITA', 'ARTICLES & NEWS'],
            ['berita.tombol', $news, 'Button (links to News page)', 'text', 'Lihat Semua Berita', 'View All News'],

            ['mitra.judul', $partners, 'Title', 'text', 'MITRA KAMI', 'OUR PARTNERS'],
        ];

        // Terjemahan hanya untuk bahasa yang terdaftar (FK ke tabel bahasa).
        $bahasa = DB::table('bahasa')->whereIn('kode', ['id', 'en'])->pluck('kode')->all();
        $now = now();

        foreach ($items as $urutan => [$kunci, $grup, $label, $tipe, $nilaiId, $nilaiEn]) {
            $id = DB::table('konten_halaman')->insertGetId([
                'halaman' => self::HALAMAN,
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

    public function down(): void
    {
        // Terjemahan ikut terhapus lewat FK cascade.
        DB::table('konten_halaman')->where('halaman', self::HALAMAN)->delete();
    }
};
