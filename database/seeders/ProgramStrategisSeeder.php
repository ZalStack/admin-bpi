<?php

namespace Database\Seeders;

use App\Models\Bahasa;
use App\Models\Program;
use App\Models\ProgramPoin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStrategisSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pastikan record bahasa tersedia agar relasi foreign key aman
        Bahasa::firstOrCreate(
            ['kode' => 'id'],
            ['nama' => 'Bahasa Indonesia', 'aktif' => true, 'is_default' => true]
        );
        Bahasa::firstOrCreate(
            ['kode' => 'en'],
            ['nama' => 'English', 'aktif' => true, 'is_default' => false]
        );

        // 2. Bersihkan data program sebelumnya agar idempoten
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('program_poin_translations')->delete();
        DB::table('program_poin')->delete();
        DB::table('program_translations')->delete();
        DB::table('program')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        // 3. 4 Pilar Program Strategis BPI
        $programs = [
            [
                'urutan' => 1,
                'icon' => 'fa-solid fa-graduation-cap',
                'gambar' => null,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Pengembangan Kapasitas & Standardisasi Profesi Perfilman',
                        'deskripsi' => 'Mendorong akselerasi kompetensi tenaga kerja film nasional melalui sertifikasi kompetensi kerja (SKKNI), program inkubasi terarah, dan pelatihan teknis berstandar global.',
                    ],
                    'en' => [
                        'judul' => 'Capacity Building & Film Professional Standardization',
                        'deskripsi' => 'Accelerating national film workforce competencies through SKKNI professional certifications, targeted incubation programs, and global-standard technical workshops.',
                    ],
                ],
                'poin' => [
                    [
                        'urutan' => 1,
                        'icon' => 'fa-solid fa-id-card',
                        'translations' => [
                            'id' => [
                                'judul' => 'Pelatihan & Sertifikasi Profesi berbasis SKKNI untuk 12 Asosiasi Profesi',
                                'deskripsi' => 'Program sertifikasi kompetensi berstandar BNSP guna menjamin profesionalisme dan daya saing tenaga kerja film Indonesia.',
                            ],
                            'en' => [
                                'judul' => 'SKKNI-based Professional Certification for 12 Film Guilds & Associations',
                                'deskripsi' => 'BNSP-standardized competency certification to guarantee professionalism and global competitiveness of local filmmakers.',
                            ],
                        ],
                    ],
                    [
                        'urutan' => 2,
                        'icon' => 'fa-solid fa-user-astronaut',
                        'translations' => [
                            'id' => [
                                'judul' => 'Program Inkubasi & Mentoring Sineas Muda Daerah',
                                'deskripsi' => 'Pendampingan langsung oleh praktisi perfilman senior untuk memperkuat kapasitas sutradara dan produser muda lintas provinsi.',
                            ],
                            'en' => [
                                'judul' => 'Incubation & Mentorship Program for Emerging Regional Filmmakers',
                                'deskripsi' => 'Direct guidance by senior film practitioners to bolster emerging directors and producers across Indonesian provinces.',
                            ],
                        ],
                    ],
                    [
                        'urutan' => 3,
                        'icon' => 'fa-solid fa-pen-nib',
                        'translations' => [
                            'id' => [
                                'judul' => 'Lokakarya Kurasi, Penulisan Skenario, dan Tata Artistik',
                                'deskripsi' => 'Pelatihan intensif pengembangan naskah cerita dan penyutradaraan berstandar festival dan pasar komersial internasional.',
                            ],
                            'en' => [
                                'judul' => 'Advanced Workshops in Curation, Screenwriting, and Production Design',
                                'deskripsi' => 'Intensive story development and directing masterclasses benchmarked to international festival and commercial standards.',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'urutan' => 2,
                'icon' => 'fa-solid fa-scale-balanced',
                'gambar' => null,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Advokasi Kebijakan & Regulasi Industri Perfilman',
                        'deskripsi' => 'Memperjuangkan kepastian regulasi yang berkeadilan, perlindungan hak cipta dan royalti sineas, serta penyusunan panduan standar upah minimum dan keselamatan kerja di lokasi syuting.',
                    ],
                    'en' => [
                        'judul' => 'Film Policy Advocacy & Industry Governance',
                        'deskripsi' => 'Championing fair regulations, copyright and royalty protections for filmmakers, and setting health, safety, and wage guidelines on production sets.',
                    ],
                ],
                'poin' => [
                    [
                        'urutan' => 1,
                        'icon' => 'fa-solid fa-landmark',
                        'translations' => [
                            'id' => [
                                'judul' => 'Harmonisasi Regulasi Perfilman bersama Kementerian & Lembaga Terkait',
                                'deskripsi' => 'Sinkronisasi kebijakan lintas kementerian guna menciptakan ekosistem industri film yang kondusif dan ramah investasi.',
                            ],
                            'en' => [
                                'judul' => 'Film Regulatory Harmonization with Relevant Ministries & Agencies',
                                'deskripsi' => 'Inter-ministerial policy synchronization to establish an enabling and investment-friendly cinematic industry ecosystem.',
                            ],
                        ],
                    ],
                    [
                        'urutan' => 2,
                        'icon' => 'fa-solid fa-shield-halved',
                        'translations' => [
                            'id' => [
                                'judul' => 'Penegakan Perlindungan Hak Kekayaan Intelektual (HAKI) & Anti-Pirasi',
                                'deskripsi' => 'Advokasi hukum dan inisiatif terintegrasi dalam meminimalisasi pembajakan konten digital serta tata kelola royalti transparan.',
                            ],
                            'en' => [
                                'judul' => 'Enforcement of Intellectual Property Rights (IPR) & Anti-Piracy Measures',
                                'deskripsi' => 'Legal advocacy and integrated initiatives to curb digital film piracy and promote transparent royalty management.',
                            ],
                        ],
                    ],
                    [
                        'urutan' => 3,
                        'icon' => 'fa-solid fa-hard-hat',
                        'translations' => [
                            'id' => [
                                'judul' => 'Standar Operasional Keselamatan Kerja & Kontrak Kerja Berkeadilan',
                                'deskripsi' => 'Pedoman jam kerja yang manusiawi, jaminan asuransi ketenagakerjaan, serta kontrak standar bagi seluruh kru produksi film.',
                            ],
                            'en' => [
                                'judul' => 'Standard Operating Procedures for On-Set Safety & Fair Labor Contracts',
                                'deskripsi' => 'Humane working hours guidelines, occupational accident insurance, and equitable standard contracts for production crews.',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'urutan' => 3,
                'icon' => 'fa-solid fa-coins',
                'gambar' => null,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Fasilitasi Pembiayaan & Akses Permodalan Film',
                        'deskripsi' => 'Menjembatani produser film independen dengan investor privat, skema hibah negara, perbankan nasional, serta platform pendanaan internasional untuk keberlanjutan produksi.',
                    ],
                    'en' => [
                        'judul' => 'Film Financing & Investment Access Facilitation',
                        'deskripsi' => 'Bridging independent film producers with private investors, public grant schemes, national banks, and international funding platforms for production sustainability.',
                    ],
                ],
                'poin' => [
                    [
                        'urutan' => 1,
                        'icon' => 'fa-solid fa-handshake',
                        'translations' => [
                            'id' => [
                                'judul' => 'Penyelenggaraan Forum Pertemuan Produser & Investor Film (Pitching Market)',
                                'deskripsi' => 'Ruang temu kurasi proyek film berkualitas dengan pemodal ventura, perbankan, dan private equity.',
                            ],
                            'en' => [
                                'judul' => 'Organization of Producer-Investor Pitching & Matchmaking Forums',
                                'deskripsi' => 'Curated matchmaking platforms connecting high-potential film packages with venture capital, banks, and private equity.',
                            ],
                        ],
                    ],
                    [
                        'urutan' => 2,
                        'icon' => 'fa-solid fa-file-invoice-dollar',
                        'translations' => [
                            'id' => [
                                'judul' => 'Fasilitasi Insentif Pajak & Skema Co-Production Financing Internasional',
                                'deskripsi' => 'Advokasi insentif fiskal / cash rebate produksi film di Indonesia dan integrasi dengan dana permodalan internasional.',
                            ],
                            'en' => [
                                'judul' => 'Tax Incentives Facilitation & International Co-Production Financing',
                                'deskripsi' => 'Fiscal incentives and production cash rebate advocacy alongside integration with global co-production funds.',
                            ],
                        ],
                    ],
                    [
                        'urutan' => 3,
                        'icon' => 'fa-solid fa-chart-pie',
                        'translations' => [
                            'id' => [
                                'judul' => 'Pendampingan Literasi Keuangan & Business Plan Produksi Film',
                                'deskripsi' => 'Bimbingan teknis penyusunan prospektus investasi, manajemen anggaran, dan proyeksi return of investment (ROI).',
                            ],
                            'en' => [
                                'judul' => 'Financial Literacy Mentorship & Film Production Business Planning',
                                'deskripsi' => 'Technical assistance on structuring investment prospectuses, budget governance, and accurate ROI forecasting.',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'urutan' => 4,
                'icon' => 'fa-solid fa-globe',
                'gambar' => null,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Diplomasi Budaya & Promosi Internasional',
                        'deskripsi' => 'Membawa karya sinema Indonesia ke panggung festival kelas dunia (A-list festivals) dan pasar film internasional guna memperluas distribusi dan apresiasi global.',
                    ],
                    'en' => [
                        'judul' => 'Cultural Diplomacy & International Film Promotion',
                        'deskripsi' => 'Bringing Indonesian cinematic masterpieces to A-list international film festivals and global film markets to expand worldwide distribution and cultural appreciation.',
                    ],
                ],
                'poin' => [
                    [
                        'urutan' => 1,
                        'icon' => 'fa-solid fa-plane-departure',
                        'translations' => [
                            'id' => [
                                'judul' => 'Pengiriman Delegasi Resmi Indonesia ke Pasar Film Cannes, Busan, & TIFF',
                                'deskripsi' => 'Partisipasi terpadu dalam pasar film utama dunia untuk membuka kesepakatan sales rights dan distribusi mancanegara.',
                            ],
                            'en' => [
                                'judul' => 'Official Indonesian Delegation Deployment to Cannes, Busan, and TIFF Markets',
                                'deskripsi' => 'Unified national participation in premier global film markets to secure overseas theatrical sales and distribution agreements.',
                            ],
                        ],
                    ],
                    [
                        'urutan' => 2,
                        'icon' => 'fa-solid fa-building-flag',
                        'translations' => [
                            'id' => [
                                'judul' => 'Inisiatif Paviliun Indonesia di Forum Bisnis Film Global',
                                'deskripsi' => 'Representasi etalase perfilman nusantara untuk mempromosikan lokasi syuting, talenta lokal, dan peluang investasi di Indonesia.',
                            ],
                            'en' => [
                                'judul' => 'Indonesian Pavilion Presence at Leading Global Film Industry Forums',
                                'deskripsi' => 'Comprehensive showcase promoting exotic national filming locations, local creative talent, and inward production investment.',
                            ],
                        ],
                    ],
                    [
                        'urutan' => 3,
                        'icon' => 'fa-solid fa-film',
                        'translations' => [
                            'id' => [
                                'judul' => 'Penyelenggaraan Pekan Sinema Indonesia di Berbagai Ibu Kota Dunia',
                                'deskripsi' => 'Diplomasi lunak (soft power) melalui eksibisi film berkala yang berkolaborasi dengan KBRI dan konsulat jenderal RI.',
                            ],
                            'en' => [
                                'judul' => 'Indonesian Film Week Roadshows across Major World Cultural Capitals',
                                'deskripsi' => 'Cultural soft-power diplomacy through curated Indonesian cinema showcases co-hosted with overseas diplomatic missions.',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($programs as $progData) {
            $program = Program::create([
                'icon' => $progData['icon'],
                'gambar' => $progData['gambar'],
                'urutan' => $progData['urutan'],
                'status' => $progData['status'],
            ]);

            // Translations
            foreach ($progData['translations'] as $kode => $trans) {
                $program->translations()->create([
                    'bahasa' => $kode,
                    'judul' => $trans['judul'],
                    'deskripsi' => $trans['deskripsi'],
                ]);
            }

            // Sub-poin
            foreach ($progData['poin'] as $poinData) {
                $poin = ProgramPoin::create([
                    'program_id' => $program->id,
                    'icon' => $poinData['icon'],
                    'urutan' => $poinData['urutan'],
                    'status' => true,
                ]);

                foreach ($poinData['translations'] as $kode => $pTrans) {
                    $poin->translations()->create([
                        'bahasa' => $kode,
                        'judul' => $pTrans['judul'],
                        'deskripsi' => $pTrans['deskripsi'],
                    ]);
                }
            }
        }

        $this->command->info('ProgramStrategisSeeder berhasil dijalankan: 4 Pilar Program Strategis BPI dan sub-poin berhasil di-seed.');
    }
}
