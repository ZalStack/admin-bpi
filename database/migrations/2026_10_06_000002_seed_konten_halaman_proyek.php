<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Teks halaman Proyek (/project dan judul section di /project/[slug])
 * yang bisa diedit dari CMS. Isi awal = teks yang saat ini tampil.
 */
return new class extends Migration
{
    private const HALAMAN = 'proyek';

    public function up(): void
    {
        $stats = 'Statistics Strip';
        $tabs = 'Tabs';
        $roadmap = 'Roadmap Section';
        $pillars = 'Strategic Pillars Section';
        $projects = 'Collaborative Projects Section';
        $cta = 'Collaboration Call-to-Action';
        $detail = 'Project Detail Page — Section Titles';

        $items = [
            ['statistik.pilar_satuan', $stats, 'Programs Box: Unit Label', 'text', 'Pilar', 'Pillars'],
            ['statistik.pilar_judul', $stats, 'Programs Box: Title', 'text', 'Program Strategis', 'Strategic Programs'],
            ['statistik.fase_satuan', $stats, 'Roadmap Box: Unit Label', 'text', 'Fase', 'Phases'],
            ['statistik.fase_judul', $stats, 'Roadmap Box: Title', 'text', 'Peta Jalan Transformasi', 'Transformation Roadmap'],
            ['statistik.proyek_satuan', $stats, 'Projects Box: Unit Label', 'text', 'Proyek', 'Projects'],
            ['statistik.proyek_judul', $stats, 'Projects Box: Title', 'text', 'Proyek Kolaborasi Aktif', 'Collaborative Projects'],

            ['tab.program', $tabs, 'Programs Tab', 'text', 'Program & Peta Jalan', 'Programs & Roadmap'],
            ['tab.proyek', $tabs, 'Projects Tab', 'text', 'Proyek Kolaborasi', 'Collaborative Projects'],

            ['roadmap.badge', $roadmap, 'Badge', 'text', 'PETA JALAN STRATEGIS', 'TRANSFORMATION ROADMAP'],
            ['roadmap.judul', $roadmap, 'Title', 'text', 'Tahapan Transformasi Perfilman', 'Cinema Transformation Phases'],
            ['roadmap.deskripsi', $roadmap, 'Description', 'textarea',
                'Garis waktu terarah pergerakan BPI dalam memperkuat fondasi regulasi, memajukan kapasitas insan film, dan mengakselerasi ekosistem sinema menuju panggung global.',
                "A structured milestone framework to consolidate ecosystems, advance creative competence, and expand Indonesian cinema's presence globally."],

            ['pilar.badge', $pillars, 'Badge', 'text', 'PILAR PROGRAM UTAMA', 'CORE STRATEGIC PILLARS'],
            ['pilar.judul', $pillars, 'Title', 'text', 'Program Strategis BPI', 'Strategic Program Focus'],
            ['pilar.deskripsi', $pillars, 'Description', 'textarea',
                'Pilar prioritas Badan Perfilman Indonesia dalam merajut standar profesi, perlindungan ekosistem kerja, konsolidasi data industri, dan kemitraan strategis.',
                'Priority programs directed at institutional capacity building, standardizing talent competence, and fostering a healthy national cinema ecosystem.'],

            ['daftar.badge', $projects, 'Badge', 'text', 'PROYEK KOLABORASI STRATEGIS', 'COLLABORATIVE INITIATIVES'],
            ['daftar.judul', $projects, 'Title', 'text', 'Inisiatif Proyek Perfilman', 'Ecosystem Initiatives'],
            ['daftar.deskripsi', $projects, 'Description', 'textarea',
                'Wujud nyata kolaborasi strategis BPI bersama kementerian, asosiasi profesi, institusi pendidikan, dan pelaku industri untuk menggerakkan ekosistem perfilman nasional.',
                'Concrete strategic projects realized in synergy with ministries, guilds, educational institutions, and global film stakeholders.'],

            ['cta.badge', $cta, 'Badge', 'text', 'Kolaborasi Proyek Terbuka', 'Open Collaboration'],
            ['cta.judul', $cta, 'Title', 'text', 'Memiliki Gagasan Proyek atau Inisiatif Perfilman?', 'Have a Film Project or Strategic Initiative?'],
            ['cta.deskripsi', $cta, 'Description', 'textarea',
                'Badan Perfilman Indonesia menyambut berbagai inisiatif kolaboratif bersama asosiasi, studio, pemerintah daerah, dan mitra global untuk memajukan perfilman tanah air.',
                'BPI actively partners with filmmakers, studios, universities, and international festivals to accelerate quality production, skills development, and distribution.'],
            ['cta.tombol_ajukan', $cta, 'Button: Propose (links to Contact page)', 'text', 'Ajukan Kolaborasi', 'Propose a Collaboration'],
            ['cta.tombol_sekretariat', $cta, 'Button: Email Secretariat (uses main email from Contact)', 'text', 'Hubungi Sekretariat BPI', 'Contact Secretariat'],

            ['detail.tujuan', $detail, 'Objectives', 'text', 'TUJUAN PROYEK', 'PROJECT OBJECTIVES'],
            ['detail.mitra', $detail, 'Partners (count is added automatically)', 'text', 'MITRA TERLIBAT', 'PARTNERS INVOLVED'],
            ['detail.dampak', $detail, 'Impact & Achievements', 'text', 'DAMPAK & CAPAIAN', 'IMPACT & ACHIEVEMENTS'],
            ['detail.kegiatan', $detail, 'Key Activities', 'text', 'KEGIATAN UTAMA', 'KEY ACTIVITIES'],
            ['detail.galeri', $detail, 'Photo Gallery (count is added automatically)', 'text', 'GALERI FOTO', 'PHOTO GALLERY'],
            ['detail.linimasa', $detail, 'Timeline', 'text', 'LINIMASA PROYEK', 'PROJECT TIMELINE'],
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
