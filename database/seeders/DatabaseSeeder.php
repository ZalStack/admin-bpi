<?php

namespace Database\Seeders;

use App\Models\BannerHalaman;
use App\Models\Beranda;
use App\Models\Berita;
use App\Models\BeritaGaleri;
use App\Models\Footer;
use App\Models\Kontak;
use App\Models\KontakEmail;
use App\Models\KontakPhone;
use App\Models\KontakSocialMedia;
use App\Models\Menu;
use App\Models\Mitra;
use App\Models\Program;
use App\Models\ProgramPoin;
use App\Models\Proyek;
use App\Models\ProyekGaleri;
use App\Models\Stakeholder;
use App\Models\StrukturOrganisasi;
use App\Models\Tag;
use App\Models\Tentang;
use App\Models\TentangPoin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN & MASTER DATA BAHASA
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Admin BPI',
            'email' => 'admin.bpi@gmail.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Pastikan Anda sudah memiliki BahasaSeeder
        $this->call(BahasaSeeder::class);

        /*
        |--------------------------------------------------------------------------
        | BANNER HALAMAN
        |--------------------------------------------------------------------------
        */

        $this->seedMany(BannerHalaman::class, [
            [
                'halaman' => 'home',
                'gambar' => null,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Menjaga, Memfokuskan, dan Mendorong Perfilman Indonesia',
                        'deskripsi' => 'BPI menghubungkan lebih dari 50 asosiasi profesi dan seluruh insan kreatif perfilman Indonesia untuk bergerak bersama menuju industri yang inklusif, sehat, dan berdaya saing global.',
                    ],
                    'en' => [
                        'judul' => 'Strengthening, Focusing, and Advancing Indonesian Cinema',
                        'deskripsi' => 'BPI connects more than 50 professional associations and creative people in the Indonesian film industry to move together toward an inclusive, healthy, and globally competitive industry.',
                    ],
                ],
            ],
            [
                'halaman' => 'stakeholders',
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Menyatu dalam Ekosistem, Menggerakkan Sinema Nasional',
                        'deskripsi' => 'BPI menghubungkan lebih dari 50 asosiasi profesi dan seluruh insan kreatif perfilman Indonesia untuk bergerak bersama menuju industri yang inklusif, sehat, dan berdaya saing global.',
                    ],
                    'en' => [
                        'judul' => 'United in the Ecosystem, Driving National Cinema',
                        'deskripsi' => 'BPI connects more than 50 professional associations and creative people in the Indonesian film industry to move together toward an inclusive, healthy, and globally competitive industry.',
                    ],
                ],
            ],
            [
                'halaman' => 'program',
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Mengakselerasi Potensi, Memfokuskan Arah Industri',
                        'deskripsi' => 'Inisiatif strategis BPI yang berorientasi pada peningkatan kompetensi SDM, perlindungan HAKI, advokasi kebijakan, hingga penetrasi pasar dunia.',
                    ],
                    'en' => [
                        'judul' => 'Accelerating Potential, Focusing the Industry Direction',
                        'deskripsi' => 'BPI strategic initiatives focus on improving human resources, protecting intellectual property rights, policy advocacy, and global market penetration.',
                    ],
                ],
            ],
            [
                'halaman' => 'proyek',
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Memproyeksikan Inovasi dan Masa Depan Sinema',
                        'deskripsi' => 'Rekam jejak proyek strategis dan inisiatif BPI yang dirancang untuk membuka peluang baru, merangkul teknologi, serta memperkuat infrastruktur perfilman nasional.',
                    ],
                    'en' => [
                        'judul' => 'Projecting Innovation and the Future of Cinema',
                        'deskripsi' => 'A record of BPI strategic projects and initiatives designed to create new opportunities, embrace technology, and strengthen the national film infrastructure.',
                    ],
                ],
            ],
            [
                'halaman' => 'mitra',
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Merajut Sinergi, Meluaskan Jangkauan Proyeksi',
                        'deskripsi' => 'BPI menghubungkan lebih dari 50 asosiasi profesi dan seluruh insan kreatif perfilman Indonesia untuk bergerak bersama menuju industri yang inklusif, sehat, dan berdaya saing global.',
                    ],
                    'en' => [
                        'judul' => 'Building Synergy, Expanding Our Reach',
                        'deskripsi' => 'BPI connects more than 50 professional associations and creative people in the Indonesian film industry to move together toward an inclusive, healthy, and globally competitive industry.',
                    ],
                ],
            ],
            [
                'halaman' => 'berita',
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Denyut Pergerakan dan Kabar Terkini Perfilman',
                        'deskripsi' => 'Informasi terbaru mengenai dinamika, kebijakan, perkembangan industri, serta berbagai kegiatan perfilman Indonesia.',
                    ],
                    'en' => [
                        'judul' => 'The Pulse and Latest News of Indonesian Cinema',
                        'deskripsi' => 'The latest information on dynamics, policies, industry developments, and activities in Indonesian cinema.',
                    ],
                ],
            ],
            [
                'halaman' => 'tentang',
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Lensa Penggerak dan Akselerator Sinema Indonesia',
                        'deskripsi' => 'BPI hadir untuk memfokuskan, memperkuat, dan menggerakkan ekosistem perfilman Indonesia menuju industri yang sehat, inklusif, dan berkelanjutan.',
                    ],
                    'en' => [
                        'judul' => 'The Lens Driving and Accelerating Indonesian Cinema',
                        'deskripsi' => 'BPI exists to focus, strengthen, and drive the Indonesian film ecosystem toward a healthy, inclusive, and sustainable industry.',
                    ],
                ],
            ],
            [
                'halaman' => 'kontak',
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Terhubung, Berkolaborasi, dan Bergerak Bersama Sinema Indonesia',
                        'deskripsi' => 'BPI membuka ruang dialog dan kolaborasi bagi seluruh insan, organisasi, komunitas, dan mitra perfilman Indonesia.',
                    ],
                    'en' => [
                        'judul' => 'Connect, Collaborate, and Move Together with Indonesian Cinema',
                        'deskripsi' => 'BPI opens opportunities for dialogue and collaboration with people, organizations, communities, and partners in Indonesian cinema.',
                    ],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | BERANDA
        |--------------------------------------------------------------------------
        */

        $this->seedMany(Beranda::class, [
            [
                'section' => 'hero',
                'gambar' => null,
                'icon' => null,
                'urutan' => 1,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Menjaga, Memfokuskan, dan Mendorong Perfilman Indonesia',
                        'deskripsi' => 'BPI menghubungkan lebih dari 50 asosiasi profesi dan seluruh insan kreatif perfilman Indonesia untuk bergerak bersama menuju industri yang inklusif, sehat, dan berdaya saing global.',
                    ],
                    'en' => [
                        'judul' => 'Strengthening, Focusing, and Advancing Indonesian Cinema',
                        'deskripsi' => 'BPI connects more than 50 professional associations and creative people in the Indonesian film industry to move together toward an inclusive, healthy, and globally competitive industry.',
                    ],
                ],
            ],
            [
                'section' => 'tentang',
                'urutan' => 2,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Membangun Masa Depan Sinema Nasional',
                        'deskripsi' => 'Badan Perfilman Indonesia (BPI) hadir sebagai wadah strategis yang menghubungkan berbagai pemangku kepentingan perfilman untuk membangun ekosistem industri yang sehat, inklusif, dan berkelanjutan.',
                    ],
                    'en' => [
                        'judul' => 'Building the Future of National Cinema',
                        'deskripsi' => 'Badan Perfilman Indonesia (BPI) serves as a strategic platform connecting stakeholders in the film industry to build a healthy, inclusive, and sustainable ecosystem.',
                    ],
                ],
            ],
            [
                'section' => 'struktur',
                'icon' => 'fa-solid fa-users',
                'urutan' => 3,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Struktur Organisasi',
                        'deskripsi' => 'BPI didukung oleh insan perfilman dari berbagai latar belakang profesi yang bekerja bersama untuk memajukan ekosistem perfilman Indonesia.',
                    ],
                    'en' => [
                        'judul' => 'Organizational Structure',
                        'deskripsi' => 'BPI is supported by film industry professionals from diverse backgrounds who work together to advance the Indonesian film ecosystem.',
                    ],
                ],
            ],
            [
                'section' => 'proyek',
                'icon' => 'fa-solid fa-film',
                'urutan' => 4,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Proyek Kolaborasi',
                        'deskripsi' => 'Berbagai proyek strategis BPI bersama mitra dan stakeholder untuk menciptakan dampak nyata bagi industri perfilman.',
                    ],
                    'en' => [
                        'judul' => 'Collaborative Projects',
                        'deskripsi' => 'Strategic BPI projects with partners and stakeholders to create meaningful impact for the film industry.',
                    ],
                ],
            ],
            [
                'section' => 'program',
                'icon' => 'fa-solid fa-chart-line',
                'urutan' => 5,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Program Strategis',
                        'deskripsi' => 'Program strategis untuk memperkuat fondasi, meningkatkan kapasitas, memperluas kolaborasi, dan menciptakan dampak berkelanjutan.',
                    ],
                    'en' => [
                        'judul' => 'Strategic Programs',
                        'deskripsi' => 'Strategic programs designed to strengthen foundations, improve capacity, expand collaboration, and create sustainable impact.',
                    ],
                ],
            ],
            [
                'section' => 'berita',
                'icon' => 'fa-solid fa-newspaper',
                'urutan' => 6,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Artikel & Berita',
                        'deskripsi' => 'Ikuti perkembangan terbaru mengenai kebijakan, kegiatan, program, dan dinamika industri perfilman Indonesia.',
                    ],
                    'en' => [
                        'judul' => 'Articles & News',
                        'deskripsi' => 'Follow the latest developments in policies, activities, programs, and dynamics of the Indonesian film industry.',
                    ],
                ],
            ],
            [
                'section' => 'mitra',
                'icon' => 'fa-solid fa-handshake',
                'urutan' => 7,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Mitra Kami',
                        'deskripsi' => 'Bersama mitra strategis, internasional, industri, dan komunitas untuk memperkuat ekosistem perfilman Indonesia.',
                    ],
                    'en' => [
                        'judul' => 'Our Partners',
                        'deskripsi' => 'Together with strategic, international, industry, and community partners to strengthen the Indonesian film ecosystem.',
                    ],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | STAKEHOLDER
        |--------------------------------------------------------------------------
        */

        $this->seedMany(Stakeholder::class, [
            [
                'icon' => 'fa-solid fa-building-columns',
                'gambar' => null,
                'urutan' => 1,
                'status' => true,
                'translations' => [
                    'id' => ['nama' => 'Pemerintah', 'deskripsi' => 'Lembaga pemerintah yang memiliki peran dalam kebijakan dan pengembangan industri perfilman Indonesia.'],
                    'en' => ['nama' => 'Government', 'deskripsi' => 'Government institutions involved in policy and the development of the Indonesian film industry.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-clapperboard',
                'urutan' => 2,
                'status' => true,
                'translations' => [
                    'id' => ['nama' => 'Produser', 'deskripsi' => 'Pelaku industri yang mengelola dan mengembangkan produksi karya film.'],
                    'en' => ['nama' => 'Producers', 'deskripsi' => 'Industry professionals responsible for managing and developing film productions.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-film',
                'urutan' => 3,
                'status' => true,
                'translations' => [
                    'id' => ['nama' => 'Sineas', 'deskripsi' => 'Para kreator dan profesional yang menghasilkan karya perfilman Indonesia.'],
                    'en' => ['nama' => 'Filmmakers', 'deskripsi' => 'Creators and professionals producing Indonesian film works.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-users',
                'urutan' => 4,
                'status' => true,
                'translations' => [
                    'id' => ['nama' => 'Asosiasi Profesi', 'deskripsi' => 'Organisasi profesi yang menjadi bagian penting dari ekosistem perfilman nasional.'],
                    'en' => ['nama' => 'Professional Associations', 'deskripsi' => 'Professional organizations that form an important part of the national film ecosystem.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-people-group',
                'urutan' => 5,
                'status' => true,
                'translations' => [
                    'id' => ['nama' => 'Komunitas', 'deskripsi' => 'Komunitas film yang berperan dalam membangun kreativitas dan partisipasi masyarakat.'],
                    'en' => ['nama' => 'Communities', 'deskripsi' => 'Film communities that contribute to creativity and public participation.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-school',
                'urutan' => 6,
                'status' => true,
                'translations' => [
                    'id' => ['nama' => 'Lembaga Pendidikan', 'deskripsi' => 'Institusi pendidikan yang mendukung pengembangan sumber daya manusia perfilman.'],
                    'en' => ['nama' => 'Educational Institutions', 'deskripsi' => 'Educational institutions supporting the development of film industry talent.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-building',
                'urutan' => 7,
                'status' => true,
                'translations' => [
                    'id' => ['nama' => 'Pelaku Industri', 'deskripsi' => 'Pelaku usaha dan organisasi yang mendukung rantai nilai industri perfilman.'],
                    'en' => ['nama' => 'Industry Players', 'deskripsi' => 'Businesses and organizations supporting the film industry value chain.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-briefcase',
                'urutan' => 8,
                'status' => true,
                'translations' => [
                    'id' => ['nama' => 'Distributor', 'deskripsi' => 'Mitra yang membantu memperluas distribusi karya film ke berbagai wilayah.'],
                    'en' => ['nama' => 'Distributors', 'deskripsi' => 'Partners helping expand film distribution across different regions.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-building',
                'urutan' => 9,
                'status' => true,
                'translations' => [
                    'id' => ['nama' => 'Eksibitor', 'deskripsi' => 'Pelaku yang menyediakan ruang dan akses bagi masyarakat untuk menikmati karya film.'],
                    'en' => ['nama' => 'Exhibitors', 'deskripsi' => 'Industry players providing spaces and access for audiences to experience films.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-ticket',
                'urutan' => 10,
                'status' => true,
                'translations' => [
                    'id' => ['nama' => 'Festival Film', 'deskripsi' => 'Festival dan ajang perfilman yang menjadi ruang apresiasi dan promosi karya.'],
                    'en' => ['nama' => 'Film Festivals', 'deskripsi' => 'Film festivals and events serving as platforms for appreciation and promotion.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-newspaper',
                'urutan' => 11,
                'status' => true,
                'translations' => [
                    'id' => ['nama' => 'Media', 'deskripsi' => 'Media yang berperan dalam menyebarkan informasi dan perkembangan industri perfilman.'],
                    'en' => ['nama' => 'Media', 'deskripsi' => 'Media organizations that distribute information about the film industry.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-users',
                'urutan' => 12,
                'status' => true,
                'translations' => [
                    'id' => ['nama' => 'Masyarakat', 'deskripsi' => 'Masyarakat sebagai penonton, pengguna, sekaligus bagian dari ekosistem perfilman Indonesia.'],
                    'en' => ['nama' => 'Public', 'deskripsi' => 'The public as audiences, users, and an essential part of the Indonesian film ecosystem.'],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | PROGRAM STRATEGIS
        |--------------------------------------------------------------------------
        */

        $this->seedMany(Program::class, [
            [
                'icon' => 'fa-solid fa-money-bill-wave',
                'gambar' => null,
                'urutan' => 1,
                'status' => true,
                'translations' => [
                    'id' => ['judul' => 'Pembiayaan', 'deskripsi' => 'Mendorong inovasi melalui program kreatif dan akses modal yang berkelanjutan.'],
                    'en' => ['judul' => 'Financing', 'deskripsi' => 'Encouraging innovation through creative programs and sustainable access to financing.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-globe',
                'urutan' => 2,
                'status' => true,
                'translations' => [
                    'id' => ['judul' => 'Pasar Global', 'deskripsi' => 'Memperluas jangkauan film Indonesia ke pasar global melalui promosi, kolaborasi, dan kemitraan strategis.'],
                    'en' => ['judul' => 'Global Market', 'deskripsi' => 'Expanding Indonesian films into global markets through promotion, collaboration, and strategic partnerships.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-graduation-cap',
                'urutan' => 3,
                'status' => true,
                'translations' => [
                    'id' => ['judul' => 'Pengembangan Talenta', 'deskripsi' => 'Fasilitasi peningkatan kualitas dan kesiapan talenta melalui berbagai program pengembangan.'],
                    'en' => ['judul' => 'Talent Development', 'deskripsi' => 'Facilitating talent quality and readiness through various development programs.'],
                ],
            ],
            [
                'icon' => 'fa-solid fa-building',
                'urutan' => 4,
                'status' => true,
                'translations' => [
                    'id' => ['judul' => 'Infrastruktur', 'deskripsi' => 'Memperkuat ekosistem produksi melalui dukungan fasilitas, teknologi, dan layanan terpadu.'],
                    'en' => ['judul' => 'Infrastructure', 'deskripsi' => 'Strengthening the production ecosystem through facilities, technology, and integrated services.'],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | PROGRAM POIN (Sub-items per Program)
        |--------------------------------------------------------------------------
        */

        $programs = Program::all();

        $programPoinData = [
            // Pembiayaan (program_id 1)
            1 => [
                ['icon' => 'fa-solid fa-coins', 'urutan' => 1, 'judul_id' => 'Dana Pembiayaan Produktif', 'judul_en' => 'Productive Financing Fund', 'deskripsi_id' => 'Akses pendanaan bagi produksi film Indonesia.', 'deskripsi_en' => 'Access to funding for Indonesian film production.'],
                ['icon' => 'fa-solid fa-hand-holding-dollar', 'urutan' => 2, 'judul_id' => 'Insentif Fiskal', 'judul_en' => 'Fiscal Incentives', 'deskripsi_id' => 'Kemudahan pajak dan insentif bagi pelaku industri.', 'deskripsi_en' => 'Tax facilities and incentives for industry players.'],
                ['icon' => 'fa-solid fa-piggy-bank', 'urutan' => 3, 'judul_id' => 'Skema Co-Financing', 'judul_en' => 'Co-Financing Scheme', 'deskripsi_id' => 'Kerja sama pendanaan bersama mitra dan investor.', 'deskripsi_en' => 'Joint funding collaboration with partners and investors.'],
            ],
            // Pasar Global (program_id 2)
            2 => [
                ['icon' => 'fa-solid fa-earth-americas', 'urutan' => 1, 'judul_id' => 'Promosi Internasional', 'judul_en' => 'International Promotion', 'deskripsi_id' => 'Pemasaran film Indonesia di pasar global.', 'deskripsi_en' => 'Marketing Indonesian films in global markets.'],
                ['icon' => 'fa-solid fa-handshake', 'urutan' => 2, 'judul_id' => 'Kemitraan Strategis', 'judul_en' => 'Strategic Partnerships', 'deskripsi_id' => 'Jaringan kerja sama dengan lembaga perfilman dunia.', 'deskripsi_en' => 'Collaboration network with world film institutions.'],
                ['icon' => 'fa-solid fa-ticket', 'urutan' => 3, 'judul_id' => 'Festival & Market', 'judul_en' => 'Festivals & Markets', 'deskripsi_id' => 'Partisipasi aktif dalam festival dan market internasional.', 'deskripsi_en' => 'Active participation in international festivals and markets.'],
            ],
            // Pengembangan Talenta (program_id 3)
            3 => [
                ['icon' => 'fa-solid fa-graduation-cap', 'urutan' => 1, 'judul_id' => 'Program Pendidikan', 'judul_en' => 'Education Programs', 'deskripsi_id' => 'Pelatihan dan workshop untuk talenta perfilman.', 'deskripsi_en' => 'Training and workshops for film talent.'],
                ['icon' => 'fa-solid fa-users', 'urutan' => 2, 'judul_id' => 'Mentoring & Residensi', 'judul_en' => 'Mentoring & Residency', 'deskripsi_id' => 'Pendampingan dan program residensi sineas muda.', 'deskripsi_en' => 'Mentoring and residency programs for young filmmakers.'],
                ['icon' => 'fa-solid fa-earth-asia', 'urutan' => 3, 'judul_id' => 'Mobilitas Talenta', 'judul_en' => 'Talent Mobility', 'deskripsi_id' => 'Pertukaran dan kolaborasi lintas negara.', 'deskripsi_en' => 'Cross-border talent exchange and collaboration.'],
            ],
            // Infrastruktur (program_id 4)
            4 => [
                ['icon' => 'fa-solid fa-building', 'urutan' => 1, 'judul_id' => 'Sarana Produksi', 'judul_en' => 'Production Facilities', 'deskripsi_id' => 'Pengembangan studio dan fasilitas produksi.', 'deskripsi_en' => 'Development of studios and production facilities.'],
                ['icon' => 'fa-solid fa-microchip', 'urutan' => 2, 'judul_id' => 'Teknologi Digital', 'judul_en' => 'Digital Technology', 'deskripsi_id' => 'Penerapan teknologi terkini dalam produksi film.', 'deskripsi_en' => 'Implementation of latest technology in film production.'],
                ['icon' => 'fa-solid fa-network-wired', 'urutan' => 3, 'judul_id' => 'Distribusi Digital', 'judul_en' => 'Digital Distribution', 'deskripsi_id' => 'Platform dan infrastruktur distribusi digital.', 'deskripsi_en' => 'Digital distribution platforms and infrastructure.'],
            ],
        ];

        foreach ($programs as $program) {
            if (isset($programPoinData[$program->id])) {
                foreach ($programPoinData[$program->id] as $poinData) {
                    ProgramPoin::create([
                        'program_id' => $program->id,
                        'icon' => $poinData['icon'],
                        'urutan' => $poinData['urutan'],
                        'status' => true,
                    ])->storeTranslations([
                        'id' => [
                            'judul' => $poinData['judul_id'],
                            'deskripsi' => $poinData['deskripsi_id'],
                        ],
                        'en' => [
                            'judul' => $poinData['judul_en'],
                            'deskripsi' => $poinData['deskripsi_en'],
                        ],
                    ]);
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | PROYEK
        |--------------------------------------------------------------------------
        */

        $projects = $this->seedMany(Proyek::class, [
            [
                'slug' => 'bpi-film-market',
                'gambar_utama' => null,
                'tahun' => '2022 - Sekarang',
                'status' => 'published',
                'urutan' => 1,
                'translations' => [
                    'id' => [
                        'judul' => 'BPI Film Market',
                        'kategori' => 'Pasar Film',
                        'deskripsi_singkat' => 'Pasar film nasional untuk mempertemukan pelaku industri, memperluas jaringan, dan mendorong pendanaan serta kerja sama produksi.',
                        'deskripsi' => 'BPI Film Market adalah wadah strategis bagi produser, investor, distributor, lembaga pemerintah, dan pemangku kepentingan lainnya untuk mempertemukan kebutuhan dan peluang dalam industri perfilman Indonesia.',
                        'lokasi' => 'Jakarta, Indonesia',
                        'icon' => 'fa-film',
                        'ruang_lingkup' => 'Nasional & Internasional',
                        'status_proyek' => 'Berjalan',
                        'timeline' => '2022 - Sekarang',
                    ],
                    'en' => [
                        'judul' => 'BPI Film Market',
                        'kategori' => 'Film Market',
                        'deskripsi_singkat' => 'A national film market connecting industry players, expanding networks, and encouraging financing and production collaboration.',
                        'deskripsi' => 'BPI Film Market is a strategic platform for producers, investors, distributors, government institutions, and other stakeholders to connect needs and opportunities within the Indonesian film industry.',
                        'lokasi' => 'Jakarta, Indonesia',
                        'icon' => 'fa-film',
                        'ruang_lingkup' => 'National & International',
                        'status_proyek' => 'Running',
                        'timeline' => '2022 - Present',
                    ],
                ],
            ],
            [
                'slug' => 'indonesia-film-festival-network',
                'tahun' => '2023 - Sekarang',
                'status' => 'published',
                'urutan' => 2,
                'translations' => [
                    'id' => [
                        'judul' => 'Indonesia Film Festival Network',
                        'kategori' => 'Festival',
                        'deskripsi_singkat' => 'Jaringan festival film di berbagai daerah untuk memperluas akses apresiasi dan distribusi film Indonesia.',
                        'deskripsi' => 'Program penguatan jaringan festival film Indonesia sebagai ruang bertemunya sineas, penonton, komunitas, dan pelaku industri.',
                        'lokasi' => 'Indonesia',
                        'icon' => 'fa-film',
                        'ruang_lingkup' => 'Nasional',
                        'status_proyek' => 'Berjalan',
                        'timeline' => '2023 - Sekarang',
                    ],
                    'en' => [
                        'judul' => 'Indonesia Film Festival Network',
                        'kategori' => 'Festival',
                        'deskripsi_singkat' => 'A network of film festivals across regions to expand access to appreciation and distribution of Indonesian films.',
                        'deskripsi' => 'A program strengthening Indonesian film festival networks as spaces connecting filmmakers, audiences, communities, and industry players.',
                        'lokasi' => 'Indonesia',
                        'icon' => 'fa-film',
                        'ruang_lingkup' => 'National',
                        'status_proyek' => 'Running',
                        'timeline' => '2023 - Present',
                    ],
                ],
            ],
            [
                'slug' => 'co-production-indonesia',
                'tahun' => '2025 - Sekarang',
                'status' => 'published',
                'urutan' => 3,
                'translations' => [
                    'id' => [
                        'judul' => 'Co-Production Indonesia',
                        'kategori' => 'Produksi',
                        'deskripsi_singkat' => 'Program kolaborasi produksi film dengan negara mitra untuk meningkatkan kualitas dan jangkauan global.',
                        'deskripsi' => 'Program yang membuka peluang kerja sama produksi antara sineas Indonesia dengan mitra internasional.',
                        'lokasi' => 'Indonesia & Internasional',
                        'icon' => 'fa-handshake',
                        'ruang_lingkup' => 'Nasional & Internasional',
                        'status_proyek' => 'Berjalan',
                        'timeline' => '2025 - Sekarang',
                    ],
                    'en' => [
                        'judul' => 'Co-Production Indonesia',
                        'kategori' => 'Production',
                        'deskripsi_singkat' => 'A film production collaboration program with partner countries to improve quality and expand global reach.',
                        'deskripsi' => 'A program creating co-production opportunities between Indonesian filmmakers and international partners.',
                        'lokasi' => 'Indonesia & International',
                        'icon' => 'fa-handshake',
                        'ruang_lingkup' => 'National & International',
                        'status_proyek' => 'Running',
                        'timeline' => '2025 - Present',
                    ],
                ],
            ],
            [
                'slug' => 'digital-cinema-innovation-hub',
                'tahun' => '2025 - Sekarang',
                'status' => 'published',
                'urutan' => 4,
                'translations' => [
                    'id' => [
                        'judul' => 'Digital Cinema Innovation Hub',
                        'kategori' => 'Teknologi',
                        'deskripsi_singkat' => 'Hub inovasi yang menggabungkan teknologi sinema dengan pengembangan talenta dan transformasi digital industri film Indonesia.',
                        'deskripsi' => 'Inisiatif pengembangan ekosistem digital perfilman untuk mendorong inovasi teknologi dan kesiapan industri menghadapi perubahan digital.',
                        'lokasi' => 'Indonesia',
                        'icon' => 'fa-microchip',
                        'ruang_lingkup' => 'Nasional',
                        'status_proyek' => 'Berjalan',
                        'timeline' => '2025 - Sekarang',
                    ],
                    'en' => [
                        'judul' => 'Digital Cinema Innovation Hub',
                        'kategori' => 'Technology',
                        'deskripsi_singkat' => 'An innovation hub combining cinema technology, talent development, and digital transformation of the Indonesian film industry.',
                        'deskripsi' => 'An initiative developing a digital film ecosystem to encourage technological innovation and industry readiness for digital transformation.',
                        'lokasi' => 'Indonesia',
                        'icon' => 'fa-microchip',
                        'ruang_lingkup' => 'National',
                        'status_proyek' => 'Running',
                        'timeline' => '2025 - Present',
                    ],
                ],
            ],
            [
                'slug' => 'film-heritage-restoration',
                'tahun' => '2024 - Sekarang',
                'status' => 'published',
                'urutan' => 5,
                'translations' => [
                    'id' => [
                        'judul' => 'Film Heritage Restoration',
                        'kategori' => 'Pelestarian',
                        'deskripsi_singkat' => 'Program restorasi dan pelestarian karya film warisan budaya Indonesia.',
                        'deskripsi' => 'Inisiatif untuk menjaga karya film bersejarah agar tetap dapat diakses dan dipelajari oleh generasi mendatang.',
                        'lokasi' => 'Indonesia',
                        'icon' => 'fa-film',
                        'ruang_lingkup' => 'Nasional',
                        'status_proyek' => 'Berjalan',
                        'timeline' => '2024 - Sekarang',
                    ],
                    'en' => [
                        'judul' => 'Film Heritage Restoration',
                        'kategori' => 'Preservation',
                        'deskripsi_singkat' => 'A program for restoring and preserving Indonesian film heritage.',
                        'deskripsi' => 'An initiative to preserve historical films so they remain accessible and meaningful for future generations.',
                        'lokasi' => 'Indonesia',
                        'icon' => 'fa-film',
                        'ruang_lingkup' => 'National',
                        'status_proyek' => 'Running',
                        'timeline' => '2024 - Present',
                    ],
                ],
            ],
            [
                'slug' => 'green-production-initiative',
                'tahun' => '2025 - Sekarang',
                'status' => 'published',
                'urutan' => 6,
                'translations' => [
                    'id' => [
                        'judul' => 'Green Production Initiative',
                        'kategori' => 'Lingkungan',
                        'deskripsi_singkat' => 'Mendorong praktik produksi film yang lebih ramah lingkungan dan berkelanjutan.',
                        'deskripsi' => 'Program untuk meningkatkan kesadaran industri terhadap dampak lingkungan dari proses produksi film.',
                        'lokasi' => 'Indonesia',
                        'icon' => 'fa-leaf',
                        'ruang_lingkup' => 'Nasional',
                        'status_proyek' => 'Berjalan',
                        'timeline' => '2025 - Sekarang',
                    ],
                    'en' => [
                        'judul' => 'Green Production Initiative',
                        'kategori' => 'Environment',
                        'deskripsi_singkat' => 'Encouraging more environmentally friendly and sustainable film production practices.',
                        'deskripsi' => 'A program increasing industry awareness of the environmental impact of film production.',
                        'lokasi' => 'Indonesia',
                        'icon' => 'fa-leaf',
                        'ruang_lingkup' => 'National',
                        'status_proyek' => 'Running',
                        'timeline' => '2025 - Present',
                    ],
                ],
            ],
            [
                'slug' => 'talent-mobility-program',
                'tahun' => '2025 - Sekarang',
                'status' => 'published',
                'urutan' => 7,
                'translations' => [
                    'id' => [
                        'judul' => 'Talent Mobility Program',
                        'kategori' => 'Talenta',
                        'deskripsi_singkat' => 'Program pertukaran dan mobilitas residensi untuk talenta film Indonesia di tingkat nasional dan global.',
                        'deskripsi' => 'Program pengembangan talenta melalui pertukaran pengalaman, residensi, dan kesempatan kolaborasi lintas negara.',
                        'lokasi' => 'Indonesia & Internasional',
                        'icon' => 'fa-users',
                        'ruang_lingkup' => 'Nasional & Internasional',
                        'status_proyek' => 'Berjalan',
                        'timeline' => '2025 - Sekarang',
                    ],
                    'en' => [
                        'judul' => 'Talent Mobility Program',
                        'kategori' => 'Talent',
                        'deskripsi_singkat' => 'A mobility and residency program for Indonesian film talent at national and global levels.',
                        'deskripsi' => 'A talent development program through experience exchange, residencies, and cross-border collaboration opportunities.',
                        'lokasi' => 'Indonesia & International',
                        'icon' => 'fa-users',
                        'ruang_lingkup' => 'National & International',
                        'status_proyek' => 'Running',
                        'timeline' => '2025 - Present',
                    ],
                ],
            ],
            [
                'slug' => 'film-literacy-movement',
                'tahun' => '2025 - Sekarang',
                'status' => 'published',
                'urutan' => 8,
                'translations' => [
                    'id' => [
                        'judul' => 'Film Literacy Movement',
                        'kategori' => 'Literasi',
                        'deskripsi_singkat' => 'Gerakan literasi film untuk meningkatkan apresiasi, edukasi, dan pemahaman masyarakat terhadap karya sinema Indonesia.',
                        'deskripsi' => 'Gerakan untuk memperluas pemahaman masyarakat mengenai film sebagai karya seni, media komunikasi, dan bagian dari kebudayaan.',
                        'lokasi' => 'Indonesia',
                        'icon' => 'fa-book',
                        'ruang_lingkup' => 'Nasional',
                        'status_proyek' => 'Berjalan',
                        'timeline' => '2025 - Sekarang',
                    ],
                    'en' => [
                        'judul' => 'Film Literacy Movement',
                        'kategori' => 'Literacy',
                        'deskripsi_singkat' => 'A film literacy movement to improve public appreciation, education, and understanding of Indonesian cinema.',
                        'deskripsi' => 'A movement expanding public understanding of film as art, communication, and culture.',
                        'lokasi' => 'Indonesia',
                        'icon' => 'fa-book',
                        'ruang_lingkup' => 'National',
                        'status_proyek' => 'Running',
                        'timeline' => '2025 - Present',
                    ],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | GALERI PROYEK
        |--------------------------------------------------------------------------
        */

        foreach ($projects as $project) {
            $judulId = $project->translateField('judul', 'id');
            $judulEn = $project->translateField('judul', 'en');

            ProyekGaleri::create([
                'proyek_id' => $project->id,
                'gambar' => 'placeholder_proyek.jpg',
                'urutan' => 1,
                'status' => true,
            ])->storeTranslations([
                'id' => [
                    'judul' => 'Dokumentasi '.$judulId,
                    'deskripsi' => 'Dokumentasi kegiatan dan perkembangan proyek '.$judulId.'.',
                ],
                'en' => [
                    'judul' => 'Documentation of '.$judulEn,
                    'deskripsi' => 'Documentation of activities and development of '.$judulEn.'.',
                ],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | MITRA
        |--------------------------------------------------------------------------
        */

        $mitras = [
            // STRATEGIS
            ['nama_id' => 'Kementerian Kebudayaan', 'nama_en' => 'Ministry of Culture', 'kategori_id' => 'Strategis', 'kategori_en' => 'Strategic', 'deskripsi_id' => 'Mitra strategis dalam pengembangan kebijakan kebudayaan dan perfilman.', 'deskripsi_en' => 'Strategic partner in cultural and film policy development.', 'alamat_id' => 'Indonesia', 'alamat_en' => 'Indonesia', 'urutan' => 1],
            ['nama_id' => 'Badan Ekonomi Kreatif', 'nama_en' => 'Creative Economy Agency', 'kategori_id' => 'Strategis', 'kategori_en' => 'Strategic', 'deskripsi_id' => 'Mitra dalam pengembangan ekonomi kreatif dan industri perfilman.', 'deskripsi_en' => 'Partner in creative economy and film industry development.', 'alamat_id' => 'Indonesia', 'alamat_en' => 'Indonesia', 'urutan' => 2],
            ['nama_id' => 'Badan Perfilman Indonesia', 'nama_en' => 'Indonesian Film Board', 'kategori_id' => 'Strategis', 'kategori_en' => 'Strategic', 'deskripsi_id' => 'Lembaga yang memperkuat koordinasi dan pengembangan ekosistem perfilman nasional.', 'deskripsi_en' => 'An organization strengthening coordination and development of the national film ecosystem.', 'alamat_id' => 'Jakarta, Indonesia', 'alamat_en' => 'Jakarta, Indonesia', 'urutan' => 3],
            ['nama_id' => 'Kementerian Pendidikan', 'nama_en' => 'Ministry of Education', 'kategori_id' => 'Strategis', 'kategori_en' => 'Strategic', 'deskripsi_id' => 'Mitra dalam pengembangan pendidikan dan sumber daya manusia perfilman.', 'deskripsi_en' => 'Partner in education and film industry talent development.', 'alamat_id' => 'Indonesia', 'alamat_en' => 'Indonesia', 'urutan' => 4],
            // INTERNASIONAL
            ['nama_id' => 'European Film Agencies', 'nama_en' => 'European Film Agencies', 'kategori_id' => 'Internasional', 'kategori_en' => 'International', 'deskripsi_id' => 'Mitra internasional untuk pengembangan dan kolaborasi perfilman.', 'deskripsi_en' => 'International partner for film development and collaboration.', 'alamat_id' => 'Eropa', 'alamat_en' => 'Europe', 'urutan' => 5],
            ['nama_id' => 'Asian Film Network', 'nama_en' => 'Asian Film Network', 'kategori_id' => 'Internasional', 'kategori_en' => 'International', 'deskripsi_id' => 'Jaringan kolaborasi perfilman Asia.', 'deskripsi_en' => 'Asian film collaboration network.', 'alamat_id' => 'Asia', 'alamat_en' => 'Asia', 'urutan' => 6],
            ['nama_id' => 'Tokyo International Film Festival', 'nama_en' => 'Tokyo International Film Festival', 'kategori_id' => 'Internasional', 'kategori_en' => 'International', 'deskripsi_id' => 'Festival film internasional untuk memperluas jejaring dan promosi film Indonesia.', 'deskripsi_en' => 'International film festival supporting networking and promotion of Indonesian films.', 'alamat_id' => 'Tokyo, Jepang', 'alamat_en' => 'Tokyo, Japan', 'urutan' => 7],
            ['nama_id' => 'Cine Foundation', 'nama_en' => 'Cine Foundation', 'kategori_id' => 'Internasional', 'kategori_en' => 'International', 'deskripsi_id' => 'Mitra pengembangan dan pelestarian sinema internasional.', 'deskripsi_en' => 'International partner for cinema development and preservation.', 'alamat_id' => 'Internasional', 'alamat_en' => 'International', 'urutan' => 8],
            // INDUSTRI
            ['nama_id' => 'Co-Production Network', 'nama_en' => 'Co-Production Network', 'kategori_id' => 'Industri', 'kategori_en' => 'Industry', 'deskripsi_id' => 'Jaringan pelaku industri untuk kerja sama produksi film.', 'deskripsi_en' => 'Industry network supporting film production collaboration.', 'alamat_id' => 'Indonesia', 'alamat_en' => 'Indonesia', 'urutan' => 9],
            ['nama_id' => 'Cinema Indonesia', 'nama_en' => 'Cinema Indonesia', 'kategori_id' => 'Industri', 'kategori_en' => 'Industry', 'deskripsi_id' => 'Mitra dalam pengembangan dan distribusi perfilman nasional.', 'deskripsi_en' => 'Partner in national film development and distribution.', 'alamat_id' => 'Indonesia', 'alamat_en' => 'Indonesia', 'urutan' => 10],
            ['nama_id' => 'PT Kreasi Film Nusantara', 'nama_en' => 'PT Kreasi Film Nusantara', 'kategori_id' => 'Industri', 'kategori_en' => 'Industry', 'deskripsi_id' => 'Perusahaan produksi yang mendukung pengembangan karya film Indonesia.', 'deskripsi_en' => 'Production company supporting the development of Indonesian film works.', 'alamat_id' => 'Jakarta, Indonesia', 'alamat_en' => 'Jakarta, Indonesia', 'urutan' => 11],
            ['nama_id' => 'Industri Perfilman', 'nama_en' => 'Film Industry', 'kategori_id' => 'Industri', 'kategori_en' => 'Industry', 'deskripsi_id' => 'Mitra dari berbagai sektor yang mendukung rantai nilai industri perfilman.', 'deskripsi_en' => 'Partners from various sectors supporting the film industry value chain.', 'alamat_id' => 'Indonesia', 'alamat_en' => 'Indonesia', 'urutan' => 12],
            // KOMUNITAS
            ['nama_id' => 'Asosiasi Film Indonesia', 'nama_en' => 'Indonesian Film Association', 'kategori_id' => 'Komunitas', 'kategori_en' => 'Community', 'deskripsi_id' => 'Komunitas profesional yang mendukung perkembangan perfilman Indonesia.', 'deskripsi_en' => 'Professional community supporting the development of Indonesian cinema.', 'alamat_id' => 'Indonesia', 'alamat_en' => 'Indonesia', 'urutan' => 13],
            ['nama_id' => 'Film Festival Network', 'nama_en' => 'Film Festival Network', 'kategori_id' => 'Komunitas', 'kategori_en' => 'Community', 'deskripsi_id' => 'Jaringan komunitas festival film Indonesia.', 'deskripsi_en' => 'Indonesian film festival community network.', 'alamat_id' => 'Indonesia', 'alamat_en' => 'Indonesia', 'urutan' => 14],
            ['nama_id' => 'Komunitas Film Nusantara', 'nama_en' => 'Nusantara Film Community', 'kategori_id' => 'Komunitas', 'kategori_en' => 'Community', 'deskripsi_id' => 'Komunitas film yang mendorong kreativitas dan apresiasi masyarakat.', 'deskripsi_en' => 'Film community promoting creativity and public appreciation.', 'alamat_id' => 'Indonesia', 'alamat_en' => 'Indonesia', 'urutan' => 15],
            ['nama_id' => 'Lembaga Literasi Film', 'nama_en' => 'Film Literacy Organization', 'kategori_id' => 'Komunitas', 'kategori_en' => 'Community', 'deskripsi_id' => 'Komunitas yang bergerak dalam pendidikan dan literasi film.', 'deskripsi_en' => 'Community focused on film education and literacy.', 'alamat_id' => 'Indonesia', 'alamat_en' => 'Indonesia', 'urutan' => 16],
        ];

        foreach ($mitras as $mitra) {
            Mitra::create([
                'logo' => null,
                'website' => null,
                'urutan' => $mitra['urutan'],
                'status' => true,
            ])->storeTranslations([
                'id' => [
                    'nama' => $mitra['nama_id'],
                    'kategori' => $mitra['kategori_id'],
                    'deskripsi' => $mitra['deskripsi_id'],
                    'alamat' => $mitra['alamat_id'],
                ],
                'en' => [
                    'nama' => $mitra['nama_en'],
                    'kategori' => $mitra['kategori_en'],
                    'deskripsi' => $mitra['deskripsi_en'],
                    'alamat' => $mitra['alamat_en'],
                ],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | RELASI PROYEK - MITRA
        |--------------------------------------------------------------------------
        */

        $proyekMitraMap = [
            1 => [1, 2, 9, 10],
            2 => [5, 6, 13, 14],
            3 => [3, 7, 9, 11],
            4 => [2, 4, 10, 12],
            5 => [3, 8, 15, 16],
            6 => [1, 4, 11, 12],
            7 => [5, 6, 13, 16],
            8 => [7, 8, 14, 15],
        ];

        foreach ($proyekMitraMap as $proyekIdx => $mitraIds) {
            if (isset($projects[$proyekIdx - 1])) {
                $projects[$proyekIdx - 1]->mitra()->sync($mitraIds);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | BERITA
        |--------------------------------------------------------------------------
        */

        $news = $this->seedMany(Berita::class, [
            [
                'slug' => 'rapat-koordinasi-nasional-bpi-menetapkan-fokus-utama-tahun-depan',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-08-12',
                'status' => 'published',
                'translations' => [
                    'id' => [
                        'judul' => 'Rapat Koordinasi Nasional BPI Menetapkan Fokus Utama Tahun Depan',
                        'ringkasan' => 'BPI menyelenggarakan rapat koordinasi nasional untuk menetapkan fokus utama pengembangan perfilman Indonesia.',
                        'isi' => 'BPI menyelenggarakan Rapat Koordinasi Nasional sebagai bagian dari upaya memperkuat koordinasi dan kolaborasi antar pemangku kepentingan perfilman Indonesia. Pertemuan ini membahas strategi, program, dan prioritas pengembangan industri perfilman untuk periode mendatang.',
                        'kategori' => 'Event',
                        'kutipan' => 'Kolaborasi merupakan fondasi penting untuk membangun ekosistem perfilman Indonesia yang kuat.',
                    ],
                    'en' => [
                        'judul' => 'BPI National Coordination Meeting Sets Main Focus for Next Year',
                        'ringkasan' => 'BPI held a national coordination meeting to establish the main focus for the development of Indonesian cinema.',
                        'isi' => 'BPI held a National Coordination Meeting as part of its efforts to strengthen coordination and collaboration among Indonesian film industry stakeholders. The meeting discussed strategies, programs, and priorities for the development of the film industry.',
                        'kategori' => 'Event',
                        'kutipan' => 'Collaboration is an important foundation for building a strong Indonesian film ecosystem.',
                    ],
                ],
            ],
            [
                'slug' => 'penguatan-ekosistem-perfilman-indonesia',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-08-10',
                'status' => 'published',
                'translations' => [
                    'id' => [
                        'judul' => 'Penguatan Ekosistem Perfilman Indonesia',
                        'ringkasan' => 'BPI terus mendorong kolaborasi antar pelaku industri untuk memperkuat ekosistem perfilman nasional.',
                        'isi' => 'Penguatan ekosistem menjadi salah satu fokus utama BPI melalui kolaborasi antara pemerintah, asosiasi profesi, komunitas, pelaku industri, dan masyarakat.',
                        'kategori' => 'Berita',
                        'kutipan' => 'Ekosistem yang kuat lahir dari kolaborasi yang berkelanjutan.',
                    ],
                    'en' => [
                        'judul' => 'Strengthening the Indonesian Film Ecosystem',
                        'ringkasan' => 'BPI continues to encourage collaboration among industry players to strengthen the national film ecosystem.',
                        'isi' => 'Strengthening the ecosystem is one of BPI main focuses through collaboration between government, professional associations, communities, industry players, and the public.',
                        'kategori' => 'News',
                        'kutipan' => 'A strong ecosystem is built through sustainable collaboration.',
                    ],
                ],
            ],
            [
                'slug' => 'kolaborasi-film-indonesia-menuju-pasar-global',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-08-08',
                'status' => 'published',
                'translations' => [
                    'id' => [
                        'judul' => 'Kolaborasi Film Indonesia Menuju Pasar Global',
                        'ringkasan' => 'Kolaborasi internasional membuka peluang baru bagi karya dan talenta perfilman Indonesia.',
                        'isi' => 'BPI mendorong peningkatan kolaborasi internasional untuk membuka akses terhadap pasar, pendanaan, jaringan, dan pengembangan talenta perfilman Indonesia.',
                        'kategori' => 'Opini',
                        'kutipan' => 'Film Indonesia memiliki potensi besar untuk berkembang di tingkat global.',
                    ],
                    'en' => [
                        'judul' => 'Indonesian Film Collaboration Towards the Global Market',
                        'ringkasan' => 'International collaboration creates new opportunities for Indonesian films and talent.',
                        'isi' => 'BPI encourages increased international collaboration to provide access to markets, financing, networks, and talent development opportunities.',
                        'kategori' => 'Opinion',
                        'kutipan' => 'Indonesian films have great potential to grow in the global market.',
                    ],
                ],
            ],
            [
                'slug' => 'pengembangan-talenta-perfilman',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-08-05',
                'status' => 'published',
                'translations' => [
                    'id' => [
                        'judul' => 'Pengembangan Talenta Perfilman Indonesia',
                        'ringkasan' => 'Pengembangan talenta menjadi bagian penting dalam membangun masa depan industri perfilman.',
                        'isi' => 'BPI berkomitmen untuk mendukung peningkatan kompetensi dan mobilitas talenta melalui program pendidikan, pelatihan, residensi, dan kolaborasi.',
                        'kategori' => 'Industri',
                        'kutipan' => 'Talenta merupakan fondasi utama kemajuan industri kreatif.',
                    ],
                    'en' => [
                        'judul' => 'Developing Indonesian Film Talent',
                        'ringkasan' => 'Talent development is an important part of building the future of the film industry.',
                        'isi' => 'BPI is committed to improving talent competency and mobility through education, training, residency, and collaboration programs.',
                        'kategori' => 'Industry',
                        'kutipan' => 'Talent is the main foundation of creative industry development.',
                    ],
                ],
            ],
            [
                'slug' => 'transformasi-digital-industri-film',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-08-02',
                'status' => 'published',
                'translations' => [
                    'id' => [
                        'judul' => 'Transformasi Digital Industri Film',
                        'ringkasan' => 'Teknologi membuka ruang baru untuk inovasi dan pengembangan industri perfilman.',
                        'isi' => 'Transformasi digital menjadi peluang penting bagi industri perfilman Indonesia untuk meningkatkan efisiensi, kreativitas, distribusi, dan akses terhadap penonton.',
                        'kategori' => 'Teknologi',
                        'kutipan' => 'Teknologi dan kreativitas harus berjalan bersama untuk menciptakan masa depan sinema.',
                    ],
                    'en' => [
                        'judul' => 'Digital Transformation of the Film Industry',
                        'ringkasan' => 'Technology opens new opportunities for innovation and development in the film industry.',
                        'isi' => 'Digital transformation is an important opportunity for Indonesian cinema to improve efficiency, creativity, distribution, and audience access.',
                        'kategori' => 'Technology',
                        'kutipan' => 'Technology and creativity must work together to create the future of cinema.',
                    ],
                ],
            ],
            [
                'slug' => 'pelestarian-warisan-film-indonesia',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-07-28',
                'status' => 'published',
                'translations' => [
                    'id' => [
                        'judul' => 'Pelestarian Warisan Film Indonesia',
                        'ringkasan' => 'Pelestarian arsip film menjadi bagian penting dalam menjaga sejarah dan identitas budaya bangsa.',
                        'isi' => 'BPI mendukung berbagai upaya pelestarian, digitalisasi, dan restorasi karya film Indonesia agar dapat dinikmati oleh generasi mendatang.',
                        'kategori' => 'Budaya',
                        'kutipan' => 'Warisan film merupakan bagian dari memori dan identitas bangsa.',
                    ],
                    'en' => [
                        'judul' => 'Preserving Indonesian Film Heritage',
                        'ringkasan' => 'Film archive preservation is essential to maintaining the nation cultural history and identity.',
                        'isi' => 'BPI supports preservation, digitization, and restoration efforts so Indonesian films can be enjoyed by future generations.',
                        'kategori' => 'Culture',
                        'kutipan' => 'Film heritage is part of the memory and identity of a nation.',
                    ],
                ],
            ],
            [
                'slug' => 'menuju-industri-film-yang-berkelanjutan',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-07-25',
                'status' => 'published',
                'translations' => [
                    'id' => [
                        'judul' => 'Menuju Industri Film yang Berkelanjutan',
                        'ringkasan' => 'BPI mendorong praktik industri yang inklusif, sehat, dan berkelanjutan.',
                        'isi' => 'Keberlanjutan industri perfilman membutuhkan kolaborasi jangka panjang, tata kelola yang baik, pengembangan talenta, inovasi, dan perhatian terhadap lingkungan.',
                        'kategori' => 'Industri',
                        'kutipan' => 'Industri yang sehat adalah industri yang mampu tumbuh bersama seluruh ekosistemnya.',
                    ],
                    'en' => [
                        'judul' => 'Towards a Sustainable Film Industry',
                        'ringkasan' => 'BPI promotes an inclusive, healthy, and sustainable film industry.',
                        'isi' => 'A sustainable film industry requires long-term collaboration, good governance, talent development, innovation, and environmental awareness.',
                        'kategori' => 'Industry',
                        'kutipan' => 'A healthy industry is one that grows together with its entire ecosystem.',
                    ],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | GALERI BERITA
        |--------------------------------------------------------------------------
        */

        foreach ($news as $berita) {
            BeritaGaleri::create([
                'berita_id' => $berita->id,
                'gambar' => 'placeholder_berita_'.$berita->id.'.jpg',
                'urutan' => 1,
                'status' => true,
            ])->storeTranslations([
                'id' => ['caption' => 'Dokumentasi '.$berita->translateField('judul', 'id')],
                'en' => ['caption' => 'Documentation of '.$berita->translateField('judul', 'en')],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | TAGS
        |--------------------------------------------------------------------------
        */

        $tagsData = [
            ['slug' => 'profilman-indonesia', 'nama_id' => 'Profilman Indonesia', 'nama_en' => 'Indonesian Cinema'],
            ['slug' => 'kebijakan-budaya', 'nama_id' => 'Kebijakan Budaya', 'nama_en' => 'Cultural Policy'],
            ['slug' => 'ekonomi-kreatif', 'nama_id' => 'Ekonomi Kreatif', 'nama_en' => 'Creative Economy'],
            ['slug' => 'teknologi-film', 'nama_id' => 'Teknologi Film', 'nama_en' => 'Film Technology'],
            ['slug' => 'talenta-muda', 'nama_id' => 'Talenta Muda', 'nama_en' => 'Young Talent'],
            ['slug' => 'festival-film', 'nama_id' => 'Festival Film', 'nama_en' => 'Film Festival'],
            ['slug' => 'pelestarian-warisan', 'nama_id' => 'Pelestarian Warisan', 'nama_en' => 'Heritage Preservation'],
            ['slug' => 'kolaborasi-internasional', 'nama_id' => 'Kolaborasi Internasional', 'nama_en' => 'International Collaboration'],
            ['slug' => 'industri-kreatif', 'nama_id' => 'Industri Kreatif', 'nama_en' => 'Creative Industry'],
            ['slug' => 'literasi-film', 'nama_id' => 'Literasi Film', 'nama_en' => 'Film Literacy'],
        ];

        $tags = [];
        foreach ($tagsData as $tagData) {
            $tag = Tag::create([
                'slug' => $tagData['slug'],
                'status' => true,
            ]);
            $tag->storeTranslations([
                'id' => ['tag' => $tagData['nama_id']],
                'en' => ['tag' => $tagData['nama_en']],
            ]);
            $tags[] = $tag;
        }

        // Relasi Berita - Tag
        $beritaTagMap = [
            1 => [0, 1, 5],
            2 => [0, 2],
            3 => [0, 7, 8],
            4 => [0, 4, 9],
            5 => [0, 3],
            6 => [0, 6],
            7 => [0, 8, 2],
        ];

        foreach ($beritaTagMap as $beritaIdx => $tagIdxs) {
            if (isset($news[$beritaIdx - 1])) {
                $tagIds = array_map(fn ($idx) => $tags[$idx]->id, $tagIdxs);
                $news[$beritaIdx - 1]->tags()->sync($tagIds);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | TENTANG
        |--------------------------------------------------------------------------
        */

        $this->seedMany(Tentang::class, [
            [
                'section' => 'hero',
                'gambar' => null,
                'icon' => null,
                'urutan' => 1,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Membangun Masa Depan Sinema Nasional',
                        'subjudul' => 'Badan Perfilman Indonesia',
                        'deskripsi' => 'BPI hadir sebagai wadah strategis yang menghubungkan berbagai pemangku kepentingan untuk membangun ekosistem perfilman Indonesia yang sehat, inklusif, dan berkelanjutan.',
                    ],
                    'en' => [
                        'judul' => 'Building the Future of National Cinema',
                        'subjudul' => 'Indonesian Film Board',
                        'deskripsi' => 'BPI serves as a strategic platform connecting stakeholders to build a healthy, inclusive, and sustainable Indonesian film ecosystem.',
                    ],
                ],
            ],
            [
                'section' => 'visi',
                'icon' => 'fa-solid fa-eye',
                'urutan' => 2,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Visi Kami',
                        'subjudul' => 'Menjadi institusi yang menghubungkan film Indonesia yang unggul dan kompetitif dengan semangat kebangsaan dan budaya.',
                        'deskripsi' => 'Mewujudkan ekosistem perfilman Indonesia yang kuat, inklusif, profesional, kreatif, dan mampu bersaing di tingkat global.',
                    ],
                    'en' => [
                        'judul' => 'Our Vision',
                        'subjudul' => 'To become an institution connecting excellent and competitive Indonesian cinema with national spirit and culture.',
                        'deskripsi' => 'Building a strong, inclusive, professional, creative, and globally competitive Indonesian film ecosystem.',
                    ],
                ],
            ],
            [
                'section' => 'misi',
                'icon' => 'fa-solid fa-bullseye',
                'urutan' => 3,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Misi Kami',
                        'subjudul' => 'Menghubungkan, memperkuat, dan mengakselerasi seluruh potensi perfilman Indonesia.',
                        'deskripsi' => 'Mendorong kolaborasi, meningkatkan kapasitas talenta, memperluas akses pasar, memperkuat kebijakan, dan menciptakan inovasi yang mendukung keberlanjutan industri.',
                    ],
                    'en' => [
                        'judul' => 'Our Mission',
                        'subjudul' => 'Connecting, strengthening, and accelerating the full potential of Indonesian cinema.',
                        'deskripsi' => 'Promoting collaboration, improving talent capacity, expanding market access, strengthening policy, and creating innovations that support industry sustainability.',
                    ],
                ],
            ],
            [
                'section' => 'nilai',
                'icon' => 'fa-solid fa-star',
                'urutan' => 4,
                'status' => true,
                'translations' => [
                    'id' => [
                        'judul' => 'Nilai Kami',
                        'subjudul' => 'Kolaborasi, profesionalisme, inovasi, inklusivitas, dan keberlanjutan.',
                        'deskripsi' => 'Nilai-nilai tersebut menjadi dasar BPI dalam menjalankan peran sebagai penggerak dan penghubung ekosistem perfilman nasional.',
                    ],
                    'en' => [
                        'judul' => 'Our Values',
                        'subjudul' => 'Collaboration, professionalism, innovation, inclusivity, and sustainability.',
                        'deskripsi' => 'These values guide BPI in its role as a driver and connector of the national film ecosystem.',
                    ],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | TENTANG POIN (Visi & Misi Sub-items)
        |--------------------------------------------------------------------------
        */

        $tentang = Tentang::all();

        $tentangPoinData = [
            // Visi (tentang_id 2)
            2 => [
                ['icon' => 'fa-solid fa-globe', 'urutan' => 1, 'judul_id' => 'Keunggulan Global', 'judul_en' => 'Global Excellence', 'deskripsi_id' => 'Membangun ekosistem perfilman yang mampu bersaing di tingkat internasional.', 'deskripsi_en' => 'Building a film ecosystem capable of competing at the international level.'],
                ['icon' => 'fa-solid fa-users', 'urutan' => 2, 'judul_id' => 'Inklusivitas', 'judul_en' => 'Inclusivity', 'deskripsi_id' => 'Menjamin partisipasi seluruh pemangku kepentingan tanpa diskriminasi.', 'deskripsi_en' => 'Ensuring participation of all stakeholders without discrimination.'],
                ['icon' => 'fa-solid fa-lightbulb', 'urutan' => 3, 'judul_id' => 'Inovasi Kreatif', 'judul_en' => 'Creative Innovation', 'deskripsi_id' => 'Mendorong inovasi dalam karya dan proses produksi perfilman.', 'deskripsi_en' => 'Encouraging innovation in filmmaking works and production processes.'],
                ['icon' => 'fa-solid fa-leaf', 'urutan' => 4, 'judul_id' => 'Keberlanjutan', 'judul_en' => 'Sustainability', 'deskripsi_id' => 'Memastikan pertumbuhan industri yang berkelanjutan dan bertanggung jawab.', 'deskripsi_en' => 'Ensuring sustainable and responsible industry growth.'],
            ],
            // Misi (tentang_id 3)
            3 => [
                ['icon' => 'fa-solid fa-graduation-cap', 'urutan' => 1, 'judul_id' => 'Pengembangan SDM', 'judul_en' => 'Human Resource Development', 'deskripsi_id' => 'Meningkatkan kompetensi dan kapasitas talenta perfilman Indonesia melalui pendidikan, pelatihan, dan pengembangan profesional.', 'deskripsi_en' => 'Improving the competency and capacity of Indonesian film talent through education, training, and professional development.'],
                ['icon' => 'fa-solid fa-earth-americas', 'urutan' => 2, 'judul_id' => 'Promosi Internasional', 'judul_en' => 'International Promotion', 'deskripsi_id' => 'Memperluas jangkauan dan apresiasi film Indonesia di pasar global melalui promosi, festival, dan kemitraan strategis.', 'deskripsi_en' => 'Expanding the reach and appreciation of Indonesian films in global markets through promotion, festivals, and strategic partnerships.'],
                ['icon' => 'fa-solid fa-gavel', 'urutan' => 3, 'judul_id' => 'Advokasi Kebijakan', 'judul_en' => 'Policy Advocacy', 'deskripsi_id' => 'Mendorong kebijakan yang mendukung pertumbuhan, perlindungan, dan keberlanjutan industri perfilman Indonesia.', 'deskripsi_en' => 'Advocating policies that support the growth, protection, and sustainability of the Indonesian film industry.'],
                ['icon' => 'fa-solid fa-link', 'urutan' => 4, 'judul_id' => 'Koordinasi Ekosistem', 'judul_en' => 'Ecosystem Coordination', 'deskripsi_id' => 'Menghubungkan dan mengkoordinasikan seluruh pemangku kepentingan untuk membangun sinergi dan kolaborasi yang efektif.', 'deskripsi_en' => 'Connecting and coordinating all stakeholders to build effective synergy and collaboration.'],
            ],
        ];

        foreach ($tentang as $item) {
            if (isset($tentangPoinData[$item->id])) {
                foreach ($tentangPoinData[$item->id] as $poinData) {
                    TentangPoin::create([
                        'tentang_id' => $item->id,
                        'icon' => $poinData['icon'],
                        'urutan' => $poinData['urutan'],
                        'status' => true,
                    ])->storeTranslations([
                        'id' => [
                            'judul' => $poinData['judul_id'],
                            'deskripsi' => $poinData['deskripsi_id'],
                        ],
                        'en' => [
                            'judul' => $poinData['judul_en'],
                            'deskripsi' => $poinData['deskripsi_en'],
                        ],
                    ]);
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | STRUKTUR ORGANISASI
        |--------------------------------------------------------------------------
        */

        $this->seedMany(StrukturOrganisasi::class, [
            [
                'nama' => 'Nama Pengurus 1',
                'foto' => null,
                'linkedin' => null,
                'instagram' => null,
                'email' => null,
                'telepon' => null,
                'urutan' => 1,
                'status' => true,
                'translations' => [
                    'id' => ['jabatan' => 'Ketua', 'deskripsi' => 'Memimpin arah strategis dan koordinasi organisasi BPI.'],
                    'en' => ['jabatan' => 'Chairperson', 'deskripsi' => 'Leads the strategic direction and organizational coordination of BPI.'],
                ],
            ],
            [
                'nama' => 'Nama Pengurus 2',
                'urutan' => 2,
                'status' => true,
                'translations' => [
                    'id' => ['jabatan' => 'Wakil Ketua', 'deskripsi' => 'Mendukung koordinasi dan pelaksanaan program strategis BPI.'],
                    'en' => ['jabatan' => 'Vice Chairperson', 'deskripsi' => 'Supports coordination and implementation of BPI strategic programs.'],
                ],
            ],
            [
                'nama' => 'Nama Pengurus 3',
                'urutan' => 3,
                'status' => true,
                'translations' => [
                    'id' => ['jabatan' => 'Sekretaris', 'deskripsi' => 'Mengelola administrasi dan koordinasi internal organisasi.'],
                    'en' => ['jabatan' => 'Secretary', 'deskripsi' => 'Manages administration and internal organizational coordination.'],
                ],
            ],
            [
                'nama' => 'Nama Pengurus 4',
                'urutan' => 4,
                'status' => true,
                'translations' => [
                    'id' => ['jabatan' => 'Bendahara', 'deskripsi' => 'Mengelola administrasi dan tata kelola keuangan organisasi.'],
                    'en' => ['jabatan' => 'Treasurer', 'deskripsi' => 'Manages financial administration and governance.'],
                ],
            ],
            [
                'nama' => 'Nama Pengurus 5',
                'urutan' => 5,
                'status' => true,
                'translations' => [
                    'id' => ['jabatan' => 'Koordinator Program', 'deskripsi' => 'Mengkoordinasikan program dan inisiatif strategis BPI.'],
                    'en' => ['jabatan' => 'Program Coordinator', 'deskripsi' => 'Coordinates BPI strategic programs and initiatives.'],
                ],
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | KONTAK
        |--------------------------------------------------------------------------
        */

        Kontak::create([
            'latitude' => -6.2500000,
            'longitude' => 106.8500000,
            'status' => true,
        ])->storeTranslations([
            'id' => [
                'judul' => 'Hubungi Kami',
                'deskripsi' => 'Mari terhubung dan berkolaborasi untuk memajukan perfilman Indonesia.',
                'alamat' => 'Gedung Film, Jl. M.T. Haryono Kav. 47-48, Jakarta Selatan 12770',
            ],
            'en' => [
                'judul' => 'Contact Us',
                'deskripsi' => 'Let us connect and collaborate to advance Indonesian cinema.',
                'alamat' => 'Film Building, Jl. M.T. Haryono Kav. 47-48, South Jakarta 12770',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | KONTAK SOCIAL MEDIA, EMAIL, PHONE
        |--------------------------------------------------------------------------
        */

        $kontak = Kontak::first();

        if ($kontak) {
            $socialMediaData = [
                ['platform' => 'instagram', 'username' => '@bpi.indonesia', 'url' => 'https://instagram.com/bpi.indonesia', 'urutan' => 1],
                ['platform' => 'youtube', 'username' => 'bpitv', 'url' => 'https://youtube.com/@bpitv', 'urutan' => 2],
                ['platform' => 'facebook', 'username' => 'bpindonesia', 'url' => 'https://facebook.com/bpindonesia', 'urutan' => 3],
                ['platform' => 'linkedin', 'username' => 'bpiindonesia', 'url' => 'https://linkedin.com/company/bpiindonesia', 'urutan' => 4],
            ];

            foreach ($socialMediaData as $sm) {
                KontakSocialMedia::create([
                    'kontak_id' => $kontak->id,
                    'platform' => $sm['platform'],
                    'username' => $sm['username'],
                    'url' => $sm['url'],
                    'urutan' => $sm['urutan'],
                    'status' => true,
                ]);
            }

            $emailData = [
                ['email' => 'info@bpi.or.id', 'description' => 'Respon cepat untuk pertanyaan resmi dan kerjasama.', 'url' => 'mailto:info@bpi.or.id', 'urutan' => 1],
            ];

            foreach ($emailData as $em) {
                KontakEmail::create([
                    'kontak_id' => $kontak->id,
                    'email' => $em['email'],
                    'description' => $em['description'],
                    'url' => $em['url'],
                    'urutan' => $em['urutan'],
                    'status' => true,
                ]);
            }

            $phoneData = [
                ['number' => '+62 878 3992 0990', 'type' => 'whatsapp', 'url' => 'https://wa.me/6287839920990', 'urutan' => 1],
                ['number' => '+62 878 3991 0991', 'type' => 'whatsapp', 'url' => 'https://wa.me/6287839910991', 'urutan' => 2],
            ];

            foreach ($phoneData as $ph) {
                KontakPhone::create([
                    'kontak_id' => $kontak->id,
                    'number' => $ph['number'],
                    'type' => $ph['type'],
                    'url' => $ph['url'],
                    'urutan' => $ph['urutan'],
                    'status' => true,
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | MENU
        |--------------------------------------------------------------------------
        */

        $menus = [
            ['slug' => 'beranda', 'url' => '/', 'urutan' => 1, 'nama_id' => 'Beranda', 'nama_en' => 'Home'],
            ['slug' => 'stakeholders', 'url' => '/stakeholders', 'urutan' => 2, 'nama_id' => 'Stakeholders', 'nama_en' => 'Stakeholders'],
            ['slug' => 'program', 'url' => '/program', 'urutan' => 3, 'nama_id' => 'Program', 'nama_en' => 'Programs'],
            ['slug' => 'proyek', 'url' => '/proyek', 'urutan' => 4, 'nama_id' => 'Proyek', 'nama_en' => 'Projects'],
            ['slug' => 'mitra', 'url' => '/mitra', 'urutan' => 5, 'nama_id' => 'Mitra', 'nama_en' => 'Partners'],
            ['slug' => 'berita', 'url' => '/berita', 'urutan' => 6, 'nama_id' => 'Berita', 'nama_en' => 'News'],
            ['slug' => 'tentang', 'url' => '/tentang', 'urutan' => 7, 'nama_id' => 'Tentang', 'nama_en' => 'About'],
        ];

        foreach ($menus as $menu) {
            Menu::create([
                'slug' => $menu['slug'],
                'url' => $menu['url'],
                'urutan' => $menu['urutan'],
                'status' => true,
            ])->storeTranslations([
                'id' => ['nama' => $menu['nama_id']],
                'en' => ['nama' => $menu['nama_en']],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        $footers = [
            ['section' => 'tentang', 'link_url' => '/tentang', 'urutan' => 1, 'judul_id' => 'Tentang BPI', 'judul_en' => 'About BPI', 'deskripsi_id' => 'Badan Perfilman Indonesia. Memajukan Perfilman Indonesia.', 'deskripsi_en' => 'Indonesian Film Board. Advancing Indonesian Cinema.', 'link_nama_id' => 'Profil', 'link_nama_en' => 'Profile'],
            ['section' => 'tentang', 'link_url' => '/tentang', 'urutan' => 2, 'judul_id' => 'Visi & Misi', 'judul_en' => 'Vision & Mission', 'deskripsi_id' => 'Visi dan misi BPI.', 'deskripsi_en' => 'BPI vision and mission.', 'link_nama_id' => 'Visi & Misi', 'link_nama_en' => 'Vision & Mission'],
            ['section' => 'tentang', 'link_url' => '/tentang', 'urutan' => 3, 'judul_id' => 'Sejarah', 'judul_en' => 'History', 'deskripsi_id' => 'Sejarah Badan Perfilman Indonesia.', 'deskripsi_en' => 'History of the Indonesian Film Board.', 'link_nama_id' => 'Sejarah', 'link_nama_en' => 'History'],
            ['section' => 'tentang', 'link_url' => '/tentang', 'urutan' => 4, 'judul_id' => 'Struktur Organisasi', 'judul_en' => 'Organizational Structure', 'deskripsi_id' => 'Struktur organisasi BPI.', 'deskripsi_en' => 'BPI organizational structure.', 'link_nama_id' => 'Struktur Organisasi', 'link_nama_en' => 'Organizational Structure'],
            ['section' => 'informasi', 'link_url' => '/program', 'urutan' => 5, 'judul_id' => 'Informasi', 'judul_en' => 'Information', 'deskripsi_id' => 'Informasi dan dokumen BPI.', 'deskripsi_en' => 'BPI information and documents.', 'link_nama_id' => 'Rencana Strategis', 'link_nama_en' => 'Strategic Plan'],
            ['section' => 'informasi', 'link_url' => '/berita', 'urutan' => 6, 'judul_id' => 'Laporan', 'judul_en' => 'Reports', 'deskripsi_id' => 'Laporan kegiatan dan perkembangan BPI.', 'deskripsi_en' => 'BPI activity and development reports.', 'link_nama_id' => 'Laporan Tahunan', 'link_nama_en' => 'Annual Report'],
            ['section' => 'jaringan', 'link_url' => '/stakeholders', 'urutan' => 7, 'judul_id' => 'Jaringan & Kontak', 'judul_en' => 'Network & Contact', 'deskripsi_id' => 'Jaringan asosiasi dan informasi kontak BPI.', 'deskripsi_en' => 'Association network and BPI contact information.', 'link_nama_id' => 'Direktori Asosiasi', 'link_nama_en' => 'Association Directory'],
            ['section' => 'jaringan', 'link_url' => '/kontak', 'urutan' => 8, 'judul_id' => 'Hubungi Kami', 'judul_en' => 'Contact Us', 'deskripsi_id' => 'Hubungi BPI untuk informasi dan kolaborasi.', 'deskripsi_en' => 'Contact BPI for information and collaboration.', 'link_nama_id' => 'Hubungi Kami', 'link_nama_en' => 'Contact Us'],
        ];

        foreach ($footers as $footer) {
            Footer::create([
                'section' => $footer['section'],
                'link_url' => $footer['link_url'],
                'icon' => null,
                'urutan' => $footer['urutan'],
                'status' => true,
            ])->storeTranslations([
                'id' => [
                    'judul' => $footer['judul_id'],
                    'deskripsi' => $footer['deskripsi_id'],
                    'link_nama' => $footer['link_nama_id'],
                ],
                'en' => [
                    'judul' => $footer['judul_en'],
                    'deskripsi' => $footer['deskripsi_en'],
                    'link_nama' => $footer['link_nama_en'],
                ],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        */

        $this->command->info('==========================================');
        $this->command->info('DATABASE SEEDER BPI BERHASIL DIJALANKAN');
        $this->command->info('==========================================');
        $this->command->info('Admin Email    : admin.bpi@gmail.com');
        $this->command->info('Admin Password : password123');
        $this->command->info('Bahasa         : id (default), en aktif, jp nonaktif');
        $this->command->info('==========================================');
    }

    /**
     * Buat record beserta translations keyed per bahasa.
     * Field netral ada di level atas, teks per bahasa ada di key 'translations'.
     */
    private function seedMany(string $modelClass, array $records): array
    {
        return array_map(function (array $record) use ($modelClass) {
            $translations = $record['translations'];
            unset($record['translations']);

            $model = $modelClass::create($record);

            if ($translations !== []) {
                $model->storeTranslations($translations);
            }

            return $model;
        }, $records);
    }
}
