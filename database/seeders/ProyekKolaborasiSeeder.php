<?php

namespace Database\Seeders;

use App\Models\Bahasa;
use App\Models\Proyek;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyekKolaborasiSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pastikan record bahasa tersedia
        Bahasa::firstOrCreate(
            ['kode' => 'id'],
            ['nama' => 'Bahasa Indonesia', 'aktif' => true, 'is_default' => true]
        );
        Bahasa::firstOrCreate(
            ['kode' => 'en'],
            ['nama' => 'English', 'aktif' => true, 'is_default' => false]
        );

        // 2. Bersihkan data proyek sebelumnya agar idempoten
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('proyek_mitra')->delete();
        DB::table('proyek_tujuan')->delete();
        DB::table('proyek_dampak_capaian')->delete();
        DB::table('proyek_kegiatan_utama')->delete();
        DB::table('proyek_linimasa')->delete();
        DB::table('proyek_translations')->delete();
        DB::table('proyek')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        // 3. Data 4 Proyek Kolaborasi BPI
        $proyeks = [
            [
                'slug' => 'bpi-film-market-co-production-forum',
                'tahun' => '2024 - Sekarang',
                'status' => 'published',
                'urutan' => 1,
                'gambar_utama' => null,
                'translations' => [
                    'id' => [
                        'judul' => 'BPI Film Market & Co-Production Forum',
                        'kategori' => 'Pasar Film & Investasi',
                        'icon' => 'fa-solid fa-handshake-simple',
                        'lokasi' => 'Jakarta & Bali, Indonesia',
                        'ruang_lingkup' => 'Internasional & Regional',
                        'status_proyek' => 'Sedang Berjalan',
                        'timeline' => 'Maret 2024 - November 2024',
                        'deskripsi_singkat' => 'Platform resmi pertemuan bisnis antara produser film nasional dengan investor, agensi sales, distributor, dan buyer mancanegara.',
                        'deskripsi' => 'Forum pasar film komprehensif yang dirancang BPI untuk mempertemukan proyek-proyek film panjang fiksi dan dokumenter Indonesia yang sedang dalam tahap pengembangan (development) atau pascaproduksi dengan mitra strategis global. Dilengkapi sesi pitching one-on-one terpadu, kurasi naskah ketat, dan fasilitasi penandatanganan letter of intent (LOI) koproduksi internasional.',
                        'tujuan' => [
                            [
                                'icon' => 'fa-solid fa-coins',
                                'deskripsi' => 'Memfasilitasi kesepakatan pembiayaan dan kemitraan koproduksi antara sineas Indonesia dengan produser global.',
                            ],
                            [
                                'icon' => 'fa-solid fa-globe',
                                'deskripsi' => 'Membuka akses distribusi komersial film-film nasional berkualitas di bioskop dan platform OTT internasional.',
                            ],
                        ],
                        'dampak_capaian' => [
                            [
                                'icon' => 'fa-solid fa-clapperboard',
                                'total_capaian' => '35+ Proyek Film',
                                'deskripsi' => 'Terkurasi dan dipresentasikan langsung di hadapan investor serta sales agent internasional.',
                            ],
                            [
                                'icon' => 'fa-solid fa-earth-americas',
                                'total_capaian' => '15 Negara Mitra',
                                'deskripsi' => 'Berpartisipasi aktif dalam sesi business matchmaking dan penandatanganan nota kesepahaman koproduksi.',
                            ],
                        ],
                        'kegiatan_utama' => [
                            [
                                'icon' => 'fa-solid fa-users-rectangle',
                                'deskripsi' => 'Project Pitching Session & One-on-One Curated Business Matchmaking.',
                            ],
                            [
                                'icon' => 'fa-solid fa-chalkboard-user',
                                'deskripsi' => 'Panel Diskusi: Navigating Southeast Asian Co-Production Funds and Tax Rebates.',
                            ],
                        ],
                        'linimasa_proyek' => [
                            [
                                'tahun' => 'Q1 2024',
                                'deskripsi' => 'Pembukaan open call dan kurasi naskah proyek film nasional.',
                            ],
                            [
                                'tahun' => 'Q3 2024',
                                'deskripsi' => 'Pelaksanaan forum pasar film, pitching terpandu, dan penandatanganan kerja sama koproduksi.',
                            ],
                        ],
                    ],
                    'en' => [
                        'judul' => 'BPI Film Market & Co-Production Forum',
                        'kategori' => 'Film Market & Investment',
                        'icon' => 'fa-solid fa-handshake-simple',
                        'lokasi' => 'Jakarta & Bali, Indonesia',
                        'ruang_lingkup' => 'International & Regional',
                        'status_proyek' => 'Ongoing',
                        'timeline' => 'March 2024 - November 2024',
                        'deskripsi_singkat' => 'Official business matchmaking platform connecting national film producers with international financiers, sales agents, and distributors.',
                        'deskripsi' => 'A comprehensive film market forum initiated by BPI to bridge Indonesian fiction and documentary feature projects in development or post-production with global strategic partners, featuring one-on-one curated sessions, script curation, and co-production agreements.',
                        'tujuan' => [
                            [
                                'icon' => 'fa-solid fa-coins',
                                'deskripsi' => 'Facilitate financing deals and international co-production partnerships for Indonesian film talents.',
                            ],
                            [
                                'icon' => 'fa-solid fa-globe',
                                'deskripsi' => 'Open commercial distribution channels for competitive Indonesian cinema in overseas theatrical and streaming markets.',
                            ],
                        ],
                        'dampak_capaian' => [
                            [
                                'icon' => 'fa-solid fa-clapperboard',
                                'total_capaian' => '35+ Film Projects',
                                'deskripsi' => 'Curated and pitched directly to international financiers and sales agents.',
                            ],
                            [
                                'icon' => 'fa-solid fa-earth-americas',
                                'total_capaian' => '15 Partner Countries',
                                'deskripsi' => 'Actively participated in business matchmaking and co-production memorandum signings.',
                            ],
                        ],
                        'kegiatan_utama' => [
                            [
                                'icon' => 'fa-solid fa-users-rectangle',
                                'deskripsi' => 'Project Pitching Sessions & One-on-One Curated Business Matchmaking.',
                            ],
                            [
                                'icon' => 'fa-solid fa-chalkboard-user',
                                'deskripsi' => 'Panel Discussion: Navigating Southeast Asian Co-Production Funds and Tax Rebates.',
                            ],
                        ],
                        'linimasa_proyek' => [
                            [
                                'tahun' => 'Q1 2024',
                                'deskripsi' => 'Nationwide open call submission and curation of feature film packages.',
                            ],
                            [
                                'tahun' => 'Q3 2024',
                                'deskripsi' => 'Hosting of the integrated film market forum, guided pitches, and co-production contract signings.',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'laboratorium-skenario-penyutradaraan-muda',
                'tahun' => '2024',
                'status' => 'published',
                'urutan' => 2,
                'gambar_utama' => null,
                'translations' => [
                    'id' => [
                        'judul' => 'Laboratorium Skenario & Inkubator Sutradara Muda',
                        'kategori' => 'Inkubasi & Pengembangan Talenta',
                        'icon' => 'fa-solid fa-clapperboard',
                        'lokasi' => 'Yogyakarta & Bandung, Indonesia',
                        'ruang_lingkup' => 'Nasional',
                        'status_proyek' => 'Sedang Berjalan',
                        'timeline' => 'Mei 2024 - Oktober 2024',
                        'deskripsi_singkat' => 'Program inkubasi intensif pengembangan cerita orisinal dan penyutradaraan bagi sineas debutan dari berbagai wilayah Indonesia.',
                        'deskripsi' => 'Inisiatif peningkatan kualitas narasi film Indonesia yang membimbing 20 penulis dan sutradara muda terpilih. Melalui bimbingan langsung para mentor senior dan konsultan naskah internasional, peserta mematangkan skenario film panjang pertama mereka hingga siap memasuki tahap pembiayaan dan pra-produksi profesional.',
                        'tujuan' => [
                            [
                                'icon' => 'fa-solid fa-lightbulb',
                                'deskripsi' => 'Melahirkan naskah film orisinal dengan nilai lokalitas kuat serta penceritaan berstandar sinema internasional.',
                            ],
                            [
                                'icon' => 'fa-solid fa-user-tie',
                                'deskripsi' => 'Menyiapkan regenerasi sutradara dan penulis skenario profesional yang siap bersaing di industri film komersial.',
                            ],
                        ],
                        'dampak_capaian' => [
                            [
                                'icon' => 'fa-solid fa-users',
                                'total_capaian' => '20 Sineas Muda',
                                'deskripsi' => 'Menerima beasiswa residensi penuh dan bimbingan script doctoring intensif selama 6 bulan.',
                            ],
                            [
                                'icon' => 'fa-solid fa-award',
                                'total_capaian' => '5 Naskah Terbaik',
                                'deskripsi' => 'Mendapatkan dana stimulan pengembangan pra-produksi dan akses langsung ke produser film terkemuka.',
                            ],
                        ],
                        'kegiatan_utama' => [
                            [
                                'icon' => 'fa-solid fa-book-open-reader',
                                'deskripsi' => 'Lokakarya Residensi Penulisan Skenario & Bedah Naskah bersama Script Consultant.',
                            ],
                            [
                                'icon' => 'fa-solid fa-person-chalkboard',
                                'deskripsi' => 'Table Read Terbuka & Showcase Presentasi Naskah di Hadapan Produser Rumah Produksi.',
                            ],
                        ],
                        'linimasa_proyek' => [
                            [
                                'tahun' => 'Mei 2024',
                                'deskripsi' => 'Penerimaan naskah secara nasional dan seleksi kurasi 20 finalis terbaik.',
                            ],
                            [
                                'tahun' => 'Agustus 2024',
                                'deskripsi' => 'Pelaksanaan residensi bootcamp intensif dan mentoring privat (one-on-one).',
                            ],
                        ],
                    ],
                    'en' => [
                        'judul' => 'Screenplay Lab & Young Directors Incubator',
                        'kategori' => 'Incubation & Talent Development',
                        'icon' => 'fa-solid fa-clapperboard',
                        'lokasi' => 'Yogyakarta & Bandung, Indonesia',
                        'ruang_lingkup' => 'National',
                        'status_proyek' => 'In Progress',
                        'timeline' => 'May 2024 - October 2024',
                        'deskripsi_singkat' => 'Intensive incubation program developing original screenplays and directorial skills for emerging filmmakers across Indonesia.',
                        'deskripsi' => 'An initiative aimed at elevating the storytelling quality of Indonesian cinema by mentoring 20 selected young writers and directors. Guided by senior filmmakers and international script consultants, participants refine their debut feature scripts into production-ready packages.',
                        'tujuan' => [
                            [
                                'icon' => 'fa-solid fa-lightbulb',
                                'deskripsi' => 'Produce authentic original screenplays rooted in Indonesian cultural contexts with universal appeal.',
                            ],
                            [
                                'icon' => 'fa-solid fa-user-tie',
                                'deskripsi' => 'Cultivate the next generation of professional directors and screenwriters for the national industry.',
                            ],
                        ],
                        'dampak_capaian' => [
                            [
                                'icon' => 'fa-solid fa-users',
                                'total_capaian' => '20 Emerging Filmmakers',
                                'deskripsi' => 'Awarded full residential scholarships and intensive 6-month script doctoring mentorship.',
                            ],
                            [
                                'icon' => 'fa-solid fa-award',
                                'total_capaian' => '5 Selected Scripts',
                                'deskripsi' => 'Received pre-production development grants and direct packaging access with leading producers.',
                            ],
                        ],
                        'kegiatan_utama' => [
                            [
                                'icon' => 'fa-solid fa-book-open-reader',
                                'deskripsi' => 'Residential Scriptwriting Workshop & Deep Story Development Labs with Consultants.',
                            ],
                            [
                                'icon' => 'fa-solid fa-person-chalkboard',
                                'deskripsi' => 'Live Table Read & Showcase Presentation to Leading National Production Houses.',
                            ],
                        ],
                        'linimasa_proyek' => [
                            [
                                'tahun' => 'May 2024',
                                'deskripsi' => 'Nationwide script call submission and curation of the 20 finalists.',
                            ],
                            [
                                'tahun' => 'August 2024',
                                'deskripsi' => 'Residential bootcamp execution and one-on-one script doctoring sessions.',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'restorasi-digitalisasi-arsip-film-nasional',
                'tahun' => '2023 - 2025',
                'status' => 'published',
                'urutan' => 3,
                'gambar_utama' => null,
                'translations' => [
                    'id' => [
                        'judul' => 'Restorasi & Digitalisasi Arsip Sinema Klasik Indonesia',
                        'kategori' => 'Preservasi & Warisan Budaya',
                        'icon' => 'fa-solid fa-box-archive',
                        'lokasi' => 'Jakarta, Indonesia',
                        'ruang_lingkup' => 'Nasional & Institusional',
                        'status_proyek' => 'Sedang Berjalan',
                        'timeline' => 'September 2023 - Desember 2025',
                        'deskripsi_singkat' => 'Program penyelamatan dan alih media master film seluloid klasik Indonesia ke resolusi digital 4K berkualitas tinggi.',
                        'deskripsi' => 'Proyek konservasi budaya berskala nasional hasil kerja sama BPI, lembaga arsip film, dan laboratorium restorasi independen. Menyelamatkan film-film karya maestro sinema masa lampau dari ancaman kerusakan jamur dan kerapuhan fisik, serta mendokumentasikan kembali sejarah bangsa agar dapat dipelajari oleh akademisi dan diapresiasi oleh generasi muda.',
                        'tujuan' => [
                            [
                                'icon' => 'fa-solid fa-vault',
                                'deskripsi' => 'Menyelamatkan materi fisik seluloid bernilai sejarah tinggi dari kepunahan dan kerusakan permanen.',
                            ],
                            [
                                'icon' => 'fa-solid fa-photo-film',
                                'deskripsi' => 'Membangun repositori digital beresolusi 4K untuk kepentingan riset, pendidikan, dan pemutaran publik.',
                            ],
                        ],
                        'dampak_capaian' => [
                            [
                                'icon' => 'fa-solid fa-film',
                                'total_capaian' => '15 Judul Film Klasik',
                                'deskripsi' => 'Berhasil dialihkan ke format digital 4K dan direstorasi kejernihan visual serta kualitas suaranya.',
                            ],
                            [
                                'icon' => 'fa-solid fa-clock-rotate-left',
                                'total_capaian' => '50.000+ Menit',
                                'deskripsi' => 'Pita seluloid historis telah dibersihkan secara ultrasonik dan tersimpan dalam ruang arsip beriklim khusus.',
                            ],
                        ],
                        'kegiatan_utama' => [
                            [
                                'icon' => 'fa-solid fa-microscope',
                                'deskripsi' => 'Inspeksi Fisik Pita Seluloid, Pembersihan Ultrasonik, dan Pemindaian Sensor 4K HDR.',
                            ],
                            [
                                'icon' => 'fa-solid fa-wand-magic-sparkles',
                                'deskripsi' => 'Restorasi Digital Frame-by-Frame, Penghapusan Artefak/Goresan, dan Remastering Audio Monofonik.',
                            ],
                        ],
                        'linimasa_proyek' => [
                            [
                                'tahun' => '2023',
                                'deskripsi' => 'Inventarisasi rol seluloid dan uji kelayakan fisik rol bersejarah di gudang arsip.',
                            ],
                            [
                                'tahun' => '2024 - 2025',
                                'deskripsi' => 'Alih media digital 4K, proses restorasi visual mendalam, dan penayangan gala perdana restorasi.',
                            ],
                        ],
                    ],
                    'en' => [
                        'judul' => 'Indonesian Classic Cinema Archive Restoration & Digitization',
                        'kategori' => 'Preservation & Cultural Heritage',
                        'icon' => 'fa-solid fa-box-archive',
                        'lokasi' => 'Jakarta, Indonesia',
                        'ruang_lingkup' => 'National & Institutional',
                        'status_proyek' => 'Active',
                        'timeline' => 'September 2023 - December 2025',
                        'deskripsi_singkat' => 'Safeguarding and digitizing historical Indonesian celluloid film masters into 4K high-resolution digital formats.',
                        'deskripsi' => 'A national-scale cultural preservation project collaborating with film archives and restoration laboratories to rescue historical films from physical decay, ensuring timeless cinematic masterpieces remain accessible to future generations, researchers, and public audiences.',
                        'tujuan' => [
                            [
                                'icon' => 'fa-solid fa-vault',
                                'deskripsi' => 'Save historically valuable celluloid elements from permanent physical degradation and chemical decay.',
                            ],
                            [
                                'icon' => 'fa-solid fa-photo-film',
                                'deskripsi' => 'Establish a pristine 4K digital archive for academic study, research, and cultural public exhibitions.',
                            ],
                        ],
                        'dampak_capaian' => [
                            [
                                'icon' => 'fa-solid fa-film',
                                'total_capaian' => '15 Classic Titles',
                                'deskripsi' => 'Successfully restored to 4K resolution with remastered picture clarity and sound design.',
                            ],
                            [
                                'icon' => 'fa-solid fa-clock-rotate-left',
                                'total_capaian' => '50,000+ Minutes',
                                'deskripsi' => 'Of historical footage ultrasonically cleaned and preserved in climate-controlled storage vaults.',
                            ],
                        ],
                        'kegiatan_utama' => [
                            [
                                'icon' => 'fa-solid fa-microscope',
                                'deskripsi' => 'Physical Inspection, Ultrasonic Reel Cleaning, and High Dynamic Range 4K Film Scanning.',
                            ],
                            [
                                'icon' => 'fa-solid fa-wand-magic-sparkles',
                                'deskripsi' => 'Digital Frame-by-Frame Defect Repair, Scratch Removal, and Audio Master Restoration.',
                            ],
                        ],
                        'linimasa_proyek' => [
                            [
                                'tahun' => '2023',
                                'deskripsi' => 'Reel triage, chemical vinegar syndrome testing, and historical asset prioritization.',
                            ],
                            [
                                'tahun' => '2024 - 2025',
                                'deskripsi' => '4K scanning execution, comprehensive audiovisual restoration, and commemorative premiere.',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'ekshibisi-layar-komunitas-film-daerah',
                'tahun' => '2024',
                'status' => 'published',
                'urutan' => 4,
                'gambar_utama' => null,
                'translations' => [
                    'id' => [
                        'judul' => 'Ekshibisi Layar Komunitas & Apresiasi Film Daerah',
                        'kategori' => 'Distribusi & Apresiasi Publik',
                        'icon' => 'fa-solid fa-video',
                        'lokasi' => '15 Kota & Kabupaten se-Indonesia',
                        'ruang_lingkup' => 'Nasional (15 Wilayah)',
                        'status_proyek' => 'Sedang Berjalan',
                        'timeline' => 'April 2024 - November 2024',
                        'deskripsi_singkat' => 'Distribusi pemutaran film alternatif dan ruang apresiasi sinema Indonesia di wilayah non-bioskop komersial.',
                        'deskripsi' => 'Menjawab ketimpangan persebaran bioskop dengan memfasilitasi pemutaran layar tancap modern, diskusi publik dengan pembuat film (Q&A), dan penayangan film-film pendek independen karya sineas daerah di ruang-ruang komunitas, kampus, dan balai budaya lokal.',
                        'tujuan' => [
                            [
                                'icon' => 'fa-solid fa-route',
                                'deskripsi' => 'Memperluas jangkauan penonton film Indonesia hingga ke daerah terpencil yang belum terjangkau bioskop komersial.',
                            ],
                            [
                                'icon' => 'fa-solid fa-people-roof',
                                'deskripsi' => 'Menguatkan simpul komunitas film lokal sebagai agen edukasi dan pemantik ekosistem budaya menonton film bermutu.',
                            ],
                        ],
                        'dampak_capaian' => [
                            [
                                'icon' => 'fa-solid fa-users',
                                'total_capaian' => '25.000+ Penonton',
                                'deskripsi' => 'Menghadiri pemutaran terbuka dan forum diskusi bedah film di 15 kota dan kabupaten nusantara.',
                            ],
                            [
                                'icon' => 'fa-solid fa-handshake-angle',
                                'total_capaian' => '40 Komunitas Film',
                                'deskripsi' => 'Terlibat aktif sebagai mitra penyelenggara lapangan dan kurator film lokal.',
                            ],
                        ],
                        'kegiatan_utama' => [
                            [
                                'icon' => 'fa-solid fa-campground',
                                'deskripsi' => 'Pemutaran Film Layar Terbuka (Pop-up Cinema) & Diskusi Sesi Tanya Jawab bersama Sineas.',
                            ],
                            [
                                'icon' => 'fa-solid fa-graduation-cap',
                                'deskripsi' => 'Lokakarya Manajemen Penyelenggaraan Pemutaran Film Mandiri untuk Penggerak Komunitas.',
                            ],
                        ],
                        'linimasa_proyek' => [
                            [
                                'tahun' => 'Q2 2024',
                                'deskripsi' => 'Kurasi katalog film dan konsolidasi jejaring simpul komunitas pemutaran daerah.',
                            ],
                            [
                                'tahun' => 'Q3 - Q4 2024',
                                'deskripsi' => 'Pelaksanaan rangkaian roadshow pemutaran di 15 titik wilayah dari Sumatra hingga Papua.',
                            ],
                        ],
                    ],
                    'en' => [
                        'judul' => 'Community Cinema Roadshow & Regional Film Appreciation',
                        'kategori' => 'Distribution & Public Appreciation',
                        'icon' => 'fa-solid fa-video',
                        'lokasi' => '15 Cities & Regencies in Indonesia',
                        'ruang_lingkup' => 'National (15 Regions)',
                        'status_proyek' => 'Active',
                        'timeline' => 'April 2024 - November 2024',
                        'deskripsi_singkat' => 'Alternative cinema exhibition and film appreciation forums in regions underserved by commercial theaters.',
                        'deskripsi' => 'Addressing cinema access disparities by facilitating high-quality pop-up screenings, filmmaker Q&A discussions, and independent short film exhibitions in local cultural hubs, universities, and community centers.',
                        'tujuan' => [
                            [
                                'icon' => 'fa-solid fa-route',
                                'deskripsi' => 'Broaden audiences for Indonesian cinema in regional areas lacking commercial theater infrastructure.',
                            ],
                            [
                                'icon' => 'fa-solid fa-people-roof',
                                'deskripsi' => 'Empower grassroots film collectives as catalysts for cinema culture education and community engagement.',
                            ],
                        ],
                        'dampak_capaian' => [
                            [
                                'icon' => 'fa-solid fa-users',
                                'total_capaian' => '25,000+ Viewers',
                                'deskripsi' => 'Attended open community screenings and interactive discussions across 15 cities and regencies.',
                            ],
                            [
                                'icon' => 'fa-solid fa-handshake-angle',
                                'total_capaian' => '40 Film Collectives',
                                'deskripsi' => 'Actively partnered as regional event organizers and local program curators.',
                            ],
                        ],
                        'kegiatan_utama' => [
                            [
                                'icon' => 'fa-solid fa-campground',
                                'deskripsi' => 'Outdoor Pop-up Screenings & Post-Screening Filmmaker Q&A Forums.',
                            ],
                            [
                                'icon' => 'fa-solid fa-graduation-cap',
                                'deskripsi' => 'Independent Film Screening Management Workshops for Grassroots Organizers.',
                            ],
                        ],
                        'linimasa_proyek' => [
                            [
                                'tahun' => 'Q2 2024',
                                'deskripsi' => 'Film catalog curation and partnership alignment with regional screening hubs.',
                            ],
                            [
                                'tahun' => 'Q3 - Q4 2024',
                                'deskripsi' => 'Execution of traveling roadshow screenings across 15 points from Sumatra to Papua.',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($proyeks as $pData) {
            $proyek = Proyek::create([
                'slug' => $pData['slug'],
                'tahun' => $pData['tahun'],
                'status' => $pData['status'],
                'urutan' => $pData['urutan'],
                'gambar_utama' => $pData['gambar_utama'],
            ]);

            foreach ($pData['translations'] as $kode => $transData) {
                $trans = $proyek->translations()->create([
                    'bahasa' => $kode,
                    'judul' => $transData['judul'],
                    'kategori' => $transData['kategori'] ?? '',
                    'icon' => $transData['icon'] ?? 'fa-solid fa-film',
                    'lokasi' => $transData['lokasi'],
                    'ruang_lingkup' => $transData['ruang_lingkup'] ?? '',
                    'status_proyek' => $transData['status_proyek'] ?? '',
                    'timeline' => $transData['timeline'],
                    'deskripsi_singkat' => $transData['deskripsi_singkat'],
                    'deskripsi' => $transData['deskripsi'],
                ]);

                // 1. Tujuan
                if (!empty($transData['tujuan'])) {
                    $u = 1;
                    foreach ($transData['tujuan'] as $item) {
                        $trans->tujuan()->create([
                            'icon' => $item['icon'] ?? 'fa-solid fa-handshake',
                            'deskripsi' => $item['deskripsi'],
                            'urutan' => $u++,
                            'status' => true,
                        ]);
                    }
                }

                // 2. Dampak Capaian
                if (!empty($transData['dampak_capaian'])) {
                    $u = 1;
                    foreach ($transData['dampak_capaian'] as $item) {
                        $trans->dampak_capaian()->create([
                            'icon' => $item['icon'] ?? 'fa-solid fa-chart-line',
                            'total_capaian' => $item['total_capaian'] ?? '',
                            'deskripsi' => $item['deskripsi'] ?? '',
                            'urutan' => $u++,
                            'status' => true,
                        ]);
                    }
                }

                // 3. Kegiatan Utama
                if (!empty($transData['kegiatan_utama'])) {
                    $u = 1;
                    foreach ($transData['kegiatan_utama'] as $item) {
                        $trans->kegiatan_utama()->create([
                            'icon' => $item['icon'] ?? 'fa-solid fa-calendar-check',
                            'deskripsi' => $item['deskripsi'],
                            'urutan' => $u++,
                            'status' => true,
                        ]);
                    }
                }

                // 4. Linimasa Proyek
                if (!empty($transData['linimasa_proyek'])) {
                    $u = 1;
                    foreach ($transData['linimasa_proyek'] as $item) {
                        $trans->linimasa_proyek()->create([
                            'tahun' => $item['tahun'] ?? '',
                            'deskripsi' => $item['deskripsi'] ?? '',
                            'urutan' => $u++,
                            'status' => true,
                        ]);
                    }
                }
            }
        }

        $this->command->info('ProyekKolaborasiSeeder berhasil dijalankan: 4 Proyek Kolaborasi BPI beserta tujuan, dampak capaian, kegiatan utama, dan linimasa berhasil di-seed.');
    }
}
