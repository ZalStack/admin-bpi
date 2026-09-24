<?php

namespace Database\Seeders;

use App\Models\Bahasa;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeritaSeeder extends Seeder
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

        // 2. Pastikan Master Kategori Berita ("Berita" & "Opini") tersedia
        $kategoriBerita = KategoriBerita::whereHas('translations', function ($q) {
            $q->whereIn('slug', ['berita', 'news']);
        })->first();

        if (! $kategoriBerita) {
            $kategoriBerita = KategoriBerita::create();
            $kategoriBerita->translations()->createMany([
                ['bahasa' => 'id', 'judul' => 'Berita', 'slug' => 'berita'],
                ['bahasa' => 'en', 'judul' => 'News', 'slug' => 'news'],
            ]);
        }

        $kategoriOpini = KategoriBerita::whereHas('translations', function ($q) {
            $q->whereIn('slug', ['opini', 'opinion']);
        })->first();

        if (! $kategoriOpini) {
            $kategoriOpini = KategoriBerita::create();
            $kategoriOpini->translations()->createMany([
                ['bahasa' => 'id', 'judul' => 'Opini', 'slug' => 'opini'],
                ['bahasa' => 'en', 'judul' => 'Opinion', 'slug' => 'opinion'],
            ]);
        }

        // 3. Pastikan Master Tags topik perfilman tersedia
        $tagDefinitions = [
            'perfilman-indonesia' => [
                ['bahasa' => 'id', 'tag' => 'Perfilman Indonesia'],
                ['bahasa' => 'en', 'tag' => 'Indonesian Cinema'],
            ],
            'festival-film' => [
                ['bahasa' => 'id', 'tag' => 'Festival Film'],
                ['bahasa' => 'en', 'tag' => 'Film Festival'],
            ],
            'regulasi-dan-kebijakan' => [
                ['bahasa' => 'id', 'tag' => 'Regulasi & Kebijakan'],
                ['bahasa' => 'en', 'tag' => 'Regulation & Policy'],
            ],
            'opini-sineas' => [
                ['bahasa' => 'id', 'tag' => 'Opini Sineas'],
                ['bahasa' => 'en', 'tag' => 'Filmmaker Opinion'],
            ],
            'ekosistem-film' => [
                ['bahasa' => 'id', 'tag' => 'Ekosistem Film'],
                ['bahasa' => 'en', 'tag' => 'Film Ecosystem'],
            ],
        ];

        $tagMap = [];
        foreach ($tagDefinitions as $slug => $translations) {
            $tag = Tag::firstOrCreate(
                ['slug' => $slug],
                ['status' => true]
            );

            foreach ($translations as $trans) {
                $tag->translations()->firstOrCreate(
                    ['bahasa' => $trans['bahasa']],
                    ['tag' => $trans['tag']]
                );
            }

            $tagMap[$slug] = $tag->id;
        }

        // 4. Bersihkan data berita sebelumnya agar idempoten
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('berita_galeri_translations')->delete();
        DB::table('berita_galeri')->delete();
        DB::table('berita_tag')->delete();
        DB::table('berita_translations')->delete();
        DB::table('berita')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        // 5. Data 4 Artikel Berita (2 Kategori "Berita" & 2 Kategori "Opini")
        $beritaList = [
            // ==========================================
            // KATEGORI 1: BERITA (NEWS) - DATA 1
            // ==========================================
            [
                'slug' => 'bpi-resmikan-program-akselerasi-film-daerah-2026',
                'gambar_utama' => 'sample-berita-1.jpg',
                'penulis' => 'Biro Komunikasi & Publikasi BPI',
                'tanggal_publikasi' => '2026-09-22',
                'status' => 'published',
                'tags' => ['perfilman-indonesia', 'ekosistem-film'],
                'translations' => [
                    'id' => [
                        'kategori' => 'Berita',
                        'judul' => 'BPI Resmikan Program Akselerasi Film Daerah untuk Dorong Pertumbuhan Sineas Lokal',
                        'ringkasan' => 'Badan Perfilman Indonesia (BPI) secara resmi meluncurkan inisiatif Akselerasi Sineas Daerah guna memperluas akses pendanaan dan bimbingan teknis perfilman di 10 provinsi.',
                        'isi' => '<p>Jakarta – Badan Perfilman Indonesia (BPI) secara resmi meluncurkan program strategis "Akselerasi Film Daerah 2026" sebagai langkah konkret pemerataan kualitas industri film di luar kota-kota besar. Program ini menyasar para sineas muda dan komunitas film independen yang selama ini memiliki potensi naratif besar namun terkendala fasilitas produksi serta akses jejaring industri.</p><p>Pimpinan BPI menegaskan bahwa keberagaman cerita nusantara merupakan modal utama sinema Indonesia di kancah global. Melalui program ini, para peserta terpilih akan menerima bimbingan intensif dari praktisi perfilman nasional terkemuka, mulai dari tahap pematangan penulisan skenario, manajemen penganggaran produksi, hingga strategi distribusi ke pasar festival internasional.</p><p>Pelaksanaan tahap pertama akan dimulai di lima kota percontohan pada kuartal akhir tahun ini, berkolaborasi erat dengan pemerintah daerah, komunitas film lokal, dan dinas kebudayaan setempat guna memastikan keberlanjutan ekosistem sinema di daerah.</p>',
                        'kutipan' => 'Kekuatan sinema Indonesia terletak pada keragaman narasi lokal yang otentik dan berdaya saing global.',
                    ],
                    'en' => [
                        'kategori' => 'News',
                        'judul' => 'BPI Officially Launches Regional Film Acceleration Program to Empower Local Filmmakers',
                        'ringkasan' => 'The Indonesian Film Board (BPI) has officially inaugurated the Regional Filmmaker Acceleration initiative to expand funding access and technical mentoring across 10 provinces.',
                        'isi' => '<p>Jakarta – The Indonesian Film Board (BPI) has officially introduced the "Regional Film Acceleration 2026" strategic program as a tangible step toward decentralizing quality film production beyond major metropolitan areas. This initiative targets emerging filmmakers and grassroots collectives with substantial creative potential.</p><p>The leadership of BPI emphasized that the archipelago\'s narrative diversity is the core strength of Indonesian cinema on the global stage. Selected participants will receive rigorous mentoring from senior industry professionals covering screenwriting, financing, and festival distribution pathways.</p><p>The pilot phase is scheduled to commence across five designated hub cities in the final quarter of the year in close collaboration with regional cultural agencies and grassroots screening networks.</p>',
                        'kutipan' => 'The true vitality of Indonesian cinema lies in the authenticity and global appeal of its regional stories.',
                    ],
                ],
            ],

            // ==========================================
            // KATEGORI 1: BERITA (NEWS) - DATA 2
            // ==========================================
            [
                'slug' => 'delegasi-perfilman-indonesia-raih-kesepakatan-koproduksi-internasional',
                'gambar_utama' => 'sample-berita-2.jpg',
                'penulis' => 'Komite Hubungan Internasional BPI',
                'tanggal_publikasi' => '2026-09-18',
                'status' => 'published',
                'tags' => ['perfilman-indonesia', 'festival-film'],
                'translations' => [
                    'id' => [
                        'kategori' => 'Berita',
                        'judul' => 'Delegasi Perfilman Indonesia Raih Kesepakatan Koproduksi Strategis di Pasar Film Internasional',
                        'ringkasan' => 'Fasilitasi Paviliun Indonesia oleh BPI berhasil membukukan kemitraan koproduksi dan distribusi untuk lima proyek film panjang cerita nasional bersama mitra global.',
                        'isi' => '<p>Kehadiran delegasi perfilman Indonesia yang difasilitasi oleh Badan Perfilman Indonesia (BPI) di forum pasar film internasional membuahkan capaian membanggakan. Sebanyak lima proyek film panjang fiksi dan dokumenter berhasil menandatangani nota kesepahaman (MoU) kemitraan koproduksi bersama produser dan agensi pendanaan dari Eropa dan Asia Pasifik.</p><p>Fasilitasi paviliun terpadu ini memberikan ruang presentasi (pitching) terstruktur bagi produser independen Indonesia untuk bernegosiasi langsung dengan investor dan agen penjualan internasional. Kesepakatan yang diraih mencakup pendanaan pascaproduksi, pertukaran tenaga ahli teknis, serta jaminan hak distribusi komersial di wilayah mancanegara.</p><p>BPI optimis bahwa capaian ini semakin mempertegas posisi Indonesia sebagai pusat kolaborasi konten kreatif perfilman terkemuka di Asia Tenggara yang memiliki potensi pasar dan daya pikat cerita yang kuat.</p>',
                        'kutipan' => 'Kemitraan internasional bukan sekadar permodalan, melainkan jembatan transfer pengetahuan dan ekspansi penonton.',
                    ],
                    'en' => [
                        'kategori' => 'News',
                        'judul' => 'Indonesian Film Delegation Secures Strategic Co-Production Agreements at International Market',
                        'ringkasan' => 'BPI\'s facilitation of the Indonesian Pavilion yielded co-production and distribution partnerships for five national feature projects with global stakeholders.',
                        'isi' => '<p>The Indonesian film delegation facilitated by the Indonesian Film Board (BPI) achieved remarkable results at the international film market forum. Five fiction and documentary feature projects successfully signed Memorandums of Understanding (MoU) for international co-productions with partners from Europe and the Asia-Pacific region.</p><p>The integrated pavilion provided a structured pitching environment for independent Indonesian producers to negotiate directly with global financiers and sales agents. The agreements encompass post-production financing grants, technical talent exchange, and multi-territory theatrical release commitments.</p><p>BPI remains confident that these milestones reinforce Indonesia\'s standing as a leading cinematic collaboration hub in Southeast Asia with profound narrative allure.</p>',
                        'kutipan' => 'International partnerships are not merely about capital; they serve as conduits for knowledge exchange and audience expansion.',
                    ],
                ],
            ],

            // ==========================================
            // KATEGORI 2: OPINI (OPINION) - DATA 1
            // ==========================================
            [
                'slug' => 'menjaga-kelestarian-arsip-sinema-sebagai-benteng-memori-kolektif-bangsa',
                'gambar_utama' => 'sample-berita-3.jpg',
                'penulis' => 'Dewan Pakar & Riset BPI',
                'tanggal_publikasi' => '2026-09-14',
                'status' => 'published',
                'tags' => ['regulasi-dan-kebijakan', 'opini-sineas'],
                'translations' => [
                    'id' => [
                        'kategori' => 'Opini',
                        'judul' => 'Menjaga Kelestarian Arsip Sinema sebagai Benteng Memori Kolektif Bangsa',
                        'ringkasan' => 'Catatan kritis mengenai urgensi preservasi dan restorasi digital seluloid karya maestro perfilman Indonesia sebelum tergerus kerusakan fisik.',
                        'isi' => '<p>Film bukan semata komoditas hiburan komersial, melainkan rekaman sejarah, ekspresi kultural, dan cerminan peradaban suatu bangsa pada zamannya. Setiap frame seluloid menangkap lanskap sosial, gestur budaya, dan pergulatan batin manusia Indonesia pada titik masa tertentu. Namun, realitas preservasi film seluloid klasik kita masih menghadapi tantangan multidimensi.</p><p>Banyak rol master karya maestro sinema kita yang terancam sindrom cuka (vinegar syndrome), jamur, dan kerapuhan fisik akibat penyimpanan di luar standar kontrol kelembapan yang ketat. Ketiadaan fasilitas laboratorium restorasi digital 4K berstandar arsip internasional di tanah air selama ini memperlambat upaya konservasi penyelamatan karya-karya monumental tersebut.</p><p>Sudah saatnya ekosistem perfilman nasional menempatkan konservasi arsip film sebagai prioritas strategis kebudayaan. Diperlukan alokasi pendanaan berkesinambungan dan kolaborasi lintas lembaga untuk membangun repositori digital nasional agar warisan tak ternilai ini tetap dapat dipelajari oleh generasi mendatang.</p>',
                        'kutipan' => 'Kehilangan sebuah arsip film sama halnya dengan merelakan sebagian ingatan dan rekaman sejarah peradaban bangsa hilang selamanya.',
                    ],
                    'en' => [
                        'kategori' => 'Opinion',
                        'judul' => 'Preserving Cinema Archives as the Bastion of National Collective Memory',
                        'ringkasan' => 'A critical reflection on the urgent need for celluloid preservation and 4K digital restoration of classic Indonesian masterworks before physical degradation takes its toll.',
                        'isi' => '<p>Film is far more than commercial entertainment; it represents historical records, cultural expressions, and mirrors of a society\'s evolving civilization. Every celluloid frame captures the social landscape, cultural mannerisms, and internal struggles of the Indonesian people at distinct moments in history. Yet our archival preservation reality faces severe vulnerabilities.</p><p>Numerous master reels by our cinematic pioneers are endangered by vinegar syndrome, fungal decay, and physical brittleness due to suboptimal climate-controlled vault storage. The historical lack of specialized domestic 4K restoration laboratories has hampered conservation efforts for monumental classic titles.</p><p>It is imperative for the national film ecosystem to elevate cinematic archiving into a strategic cultural pillar. Sustainable funding mechanisms and inter-agency collaboration are essential to create an accessible digital archive so that future generations never lose touch with their cultural roots.</p>',
                        'kutipan' => 'Losing a film archive is tantamount to surrendering an irreplaceable fragment of our collective historical memory.',
                    ],
                ],
            ],

            // ==========================================
            // KATEGORI 2: OPINI (OPINION) - DATA 2
            // ==========================================
            [
                'slug' => 'menimbang-arah-regulasi-dan-kesejahteraan-tenaga-kerja-perfilman-indonesia',
                'gambar_utama' => 'sample-berita-4.jpg',
                'penulis' => 'Komite Advokasi & Regulasi BPI',
                'tanggal_publikasi' => '2026-09-08',
                'status' => 'published',
                'tags' => ['regulasi-dan-kebijakan', 'opini-sineas', 'ekosistem-film'],
                'translations' => [
                    'id' => [
                        'kategori' => 'Opini',
                        'judul' => 'Menimbang Arah Regulasi dan Standar Kesejahteraan Tenaga Kerja Perfilman Indonesia',
                        'ringkasan' => 'Telaah komprehensif mengenai pentingnya standarisasi jam kerja di lokasi syuting, perlindungan keselamatan kerja, dan kontrak yang berkeadilan bagi seluruh kru film.',
                        'isi' => '<p>Pertumbuhan pesat jumlah produksi layar lebar dan serial platform streaming dalam beberapa tahun terakhir membuktikan gairah pasar sinema Indonesia yang kian matang. Kendati demikian, di balik gemerlap layar dan capaian box office puluhan juta penonton, terdapat isu fundamental ketenagakerjaan yang menuntut perhatian serius: batasan jam kerja syuting yang manusiawi dan kepastian perlindungan keselamatan kerja bagi para kru lapangan.</p><p>Praktik syuting melebihi 16 hingga 20 jam berturut-turut tanpa jeda pemulihan yang memadai tidak hanya berisiko fatal terhadap keselamatan fisik dan kesehatan mental pekerja kreatif, namun juga menurunkan mutu estetika karya yang dihasilkan. Kelelahan ekstrem di lokasi syuting adalah bom waktu yang tidak boleh dinormalisasi atas nama kompromi anggaran.</p><p>Penyusunan standar upah minimum, jaminan perlindungan asuransi kecelakaan kerja, serta perjanjian kerja standar berbasis asosiasi profesi dan SKKNI adalah keharusan mutlak. Industri perfilman yang sehat dan beradab adalah industri yang memuliakan martabat setiap pekerjanya di balik layar.</p>',
                        'kutipan' => 'Industri perfilman yang sehat diukur bukan hanya dari torehan box office, tetapi dari keadilan dan keselamatan para pekerja di balik layarnya.',
                    ],
                    'en' => [
                        'kategori' => 'Opinion',
                        'judul' => 'Examining Regulatory Pathways and Fair Labor Standards in the Indonesian Film Industry',
                        'ringkasan' => 'A comprehensive examination of the necessity for standard working hours on set, occupational safety, and fair contractual terms for all film production crews.',
                        'isi' => '<p>The exponential growth of feature film and streaming series productions over recent years underscores the maturity of the Indonesian cinema marketplace. Nevertheless, behind the box office triumphs and soaring admissions lies a fundamental labor issue demanding urgent systemic address: humane on-set working hour limits and comprehensive occupational safety standards for technical crews.</p><p>Shoots extending beyond 16 to 20 consecutive hours without adequate rest intervals present severe physical and psychological health hazards while simultaneously impairing creative output quality. Extreme set fatigue is a ticking time bomb that must never be normalized under the guise of production budgeting compromises.</p><p>Establishing minimum wage thresholds, mandatory occupational health and accident insurance, and standard contracts anchored in professional guild frameworks and SKKNI certifications is an urgent necessity. A dignified film industry is one that honors and protects every crew member behind the camera.</p>',
                        'kutipan' => 'A healthy cinema industry is evaluated not merely by box office revenues, but by the dignity, safety, and welfare of the workforce behind the scenes.',
                    ],
                ],
            ],
        ];

        // 6. Insert Berita & Translations
        foreach ($beritaList as $data) {
            $berita = Berita::create([
                'slug' => $data['slug'],
                'gambar_utama' => $data['gambar_utama'],
                'penulis' => $data['penulis'],
                'tanggal_publikasi' => $data['tanggal_publikasi'],
                'status' => $data['status'],
            ]);

            foreach ($data['translations'] as $kode => $trans) {
                $berita->translations()->create([
                    'bahasa' => $kode,
                    'judul' => $trans['judul'],
                    'ringkasan' => $trans['ringkasan'],
                    'isi' => $trans['isi'],
                    'kategori' => $trans['kategori'],
                    'kutipan' => $trans['kutipan'] ?? null,
                ]);
            }

            // Sync tags
            if (! empty($data['tags'])) {
                $tagIds = [];
                foreach ($data['tags'] as $tagSlug) {
                    if (isset($tagMap[$tagSlug])) {
                        $tagIds[] = $tagMap[$tagSlug];
                    }
                }
                if (! empty($tagIds)) {
                    $berita->tags()->sync($tagIds);
                }
            }
        }

        $this->command->info('BeritaSeeder berhasil dijalankan: 2 data kategori "Berita" dan 2 data kategori "Opini" berhasil di-seed.');
    }
}
