<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Teks halaman Stakeholder (/stakeholders) yang bisa diedit dari CMS.
 * Isi awal = teks yang saat ini tampil. Header section Mitra tidak di sini:
 * diambil dari menu Partners → Partner Page Intro (tabel mitra_intro).
 */
return new class extends Migration
{
    private const HALAMAN = 'stakeholder';

    public function up(): void
    {
        $stats = 'Statistics Strip';
        $tabs = 'Tabs';
        $associations = 'Professional Associations Section';
        $associationsCta = 'Associations Call-to-Action';
        $partnersCta = 'Partners Call-to-Action';

        $items = [
            ['statistik.asosiasi_satuan', $stats, 'Associations Box: Unit Label', 'text', 'Asosiasi', 'Guilds'],
            ['statistik.asosiasi_judul', $stats, 'Associations Box: Title', 'text', 'Asosiasi Profesi Terdaftar', 'Professional Associations'],
            ['statistik.mitra_satuan', $stats, 'Partners Box: Unit Label', 'text', 'Mitra', 'Partners'],
            ['statistik.mitra_judul', $stats, 'Partners Box: Title', 'text', 'Mitra Kerja Sama Strategis', 'Strategic Partners'],

            ['tab.asosiasi', $tabs, 'Associations Tab', 'text', 'Asosiasi Profesi', 'Professional Associations'],
            ['tab.mitra', $tabs, 'Partners Tab', 'text', 'Mitra Strategis', 'Strategic Partners'],

            ['asosiasi.badge', $associations, 'Badge', 'text', 'EKOSISTEM SINEMA NASIONAL', 'NATIONAL CINEMA ECOSYSTEM'],
            ['asosiasi.judul', $associations, 'Title', 'text', 'Asosiasi Profesi Perfilman', 'Professional Film Associations'],
            ['asosiasi.deskripsi', $associations, 'Description', 'textarea',
                'Jejaring resmi asosiasi profesi perfilman, serikat pekerja kreatif, dan komunitas insan film yang berkolaborasi aktif bersama Badan Perfilman Indonesia.',
                'Verified network of Indonesian film guilds, creative communities, and industry practitioners collaborating with BPI.'],

            ['cta_asosiasi.teks', $associationsCta, 'Text', 'textarea',
                'Apakah asosiasi perfilman Anda belum terdaftar sebagai stakeholder resmi BPI?',
                'Is your film association not yet registered as an official BPI stakeholder?'],
            ['cta_asosiasi.tombol', $associationsCta, 'Button (links to Contact page)', 'text', 'Daftarkan Asosiasi Anda', 'Register Your Association'],

            ['cta_mitra.badge', $partnersCta, 'Badge', 'text', 'Kemitraan Terbuka', 'Open Partnership'],
            ['cta_mitra.judul', $partnersCta, 'Title', 'text',
                'Membangun Masa Depan Perfilman Indonesia Bersama BPI',
                'Build the Future of Indonesian Cinema Together'],
            ['cta_mitra.deskripsi', $partnersCta, 'Description', 'textarea',
                'BPI menyambut terbuka kolaborasi strategis bersama institusi pemerintah, perguruan tinggi, industri swasta, festival, serta komunitas kreatif guna memajukan ekosistem perfilman nasional yang mandiri dan berdaya saing global.',
                'BPI welcomes strategic collaboration with government agencies, universities, private enterprises, international film organizations, and community collectives to empower our film ecosystem.'],
            ['cta_mitra.tombol_ajukan', $partnersCta, 'Button: Propose (links to Contact page)', 'text', 'Ajukan Kemitraan', 'Become a Partner'],
            ['cta_mitra.tombol_sekretariat', $partnersCta, 'Button: Email Secretariat (uses main email from Contact)', 'text', 'Hubungi Sekretariat', 'Contact Secretariat'],
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
