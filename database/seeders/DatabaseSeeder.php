<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PengaturanBahasa;
use App\Models\BannerHalaman;
use App\Models\Beranda;
use App\Models\Stakeholder;
use App\Models\Program;
use App\Models\Proyek;
use App\Models\ProyekGaleri;
use App\Models\Mitra;
use App\Models\Berita;
use App\Models\BeritaGaleri;
use App\Models\Tentang;
use App\Models\StrukturOrganisasi;
use App\Models\Kontak;
use App\Models\Menu;
use App\Models\Footer;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Admin BPI',
            'email' => 'admin.bpi@gmail.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | PENGATURAN BAHASA
        |--------------------------------------------------------------------------
        */

        PengaturanBahasa::create([
            'bahasa_default' => 'id',
            'bahasa_tersedia' => 'id,en',
            'status' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | BANNER HALAMAN
        |--------------------------------------------------------------------------
        */

        $banners = [
            [
                'halaman' => 'home',
                'judul_id' => 'Menjaga, Memfokuskan, dan Mendorong Perfilman Indonesia',
                'judul_en' => 'Strengthening, Focusing, and Advancing Indonesian Cinema',
                'deskripsi_id' => 'BPI menghubungkan lebih dari 50 asosiasi profesi dan seluruh insan kreatif perfilman Indonesia untuk bergerak bersama menuju industri yang inklusif, sehat, dan berdaya saing global.',
                'deskripsi_en' => 'BPI connects more than 50 professional associations and creative people in the Indonesian film industry to move together toward an inclusive, healthy, and globally competitive industry.',
                'gambar' => null,
                'status' => true,
            ],
            [
                'halaman' => 'stakeholders',
                'judul_id' => 'Menyatu dalam Ekosistem, Menggerakkan Sinema Nasional',
                'judul_en' => 'United in the Ecosystem, Driving National Cinema',
                'deskripsi_id' => 'BPI menghubungkan berbagai pemangku kepentingan dalam ekosistem perfilman Indonesia untuk membangun industri yang kuat dan berkelanjutan.',
                'deskripsi_en' => 'BPI connects stakeholders across the Indonesian film ecosystem to build a strong and sustainable film industry.',
                'gambar' => null,
                'status' => true,
            ],
            [
                'halaman' => 'program',
                'judul_id' => 'Mengakselerasi Potensi, Memfokuskan Arah Industri',
                'judul_en' => 'Accelerating Potential, Focusing the Industry Direction',
                'deskripsi_id' => 'Inisiatif strategis BPI yang berorientasi pada peningkatan kompetensi SDM, perlindungan HAKI, advokasi kebijakan, hingga penetrasi pasar dunia.',
                'deskripsi_en' => 'BPI strategic initiatives focus on improving human resources, protecting intellectual property rights, policy advocacy, and global market penetration.',
                'gambar' => null,
                'status' => true,
            ],
            [
                'halaman' => 'proyek',
                'judul_id' => 'Memproyeksikan Inovasi dan Masa Depan Sinema',
                'judul_en' => 'Projecting Innovation and the Future of Cinema',
                'deskripsi_id' => 'Rekam jejak proyek strategis dan inisiatif BPI yang dirancang untuk membuka peluang baru, merangkul teknologi, serta memperkuat infrastruktur perfilman nasional.',
                'deskripsi_en' => 'A record of BPI strategic projects and initiatives designed to create new opportunities, embrace technology, and strengthen the national film infrastructure.',
                'gambar' => null,
                'status' => true,
            ],
            [
                'halaman' => 'mitra',
                'judul_id' => 'Merajut Sinergi, Meluaskan Jangkauan Proyeksi',
                'judul_en' => 'Building Synergy, Expanding Our Reach',
                'deskripsi_id' => 'BPI berkolaborasi dengan berbagai mitra strategis untuk memperkuat ekosistem perfilman Indonesia dan memperluas jangkauan industri ke tingkat nasional maupun internasional.',
                'deskripsi_en' => 'BPI collaborates with strategic partners to strengthen the Indonesian film ecosystem and expand the industry nationally and internationally.',
                'gambar' => null,
                'status' => true,
            ],
            [
                'halaman' => 'berita',
                'judul_id' => 'Denyut Pergerakan dan Kabar Terkini Perfilman',
                'judul_en' => 'The Pulse and Latest News of Indonesian Cinema',
                'deskripsi_id' => 'Informasi terbaru mengenai dinamika, kebijakan, perkembangan industri, serta berbagai kegiatan perfilman Indonesia.',
                'deskripsi_en' => 'The latest information on dynamics, policies, industry developments, and activities in Indonesian cinema.',
                'gambar' => null,
                'status' => true,
            ],
            [
                'halaman' => 'tentang',
                'judul_id' => 'Lensa Penggerak dan Akselerator Sinema Indonesia',
                'judul_en' => 'The Lens Driving and Accelerating Indonesian Cinema',
                'deskripsi_id' => 'BPI hadir untuk memfokuskan, memperkuat, dan menggerakkan ekosistem perfilman Indonesia menuju industri yang sehat, inklusif, dan berkelanjutan.',
                'deskripsi_en' => 'BPI exists to focus, strengthen, and drive the Indonesian film ecosystem toward a healthy, inclusive, and sustainable industry.',
                'gambar' => null,
                'status' => true,
            ],
            [
                'halaman' => 'kontak',
                'judul_id' => 'Terhubung, Berkolaborasi, dan Bergerak Bersama Sinema Indonesia',
                'judul_en' => 'Connect, Collaborate, and Move Together with Indonesian Cinema',
                'deskripsi_id' => 'BPI membuka ruang dialog dan kolaborasi bagi seluruh insan, organisasi, komunitas, dan mitra perfilman Indonesia.',
                'deskripsi_en' => 'BPI opens opportunities for dialogue and collaboration with people, organizations, communities, and partners in Indonesian cinema.',
                'gambar' => null,
                'status' => true,
            ],
        ];

        foreach ($banners as $banner) {
            BannerHalaman::create($banner);
        }

        /*
        |--------------------------------------------------------------------------
        | BERANDA
        |--------------------------------------------------------------------------
        */

        $beranda = [
            [
                'section' => 'hero',
                'judul_id' => 'Menjaga, Memfokuskan, dan Mendorong Perfilman Indonesia',
                'judul_en' => 'Strengthening, Focusing, and Advancing Indonesian Cinema',
                'deskripsi_id' => 'BPI menghubungkan lebih dari 50 asosiasi profesi dan seluruh insan kreatif perfilman Indonesia untuk bergerak bersama menuju industri yang inklusif, sehat, dan berdaya saing global.',
                'deskripsi_en' => 'BPI connects more than 50 professional associations and creative people in the Indonesian film industry to move together toward an inclusive, healthy, and globally competitive industry.',
                'gambar' => null,
                'icon' => null,
                'urutan' => 1,
                'status' => true,
            ],
            [
                'section' => 'tentang',
                'judul_id' => 'Membangun Masa Depan Sinema Nasional',
                'judul_en' => 'Building the Future of National Cinema',
                'deskripsi_id' => 'Badan Perfilman Indonesia (BPI) hadir sebagai wadah strategis yang menghubungkan berbagai pemangku kepentingan perfilman untuk membangun ekosistem industri yang sehat, inklusif, dan berkelanjutan.',
                'deskripsi_en' => 'Badan Perfilman Indonesia (BPI) serves as a strategic platform connecting stakeholders in the film industry to build a healthy, inclusive, and sustainable ecosystem.',
                'gambar' => null,
                'icon' => null,
                'urutan' => 2,
                'status' => true,
            ],
            [
                'section' => 'struktur',
                'judul_id' => 'Struktur Organisasi',
                'judul_en' => 'Organizational Structure',
                'deskripsi_id' => 'BPI didukung oleh insan perfilman dari berbagai latar belakang profesi yang bekerja bersama untuk memajukan ekosistem perfilman Indonesia.',
                'deskripsi_en' => 'BPI is supported by film industry professionals from diverse backgrounds who work together to advance the Indonesian film ecosystem.',
                'gambar' => null,
                'icon' => 'fa-solid fa-users',
                'urutan' => 3,
                'status' => true,
            ],
            [
                'section' => 'proyek',
                'judul_id' => 'Proyek Kolaborasi',
                'judul_en' => 'Collaborative Projects',
                'deskripsi_id' => 'Berbagai proyek strategis BPI bersama mitra dan stakeholder untuk menciptakan dampak nyata bagi industri perfilman.',
                'deskripsi_en' => 'Strategic BPI projects with partners and stakeholders to create meaningful impact for the film industry.',
                'gambar' => null,
                'icon' => 'fa-solid fa-film',
                'urutan' => 4,
                'status' => true,
            ],
            [
                'section' => 'program',
                'judul_id' => 'Program Strategis',
                'judul_en' => 'Strategic Programs',
                'deskripsi_id' => 'Program strategis untuk memperkuat fondasi, meningkatkan kapasitas, memperluas kolaborasi, dan menciptakan dampak berkelanjutan.',
                'deskripsi_en' => 'Strategic programs designed to strengthen foundations, improve capacity, expand collaboration, and create sustainable impact.',
                'gambar' => null,
                'icon' => 'fa-solid fa-chart-line',
                'urutan' => 5,
                'status' => true,
            ],
            [
                'section' => 'berita',
                'judul_id' => 'Artikel & Berita',
                'judul_en' => 'Articles & News',
                'deskripsi_id' => 'Ikuti perkembangan terbaru mengenai kebijakan, kegiatan, program, dan dinamika industri perfilman Indonesia.',
                'deskripsi_en' => 'Follow the latest developments in policies, activities, programs, and dynamics of the Indonesian film industry.',
                'gambar' => null,
                'icon' => 'fa-solid fa-newspaper',
                'urutan' => 6,
                'status' => true,
            ],
            [
                'section' => 'mitra',
                'judul_id' => 'Mitra Kami',
                'judul_en' => 'Our Partners',
                'deskripsi_id' => 'Bersama mitra strategis, internasional, industri, dan komunitas untuk memperkuat ekosistem perfilman Indonesia.',
                'deskripsi_en' => 'Together with strategic, international, industry, and community partners to strengthen the Indonesian film ecosystem.',
                'gambar' => null,
                'icon' => 'fa-solid fa-handshake',
                'urutan' => 7,
                'status' => true,
            ],
        ];

        foreach ($beranda as $item) {
            Beranda::create($item);
        }

        /*
        |--------------------------------------------------------------------------
        | STAKEHOLDER
        |--------------------------------------------------------------------------
        */

        $stakeholders = [
            [
                'nama_id' => 'Pemerintah',
                'nama_en' => 'Government',
                'deskripsi_id' => 'Lembaga pemerintah yang memiliki peran dalam kebijakan dan pengembangan industri perfilman Indonesia.',
                'deskripsi_en' => 'Government institutions involved in policy and the development of the Indonesian film industry.',
                'icon' => 'fa-solid fa-building-columns',
                'gambar' => null,
                'urutan' => 1,
                'status' => true,
            ],
            [
                'nama_id' => 'Produser',
                'nama_en' => 'Producers',
                'deskripsi_id' => 'Pelaku industri yang mengelola dan mengembangkan produksi karya film.',
                'deskripsi_en' => 'Industry professionals responsible for managing and developing film productions.',
                'icon' => 'fa-solid fa-clapperboard',
                'gambar' => null,
                'urutan' => 2,
                'status' => true,
            ],
            [
                'nama_id' => 'Sineas',
                'nama_en' => 'Filmmakers',
                'deskripsi_id' => 'Para kreator dan profesional yang menghasilkan karya perfilman Indonesia.',
                'deskripsi_en' => 'Creators and professionals producing Indonesian film works.',
                'icon' => 'fa-solid fa-film',
                'gambar' => null,
                'urutan' => 3,
                'status' => true,
            ],
            [
                'nama_id' => 'Asosiasi Profesi',
                'nama_en' => 'Professional Associations',
                'deskripsi_id' => 'Organisasi profesi yang menjadi bagian penting dari ekosistem perfilman nasional.',
                'deskripsi_en' => 'Professional organizations that form an important part of the national film ecosystem.',
                'icon' => 'fa-solid fa-users',
                'gambar' => null,
                'urutan' => 4,
                'status' => true,
            ],
            [
                'nama_id' => 'Komunitas',
                'nama_en' => 'Communities',
                'deskripsi_id' => 'Komunitas film yang berperan dalam membangun kreativitas dan partisipasi masyarakat.',
                'deskripsi_en' => 'Film communities that contribute to creativity and public participation.',
                'icon' => 'fa-solid fa-people-group',
                'gambar' => null,
                'urutan' => 5,
                'status' => true,
            ],
            [
                'nama_id' => 'Lembaga Pendidikan',
                'nama_en' => 'Educational Institutions',
                'deskripsi_id' => 'Institusi pendidikan yang mendukung pengembangan sumber daya manusia perfilman.',
                'deskripsi_en' => 'Educational institutions supporting the development of film industry talent.',
                'icon' => 'fa-solid fa-school',
                'gambar' => null,
                'urutan' => 6,
                'status' => true,
            ],
            [
                'nama_id' => 'Pelaku Industri',
                'nama_en' => 'Industry Players',
                'deskripsi_id' => 'Pelaku usaha dan organisasi yang mendukung rantai nilai industri perfilman.',
                'deskripsi_en' => 'Businesses and organizations supporting the film industry value chain.',
                'icon' => 'fa-solid fa-building',
                'gambar' => null,
                'urutan' => 7,
                'status' => true,
            ],
            [
                'nama_id' => 'Distributor',
                'nama_en' => 'Distributors',
                'deskripsi_id' => 'Mitra yang membantu memperluas distribusi karya film ke berbagai wilayah.',
                'deskripsi_en' => 'Partners helping expand film distribution across different regions.',
                'icon' => 'fa-solid fa-briefcase',
                'gambar' => null,
                'urutan' => 8,
                'status' => true,
            ],
            [
                'nama_id' => 'Eksibitor',
                'nama_en' => 'Exhibitors',
                'deskripsi_id' => 'Pelaku yang menyediakan ruang dan akses bagi masyarakat untuk menikmati karya film.',
                'deskripsi_en' => 'Industry players providing spaces and access for audiences to experience films.',
                'icon' => 'fa-solid fa-building',
                'gambar' => null,
                'urutan' => 9,
                'status' => true,
            ],
            [
                'nama_id' => 'Festival Film',
                'nama_en' => 'Film Festivals',
                'deskripsi_id' => 'Festival dan ajang perfilman yang menjadi ruang apresiasi dan promosi karya.',
                'deskripsi_en' => 'Film festivals and events serving as platforms for appreciation and promotion.',
                'icon' => 'fa-solid fa-ticket',
                'gambar' => null,
                'urutan' => 10,
                'status' => true,
            ],
            [
                'nama_id' => 'Media',
                'nama_en' => 'Media',
                'deskripsi_id' => 'Media yang berperan dalam menyebarkan informasi dan perkembangan industri perfilman.',
                'deskripsi_en' => 'Media organizations that distribute information about the film industry.',
                'icon' => 'fa-solid fa-newspaper',
                'gambar' => null,
                'urutan' => 11,
                'status' => true,
            ],
            [
                'nama_id' => 'Masyarakat',
                'nama_en' => 'Public',
                'deskripsi_id' => 'Masyarakat sebagai penonton, pengguna, sekaligus bagian dari ekosistem perfilman Indonesia.',
                'deskripsi_en' => 'The public as audiences, users, and an essential part of the Indonesian film ecosystem.',
                'icon' => 'fa-solid fa-users',
                'gambar' => null,
                'urutan' => 12,
                'status' => true,
            ],
        ];

        foreach ($stakeholders as $item) {
            Stakeholder::create($item);
        }

        /*
        |--------------------------------------------------------------------------
        | PROGRAM STRATEGIS
        |--------------------------------------------------------------------------
        */

        $programs = [
            [
                'judul_id' => 'Pembiayaan',
                'judul_en' => 'Financing',
                'deskripsi_id' => 'Mendorong inovasi melalui program kreatif dan akses modal yang berkelanjutan.',
                'deskripsi_en' => 'Encouraging innovation through creative programs and sustainable access to financing.',
                'icon' => 'fa-solid fa-money-bill-wave',
                'gambar' => null,
                'urutan' => 1,
                'status' => true,
            ],
            [
                'judul_id' => 'Pasar Global',
                'judul_en' => 'Global Market',
                'deskripsi_id' => 'Memperluas jangkauan film Indonesia ke pasar global melalui promosi, kolaborasi, dan kemitraan strategis.',
                'deskripsi_en' => 'Expanding Indonesian films into global markets through promotion, collaboration, and strategic partnerships.',
                'icon' => 'fa-solid fa-globe',
                'gambar' => null,
                'urutan' => 2,
                'status' => true,
            ],
            [
                'judul_id' => 'Pengembangan Talenta',
                'judul_en' => 'Talent Development',
                'deskripsi_id' => 'Fasilitasi peningkatan kualitas dan kesiapan talenta melalui berbagai program pengembangan.',
                'deskripsi_en' => 'Facilitating talent quality and readiness through various development programs.',
                'icon' => 'fa-solid fa-graduation-cap',
                'gambar' => null,
                'urutan' => 3,
                'status' => true,
            ],
            [
                'judul_id' => 'Infrastruktur',
                'judul_en' => 'Infrastructure',
                'deskripsi_id' => 'Memperkuat ekosistem produksi melalui dukungan fasilitas, teknologi, dan layanan terpadu.',
                'deskripsi_en' => 'Strengthening the production ecosystem through facilities, technology, and integrated services.',
                'icon' => 'fa-solid fa-building',
                'gambar' => null,
                'urutan' => 4,
                'status' => true,
            ],
        ];

        foreach ($programs as $item) {
            Program::create($item);
        }

        /*
        |--------------------------------------------------------------------------
        | PROYEK
        |--------------------------------------------------------------------------
        */

        $projects = [
            [
                'slug' => 'bpi-film-market',
                'judul_id' => 'BPI Film Market',
                'judul_en' => 'BPI Film Market',
                'kategori_id' => 'Pasar Film',
                'kategori_en' => 'Film Market',
                'deskripsi_singkat_id' => 'Pasar film nasional untuk mempertemukan pelaku industri, memperluas jaringan, dan mendorong pendanaan serta kerja sama produksi.',
                'deskripsi_singkat_en' => 'A national film market connecting industry players, expanding networks, and encouraging financing and production collaboration.',
                'deskripsi_id' => 'BPI Film Market adalah wadah strategis bagi produser, investor, distributor, lembaga pemerintah, dan pemangku kepentingan lainnya untuk mempertemukan kebutuhan dan peluang dalam industri perfilman Indonesia.',
                'deskripsi_en' => 'BPI Film Market is a strategic platform for producers, investors, distributors, government institutions, and other stakeholders to connect needs and opportunities within the Indonesian film industry.',
                'gambar_utama' => null,
                'lokasi_id' => 'Jakarta, Indonesia',
                'lokasi_en' => 'Jakarta, Indonesia',
                'tahun' => '2022 - Sekarang',
                'tujuan_id' => 'Mempertemukan pelaku industri film dengan investor, distributor, dan mitra strategis.',
                'tujuan_en' => 'Connecting film industry players with investors, distributors, and strategic partners.',
                'dampak_id' => 'Meningkatkan peluang pembiayaan dan distribusi film Indonesia.',
                'dampak_en' => 'Increasing financing and distribution opportunities for Indonesian films.',
                'kegiatan_utama_id' => 'Pitching film, forum diskusi industri, business matching, dan networking.',
                'kegiatan_utama_en' => 'Film pitching, industry discussions, business matching, and networking.',
                'capaian_id' => 'Mendorong terciptanya kolaborasi dan peluang pembiayaan baru.',
                'capaian_en' => 'Encouraging new collaborations and financing opportunities.',
                'timeline_id' => '2022 - Sekarang',
                'timeline_en' => '2022 - Present',
                'status' => 'published',
                'urutan' => 1,
            ],
            [
                'slug' => 'indonesia-film-festival-network',
                'judul_id' => 'Indonesia Film Festival Network',
                'judul_en' => 'Indonesia Film Festival Network',
                'kategori_id' => 'Festival',
                'kategori_en' => 'Festival',
                'deskripsi_singkat_id' => 'Jaringan festival film di berbagai daerah untuk memperluas akses apresiasi dan distribusi film Indonesia.',
                'deskripsi_singkat_en' => 'A network of film festivals across regions to expand access to appreciation and distribution of Indonesian films.',
                'deskripsi_id' => 'Program penguatan jaringan festival film Indonesia sebagai ruang bertemunya sineas, penonton, komunitas, dan pelaku industri.',
                'deskripsi_en' => 'A program strengthening Indonesian film festival networks as spaces connecting filmmakers, audiences, communities, and industry players.',
                'gambar_utama' => null,
                'lokasi_id' => 'Indonesia',
                'lokasi_en' => 'Indonesia',
                'tahun' => '2023 - Sekarang',
                'tujuan_id' => 'Memperkuat jaringan festival film nasional.',
                'tujuan_en' => 'Strengthening the national film festival network.',
                'dampak_id' => 'Memperluas akses masyarakat terhadap karya film Indonesia.',
                'dampak_en' => 'Expanding public access to Indonesian film works.',
                'kegiatan_utama_id' => 'Kolaborasi festival, program screening, diskusi, dan promosi film.',
                'kegiatan_utama_en' => 'Festival collaboration, screenings, discussions, and film promotion.',
                'capaian_id' => 'Terbentuknya jaringan kolaborasi festival film antar daerah.',
                'capaian_en' => 'Establishing collaborative networks between film festivals across regions.',
                'timeline_id' => '2023 - Sekarang',
                'timeline_en' => '2023 - Present',
                'status' => 'published',
                'urutan' => 2,
            ],
            [
                'slug' => 'co-production-indonesia',
                'judul_id' => 'Co-Production Indonesia',
                'judul_en' => 'Co-Production Indonesia',
                'kategori_id' => 'Produksi',
                'kategori_en' => 'Production',
                'deskripsi_singkat_id' => 'Program kolaborasi produksi film dengan negara mitra untuk meningkatkan kualitas dan jangkauan global.',
                'deskripsi_singkat_en' => 'A film production collaboration program with partner countries to improve quality and expand global reach.',
                'deskripsi_id' => 'Program yang membuka peluang kerja sama produksi antara sineas Indonesia dengan mitra internasional.',
                'deskripsi_en' => 'A program creating co-production opportunities between Indonesian filmmakers and international partners.',
                'gambar_utama' => null,
                'lokasi_id' => 'Indonesia & Internasional',
                'lokasi_en' => 'Indonesia & International',
                'tahun' => '2025 - Sekarang',
                'tujuan_id' => 'Membuka akses kolaborasi produksi film lintas negara.',
                'tujuan_en' => 'Creating access to cross-border film production collaboration.',
                'dampak_id' => 'Meningkatkan kualitas dan jangkauan film Indonesia.',
                'dampak_en' => 'Improving the quality and reach of Indonesian films.',
                'kegiatan_utama_id' => 'Forum co-production, pitching, business matching, dan networking internasional.',
                'kegiatan_utama_en' => 'Co-production forums, pitching, business matching, and international networking.',
                'capaian_id' => 'Terbukanya peluang kerja sama produksi dengan mitra internasional.',
                'capaian_en' => 'Creating new production collaboration opportunities with international partners.',
                'timeline_id' => '2025 - Sekarang',
                'timeline_en' => '2025 - Present',
                'status' => 'published',
                'urutan' => 3,
            ],
            [
                'slug' => 'digital-cinema-innovation-hub',
                'judul_id' => 'Digital Cinema Innovation Hub',
                'judul_en' => 'Digital Cinema Innovation Hub',
                'kategori_id' => 'Teknologi',
                'kategori_en' => 'Technology',
                'deskripsi_singkat_id' => 'Hub inovasi yang menggabungkan teknologi sinema dengan pengembangan talenta dan transformasi digital industri film Indonesia.',
                'deskripsi_singkat_en' => 'An innovation hub combining cinema technology, talent development, and digital transformation of the Indonesian film industry.',
                'deskripsi_id' => 'Inisiatif pengembangan ekosistem digital perfilman untuk mendorong inovasi teknologi dan kesiapan industri menghadapi perubahan digital.',
                'deskripsi_en' => 'An initiative developing a digital film ecosystem to encourage technological innovation and industry readiness for digital transformation.',
                'gambar_utama' => null,
                'lokasi_id' => 'Indonesia',
                'lokasi_en' => 'Indonesia',
                'tahun' => '2025 - Sekarang',
                'tujuan_id' => 'Mendorong pemanfaatan teknologi dalam industri perfilman.',
                'tujuan_en' => 'Encouraging the use of technology in the film industry.',
                'dampak_id' => 'Meningkatkan inovasi dan efisiensi proses perfilman.',
                'dampak_en' => 'Improving innovation and efficiency in filmmaking processes.',
                'kegiatan_utama_id' => 'Workshop teknologi, inkubasi inovasi, riset, dan pengembangan platform digital.',
                'kegiatan_utama_en' => 'Technology workshops, innovation incubation, research, and digital platform development.',
                'capaian_id' => 'Terbentuknya ruang kolaborasi teknologi dan perfilman.',
                'capaian_en' => 'Creating a collaborative space between technology and cinema.',
                'timeline_id' => '2025 - Sekarang',
                'timeline_en' => '2025 - Present',
                'status' => 'published',
                'urutan' => 4,
            ],
            [
                'slug' => 'film-heritage-restoration',
                'judul_id' => 'Film Heritage Restoration',
                'judul_en' => 'Film Heritage Restoration',
                'kategori_id' => 'Pelestarian',
                'kategori_en' => 'Preservation',
                'deskripsi_singkat_id' => 'Program restorasi dan pelestarian karya film warisan budaya Indonesia.',
                'deskripsi_singkat_en' => 'A program for restoring and preserving Indonesian film heritage.',
                'deskripsi_id' => 'Inisiatif untuk menjaga karya film bersejarah agar tetap dapat diakses dan dipelajari oleh generasi mendatang.',
                'deskripsi_en' => 'An initiative to preserve historical films so they remain accessible and meaningful for future generations.',
                'gambar_utama' => null,
                'lokasi_id' => 'Indonesia',
                'lokasi_en' => 'Indonesia',
                'tahun' => '2024 - Sekarang',
                'tujuan_id' => 'Melestarikan warisan perfilman Indonesia.',
                'tujuan_en' => 'Preserving Indonesian film heritage.',
                'dampak_id' => 'Menjaga akses terhadap karya film bersejarah.',
                'dampak_en' => 'Maintaining access to historical film works.',
                'kegiatan_utama_id' => 'Restorasi film, digitalisasi arsip, kurasi, dan dokumentasi.',
                'kegiatan_utama_en' => 'Film restoration, archive digitization, curation, and documentation.',
                'capaian_id' => 'Meningkatkan ketersediaan arsip film nasional.',
                'capaian_en' => 'Increasing the availability of national film archives.',
                'timeline_id' => '2024 - Sekarang',
                'timeline_en' => '2024 - Present',
                'status' => 'published',
                'urutan' => 5,
            ],
            [
                'slug' => 'green-production-initiative',
                'judul_id' => 'Green Production Initiative',
                'judul_en' => 'Green Production Initiative',
                'kategori_id' => 'Lingkungan',
                'kategori_en' => 'Environment',
                'deskripsi_singkat_id' => 'Mendorong praktik produksi film yang lebih ramah lingkungan dan berkelanjutan.',
                'deskripsi_singkat_en' => 'Encouraging more environmentally friendly and sustainable film production practices.',
                'deskripsi_id' => 'Program untuk meningkatkan kesadaran industri terhadap dampak lingkungan dari proses produksi film.',
                'deskripsi_en' => 'A program increasing industry awareness of the environmental impact of film production.',
                'gambar_utama' => null,
                'lokasi_id' => 'Indonesia',
                'lokasi_en' => 'Indonesia',
                'tahun' => '2025 - Sekarang',
                'tujuan_id' => 'Mendorong produksi film yang lebih berkelanjutan.',
                'tujuan_en' => 'Encouraging more sustainable film production.',
                'dampak_id' => 'Mengurangi dampak lingkungan dari kegiatan produksi.',
                'dampak_en' => 'Reducing the environmental impact of production activities.',
                'kegiatan_utama_id' => 'Edukasi green production, panduan produksi, dan kampanye industri hijau.',
                'kegiatan_utama_en' => 'Green production education, production guidelines, and green industry campaigns.',
                'capaian_id' => 'Meningkatnya kesadaran terhadap praktik produksi berkelanjutan.',
                'capaian_en' => 'Increasing awareness of sustainable production practices.',
                'timeline_id' => '2025 - Sekarang',
                'timeline_en' => '2025 - Present',
                'status' => 'published',
                'urutan' => 6,
            ],
            [
                'slug' => 'talent-mobility-program',
                'judul_id' => 'Talent Mobility Program',
                'judul_en' => 'Talent Mobility Program',
                'kategori_id' => 'Talenta',
                'kategori_en' => 'Talent',
                'deskripsi_singkat_id' => 'Program pertukaran dan mobilitas residensi untuk talenta film Indonesia di tingkat nasional dan global.',
                'deskripsi_singkat_en' => 'A mobility and residency program for Indonesian film talent at national and global levels.',
                'deskripsi_id' => 'Program pengembangan talenta melalui pertukaran pengalaman, residensi, dan kesempatan kolaborasi lintas negara.',
                'deskripsi_en' => 'A talent development program through experience exchange, residencies, and cross-border collaboration opportunities.',
                'gambar_utama' => null,
                'lokasi_id' => 'Indonesia & Internasional',
                'lokasi_en' => 'Indonesia & International',
                'tahun' => '2025 - Sekarang',
                'tujuan_id' => 'Meningkatkan pengalaman dan jaringan profesional talenta film Indonesia.',
                'tujuan_en' => 'Improving the experience and professional networks of Indonesian film talent.',
                'dampak_id' => 'Membuka kesempatan pengembangan karier internasional.',
                'dampak_en' => 'Opening international career development opportunities.',
                'kegiatan_utama_id' => 'Residensi, fellowship, pertukaran talenta, dan networking.',
                'kegiatan_utama_en' => 'Residencies, fellowships, talent exchange, and networking.',
                'capaian_id' => 'Terbentuknya jejaring talenta film lintas negara.',
                'capaian_en' => 'Establishing cross-border film talent networks.',
                'timeline_id' => '2025 - Sekarang',
                'timeline_en' => '2025 - Present',
                'status' => 'published',
                'urutan' => 7,
            ],
            [
                'slug' => 'film-literacy-movement',
                'judul_id' => 'Film Literacy Movement',
                'judul_en' => 'Film Literacy Movement',
                'kategori_id' => 'Literasi',
                'kategori_en' => 'Literacy',
                'deskripsi_singkat_id' => 'Gerakan literasi film untuk meningkatkan apresiasi, edukasi, dan pemahaman masyarakat terhadap karya sinema Indonesia.',
                'deskripsi_singkat_en' => 'A film literacy movement to improve public appreciation, education, and understanding of Indonesian cinema.',
                'deskripsi_id' => 'Gerakan untuk memperluas pemahaman masyarakat mengenai film sebagai karya seni, media komunikasi, dan bagian dari kebudayaan.',
                'deskripsi_en' => 'A movement expanding public understanding of film as art, communication, and culture.',
                'gambar_utama' => null,
                'lokasi_id' => 'Indonesia',
                'lokasi_en' => 'Indonesia',
                'tahun' => '2025 - Sekarang',
                'tujuan_id' => 'Meningkatkan literasi dan apresiasi masyarakat terhadap film.',
                'tujuan_en' => 'Improving public film literacy and appreciation.',
                'dampak_id' => 'Terbentuknya penonton yang kritis dan apresiatif.',
                'dampak_en' => 'Building critical and appreciative audiences.',
                'kegiatan_utama_id' => 'Kelas film, diskusi, screening, edukasi, dan kampanye literasi.',
                'kegiatan_utama_en' => 'Film classes, discussions, screenings, education, and literacy campaigns.',
                'capaian_id' => 'Meningkatnya partisipasi masyarakat dalam kegiatan literasi film.',
                'capaian_en' => 'Increasing public participation in film literacy activities.',
                'timeline_id' => '2025 - Sekarang',
                'timeline_en' => '2025 - Present',
                'status' => 'published',
                'urutan' => 8,
            ],
        ];

        $createdProjects = [];

        foreach ($projects as $project) {
            $createdProjects[] = Proyek::create($project);
        }

        /*
        |--------------------------------------------------------------------------
        | GALERI PROYEK
        |--------------------------------------------------------------------------
        */

        foreach ($createdProjects as $index => $project) {
            ProyekGaleri::create([
                'proyek_id' => $project->id,
                'gambar' => 'placeholder_proyek.jpg',
                'judul_id' => 'Dokumentasi ' . $project->judul_id,
                'judul_en' => 'Documentation of ' . $project->judul_en,
                'deskripsi_id' => 'Dokumentasi kegiatan dan perkembangan proyek ' . $project->judul_id . '.',
                'deskripsi_en' => 'Documentation of activities and development of ' . $project->judul_en . '.',
                'urutan' => 1,
                'status' => true,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | MITRA
        |--------------------------------------------------------------------------
        */

        $mitras = [
            // STRATEGIS
            [
                'nama_id' => 'Kementerian Kebudayaan',
                'nama_en' => 'Ministry of Culture',
                'kategori_id' => 'Strategis',
                'kategori_en' => 'Strategic',
                'deskripsi_id' => 'Mitra strategis dalam pengembangan kebijakan kebudayaan dan perfilman.',
                'deskripsi_en' => 'Strategic partner in cultural and film policy development.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Indonesia',
                'alamat_en' => 'Indonesia',
                'urutan' => 1,
                'status' => true,
            ],
            [
                'nama_id' => 'Badan Ekonomi Kreatif',
                'nama_en' => 'Creative Economy Agency',
                'kategori_id' => 'Strategis',
                'kategori_en' => 'Strategic',
                'deskripsi_id' => 'Mitra dalam pengembangan ekonomi kreatif dan industri perfilman.',
                'deskripsi_en' => 'Partner in creative economy and film industry development.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Indonesia',
                'alamat_en' => 'Indonesia',
                'urutan' => 2,
                'status' => true,
            ],
            [
                'nama_id' => 'Badan Perfilman Indonesia',
                'nama_en' => 'Indonesian Film Board',
                'kategori_id' => 'Strategis',
                'kategori_en' => 'Strategic',
                'deskripsi_id' => 'Lembaga yang memperkuat koordinasi dan pengembangan ekosistem perfilman nasional.',
                'deskripsi_en' => 'An organization strengthening coordination and development of the national film ecosystem.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Jakarta, Indonesia',
                'alamat_en' => 'Jakarta, Indonesia',
                'urutan' => 3,
                'status' => true,
            ],
            [
                'nama_id' => 'Kementerian Pendidikan',
                'nama_en' => 'Ministry of Education',
                'kategori_id' => 'Strategis',
                'kategori_en' => 'Strategic',
                'deskripsi_id' => 'Mitra dalam pengembangan pendidikan dan sumber daya manusia perfilman.',
                'deskripsi_en' => 'Partner in education and film industry talent development.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Indonesia',
                'alamat_en' => 'Indonesia',
                'urutan' => 4,
                'status' => true,
            ],
            // INTERNASIONAL
            [
                'nama_id' => 'European Film Agencies',
                'nama_en' => 'European Film Agencies',
                'kategori_id' => 'Internasional',
                'kategori_en' => 'International',
                'deskripsi_id' => 'Mitra internasional untuk pengembangan dan kolaborasi perfilman.',
                'deskripsi_en' => 'International partner for film development and collaboration.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Eropa',
                'alamat_en' => 'Europe',
                'urutan' => 5,
                'status' => true,
            ],
            [
                'nama_id' => 'Asian Film Network',
                'nama_en' => 'Asian Film Network',
                'kategori_id' => 'Internasional',
                'kategori_en' => 'International',
                'deskripsi_id' => 'Jaringan kolaborasi perfilman Asia.',
                'deskripsi_en' => 'Asian film collaboration network.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Asia',
                'alamat_en' => 'Asia',
                'urutan' => 6,
                'status' => true,
            ],
            [
                'nama_id' => 'Tokyo International Film Festival',
                'nama_en' => 'Tokyo International Film Festival',
                'kategori_id' => 'Internasional',
                'kategori_en' => 'International',
                'deskripsi_id' => 'Festival film internasional untuk memperluas jejaring dan promosi film Indonesia.',
                'deskripsi_en' => 'International film festival supporting networking and promotion of Indonesian films.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Tokyo, Jepang',
                'alamat_en' => 'Tokyo, Japan',
                'urutan' => 7,
                'status' => true,
            ],
            [
                'nama_id' => 'Cine Foundation',
                'nama_en' => 'Cine Foundation',
                'kategori_id' => 'Internasional',
                'kategori_en' => 'International',
                'deskripsi_id' => 'Mitra pengembangan dan pelestarian sinema internasional.',
                'deskripsi_en' => 'International partner for cinema development and preservation.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Internasional',
                'alamat_en' => 'International',
                'urutan' => 8,
                'status' => true,
            ],
            // INDUSTRI
            [
                'nama_id' => 'Co-Production Network',
                'nama_en' => 'Co-Production Network',
                'kategori_id' => 'Industri',
                'kategori_en' => 'Industry',
                'deskripsi_id' => 'Jaringan pelaku industri untuk kerja sama produksi film.',
                'deskripsi_en' => 'Industry network supporting film production collaboration.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Indonesia',
                'alamat_en' => 'Indonesia',
                'urutan' => 9,
                'status' => true,
            ],
            [
                'nama_id' => 'Cinema Indonesia',
                'nama_en' => 'Cinema Indonesia',
                'kategori_id' => 'Industri',
                'kategori_en' => 'Industry',
                'deskripsi_id' => 'Mitra dalam pengembangan dan distribusi perfilman nasional.',
                'deskripsi_en' => 'Partner in national film development and distribution.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Indonesia',
                'alamat_en' => 'Indonesia',
                'urutan' => 10,
                'status' => true,
            ],
            [
                'nama_id' => 'PT Kreasi Film Nusantara',
                'nama_en' => 'PT Kreasi Film Nusantara',
                'kategori_id' => 'Industri',
                'kategori_en' => 'Industry',
                'deskripsi_id' => 'Perusahaan produksi yang mendukung pengembangan karya film Indonesia.',
                'deskripsi_en' => 'Production company supporting the development of Indonesian film works.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Jakarta, Indonesia',
                'alamat_en' => 'Jakarta, Indonesia',
                'urutan' => 11,
                'status' => true,
            ],
            [
                'nama_id' => 'Industri Perfilman',
                'nama_en' => 'Film Industry',
                'kategori_id' => 'Industri',
                'kategori_en' => 'Industry',
                'deskripsi_id' => 'Mitra dari berbagai sektor yang mendukung rantai industri perfilman.',
                'deskripsi_en' => 'Partners from various sectors supporting the film industry value chain.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Indonesia',
                'alamat_en' => 'Indonesia',
                'urutan' => 12,
                'status' => true,
            ],
            // KOMUNITAS
            [
                'nama_id' => 'Asosiasi Film Indonesia',
                'nama_en' => 'Indonesian Film Association',
                'kategori_id' => 'Komunitas',
                'kategori_en' => 'Community',
                'deskripsi_id' => 'Komunitas profesional yang mendukung perkembangan perfilman Indonesia.',
                'deskripsi_en' => 'Professional community supporting the development of Indonesian cinema.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Indonesia',
                'alamat_en' => 'Indonesia',
                'urutan' => 13,
                'status' => true,
            ],
            [
                'nama_id' => 'Film Festival Network',
                'nama_en' => 'Film Festival Network',
                'kategori_id' => 'Komunitas',
                'kategori_en' => 'Community',
                'deskripsi_id' => 'Jaringan komunitas festival film Indonesia.',
                'deskripsi_en' => 'Indonesian film festival community network.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Indonesia',
                'alamat_en' => 'Indonesia',
                'urutan' => 14,
                'status' => true,
            ],
            [
                'nama_id' => 'Komunitas Film Nusantara',
                'nama_en' => 'Nusantara Film Community',
                'kategori_id' => 'Komunitas',
                'kategori_en' => 'Community',
                'deskripsi_id' => 'Komunitas film yang mendorong kreativitas dan apresiasi masyarakat.',
                'deskripsi_en' => 'Film community promoting creativity and public appreciation.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Indonesia',
                'alamat_en' => 'Indonesia',
                'urutan' => 15,
                'status' => true,
            ],
            [
                'nama_id' => 'Lembaga Literasi Film',
                'nama_en' => 'Film Literacy Organization',
                'kategori_id' => 'Komunitas',
                'kategori_en' => 'Community',
                'deskripsi_id' => 'Komunitas yang bergerak dalam pendidikan dan literasi film.',
                'deskripsi_en' => 'Community focused on film education and literacy.',
                'logo' => null,
                'website' => null,
                'alamat_id' => 'Indonesia',
                'alamat_en' => 'Indonesia',
                'urutan' => 16,
                'status' => true,
            ],
        ];

        foreach ($mitras as $item) {
            Mitra::create($item);
        }

        /*
        |--------------------------------------------------------------------------
        | BERITA
        |--------------------------------------------------------------------------
        */

        $beritas = [
            [
                'slug' => 'rapat-koordinasi-nasional-bpi-menetapkan-fokus-utama-tahun-depan',
                'judul_id' => 'Rapat Koordinasi Nasional BPI Menetapkan Fokus Utama Tahun Depan',
                'judul_en' => 'BPI National Coordination Meeting Sets Main Focus for Next Year',
                'ringkasan_id' => 'BPI menyelenggarakan rapat koordinasi nasional untuk menetapkan fokus utama pengembangan perfilman Indonesia.',
                'ringkasan_en' => 'BPI held a national coordination meeting to establish the main focus for the development of Indonesian cinema.',
                'isi_id' => 'BPI menyelenggarakan Rapat Koordinasi Nasional sebagai bagian dari upaya memperkuat koordinasi dan kolaborasi antar pemangku kepentingan perfilman Indonesia. Pertemuan ini membahas strategi, program, dan prioritas pengembangan industri perfilman untuk periode mendatang.',
                'isi_en' => 'BPI held a National Coordination Meeting as part of its efforts to strengthen coordination and collaboration among Indonesian film industry stakeholders. The meeting discussed strategies, programs, and priorities for the development of the film industry.',
                'gambar_utama' => null,
                'kategori_id' => 'Event',
                'kategori_en' => 'Event',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-08-12',
                'kutipan_id' => 'Kolaborasi merupakan fondasi penting untuk membangun ekosistem perfilman Indonesia yang kuat.',
                'kutipan_en' => 'Collaboration is an important foundation for building a strong Indonesian film ecosystem.',
                'status' => 'published',
            ],
            [
                'slug' => 'penguatan-ekosistem-perfilman-indonesia',
                'judul_id' => 'Penguatan Ekosistem Perfilman Indonesia',
                'judul_en' => 'Strengthening the Indonesian Film Ecosystem',
                'ringkasan_id' => 'BPI terus mendorong kolaborasi antar pelaku industri untuk memperkuat ekosistem perfilman nasional.',
                'ringkasan_en' => 'BPI continues to encourage collaboration among industry players to strengthen the national film ecosystem.',
                'isi_id' => 'Penguatan ekosistem menjadi salah satu fokus utama BPI melalui kolaborasi antara pemerintah, asosiasi profesi, komunitas, pelaku industri, dan masyarakat.',
                'isi_en' => 'Strengthening the ecosystem is one of BPI main focuses through collaboration between government, professional associations, communities, industry players, and the public.',
                'gambar_utama' => null,
                'kategori_id' => 'Berita',
                'kategori_en' => 'News',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-08-10',
                'kutipan_id' => 'Ekosistem yang kuat lahir dari kolaborasi yang berkelanjutan.',
                'kutipan_en' => 'A strong ecosystem is built through sustainable collaboration.',
                'status' => 'published',
            ],
            [
                'slug' => 'kolaborasi-film-indonesia-menuju-pasar-global',
                'judul_id' => 'Kolaborasi Film Indonesia Menuju Pasar Global',
                'judul_en' => 'Indonesian Film Collaboration Towards the Global Market',
                'ringkasan_id' => 'Kolaborasi internasional membuka peluang baru bagi karya dan talenta perfilman Indonesia.',
                'ringkasan_en' => 'International collaboration creates new opportunities for Indonesian films and talent.',
                'isi_id' => 'BPI mendorong peningkatan kolaborasi internasional untuk membuka akses terhadap pasar, pendanaan, jaringan, dan pengembangan talenta perfilman Indonesia.',
                'isi_en' => 'BPI encourages increased international collaboration to provide access to markets, financing, networks, and talent development opportunities.',
                'gambar_utama' => null,
                'kategori_id' => 'Opini',
                'kategori_en' => 'Opinion',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-08-08',
                'kutipan_id' => 'Film Indonesia memiliki potensi besar untuk berkembang di tingkat global.',
                'kutipan_en' => 'Indonesian films have great potential to grow in the global market.',
                'status' => 'published',
            ],
            [
                'slug' => 'pengembangan-talenta-perfilman',
                'judul_id' => 'Pengembangan Talenta Perfilman Indonesia',
                'judul_en' => 'Developing Indonesian Film Talent',
                'ringkasan_id' => 'Pengembangan talenta menjadi bagian penting dalam membangun masa depan industri perfilman.',
                'ringkasan_en' => 'Talent development is an important part of building the future of the film industry.',
                'isi_id' => 'BPI berkomitmen untuk mendukung peningkatan kompetensi dan mobilitas talenta melalui program pendidikan, pelatihan, residensi, dan kolaborasi.',
                'isi_en' => 'BPI is committed to improving talent competency and mobility through education, training, residency, and collaboration programs.',
                'gambar_utama' => null,
                'kategori_id' => 'Industri',
                'kategori_en' => 'Industry',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-08-05',
                'kutipan_id' => 'Talenta merupakan fondasi utama kemajuan industri kreatif.',
                'kutipan_en' => 'Talent is the main foundation of creative industry development.',
                'status' => 'published',
            ],
            [
                'slug' => 'transformasi-digital-industri-film',
                'judul_id' => 'Transformasi Digital Industri Film',
                'judul_en' => 'Digital Transformation of the Film Industry',
                'ringkasan_id' => 'Teknologi membuka ruang baru untuk inovasi dan pengembangan industri perfilman.',
                'ringkasan_en' => 'Technology opens new opportunities for innovation and development in the film industry.',
                'isi_id' => 'Transformasi digital menjadi peluang penting bagi industri perfilman Indonesia untuk meningkatkan efisiensi, kreativitas, distribusi, dan akses terhadap penonton.',
                'isi_en' => 'Digital transformation is an important opportunity for Indonesian cinema to improve efficiency, creativity, distribution, and audience access.',
                'gambar_utama' => null,
                'kategori_id' => 'Teknologi',
                'kategori_en' => 'Technology',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-08-02',
                'kutipan_id' => 'Teknologi dan kreativitas harus berjalan bersama untuk menciptakan masa depan sinema.',
                'kutipan_en' => 'Technology and creativity must work together to create the future of cinema.',
                'status' => 'published',
            ],
            [
                'slug' => 'pelestarian-warisan-film-indonesia',
                'judul_id' => 'Pelestarian Warisan Film Indonesia',
                'judul_en' => 'Preserving Indonesian Film Heritage',
                'ringkasan_id' => 'Pelestarian arsip film menjadi bagian penting dalam menjaga sejarah dan identitas budaya bangsa.',
                'ringkasan_en' => 'Film archive preservation is essential to maintaining the nation cultural history and identity.',
                'isi_id' => 'BPI mendukung berbagai upaya pelestarian, digitalisasi, dan restorasi karya film Indonesia agar dapat dinikmati oleh generasi mendatang.',
                'isi_en' => 'BPI supports preservation, digitization, and restoration efforts so Indonesian films can be enjoyed by future generations.',
                'gambar_utama' => null,
                'kategori_id' => 'Budaya',
                'kategori_en' => 'Culture',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-07-28',
                'kutipan_id' => 'Warisan film merupakan bagian dari memori dan identitas bangsa.',
                'kutipan_en' => 'Film heritage is part of the memory and identity of a nation.',
                'status' => 'published',
            ],
            [
                'slug' => 'menuju-industri-film-yang-berkelanjutan',
                'judul_id' => 'Menuju Industri Film yang Berkelanjutan',
                'judul_en' => 'Towards a Sustainable Film Industry',
                'ringkasan_id' => 'BPI mendorong praktik industri yang inklusif, sehat, dan berkelanjutan.',
                'ringkasan_en' => 'BPI promotes an inclusive, healthy, and sustainable film industry.',
                'isi_id' => 'Keberlanjutan industri perfilman membutuhkan kolaborasi jangka panjang, tata kelola yang baik, pengembangan talenta, inovasi, dan perhatian terhadap lingkungan.',
                'isi_en' => 'A sustainable film industry requires long-term collaboration, good governance, talent development, innovation, and environmental awareness.',
                'gambar_utama' => null,
                'kategori_id' => 'Industri',
                'kategori_en' => 'Industry',
                'penulis' => 'BPI',
                'tanggal_publikasi' => '2026-07-25',
                'kutipan_id' => 'Industri yang sehat adalah industri yang mampu tumbuh bersama seluruh ekosistemnya.',
                'kutipan_en' => 'A healthy industry is one that grows together with its entire ecosystem.',
                'status' => 'published',
            ],
        ];

        $createdNews = [];

        foreach ($beritas as $berita) {
            $createdNews[] = Berita::create($berita);
        }

        /*
        |--------------------------------------------------------------------------
        | GALERI BERITA (FIXED - menggunakan placeholder)
        |--------------------------------------------------------------------------
        */

        foreach ($createdNews as $berita) {
            BeritaGaleri::create([
                'berita_id' => $berita->id,
                'gambar' => 'placeholder_berita_' . $berita->id . '.jpg',
                'caption_id' => 'Dokumentasi ' . $berita->judul_id,
                'caption_en' => 'Documentation of ' . $berita->judul_en,
                'urutan' => 1,
                'status' => true,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | TENTANG
        |--------------------------------------------------------------------------
        */

        $tentang = [
            [
                'section' => 'hero',
                'judul_id' => 'Membangun Masa Depan Sinema Nasional',
                'judul_en' => 'Building the Future of National Cinema',
                'subjudul_id' => 'Badan Perfilman Indonesia',
                'subjudul_en' => 'Indonesian Film Board',
                'deskripsi_id' => 'BPI hadir sebagai wadah strategis yang menghubungkan berbagai pemangku kepentingan untuk membangun ekosistem perfilman Indonesia yang sehat, inklusif, dan berkelanjutan.',
                'deskripsi_en' => 'BPI serves as a strategic platform connecting stakeholders to build a healthy, inclusive, and sustainable Indonesian film ecosystem.',
                'gambar' => null,
                'icon' => null,
                'urutan' => 1,
                'status' => true,
            ],
            [
                'section' => 'visi',
                'judul_id' => 'Visi Kami',
                'judul_en' => 'Our Vision',
                'subjudul_id' => 'Menjadi institusi yang menghubungkan film Indonesia yang unggul dan kompetitif dengan semangat kebangsaan dan budaya.',
                'subjudul_en' => 'To become an institution connecting excellent and competitive Indonesian cinema with national spirit and culture.',
                'deskripsi_id' => 'Mewujudkan ekosistem perfilman Indonesia yang kuat, inklusif, profesional, kreatif, dan mampu bersaing di tingkat global.',
                'deskripsi_en' => 'Building a strong, inclusive, professional, creative, and globally competitive Indonesian film ecosystem.',
                'gambar' => null,
                'icon' => 'fa-solid fa-eye',
                'urutan' => 2,
                'status' => true,
            ],
            [
                'section' => 'misi',
                'judul_id' => 'Misi Kami',
                'judul_en' => 'Our Mission',
                'subjudul_id' => 'Menghubungkan, memperkuat, dan mengakselerasi seluruh potensi perfilman Indonesia.',
                'subjudul_en' => 'Connecting, strengthening, and accelerating the full potential of Indonesian cinema.',
                'deskripsi_id' => 'Mendorong kolaborasi, meningkatkan kapasitas talenta, memperluas akses pasar, memperkuat kebijakan, dan menciptakan inovasi yang mendukung keberlanjutan industri.',
                'deskripsi_en' => 'Promoting collaboration, improving talent capacity, expanding market access, strengthening policy, and creating innovations that support industry sustainability.',
                'gambar' => null,
                'icon' => 'fa-solid fa-bullseye',
                'urutan' => 3,
                'status' => true,
            ],
            [
                'section' => 'nilai',
                'judul_id' => 'Nilai Kami',
                'judul_en' => 'Our Values',
                'subjudul_id' => 'Kolaborasi, profesionalisme, inovasi, inklusivitas, dan keberlanjutan.',
                'subjudul_en' => 'Collaboration, professionalism, innovation, inclusivity, and sustainability.',
                'deskripsi_id' => 'Nilai-nilai tersebut menjadi dasar BPI dalam menjalankan peran sebagai penggerak dan penghubung ekosistem perfilman nasional.',
                'deskripsi_en' => 'These values guide BPI in its role as a driver and connector of the national film ecosystem.',
                'gambar' => null,
                'icon' => 'fa-solid fa-star',
                'urutan' => 4,
                'status' => true,
            ],
        ];

        foreach ($tentang as $item) {
            Tentang::create($item);
        }

        /*
        |--------------------------------------------------------------------------
        | STRUKTUR ORGANISASI
        |--------------------------------------------------------------------------
        */

        $struktur = [
            [
                'nama' => 'Nama Pengurus 1',
                'jabatan_id' => 'Ketua',
                'jabatan_en' => 'Chairperson',
                'foto' => null,
                'deskripsi_id' => 'Memimpin arah strategis dan koordinasi organisasi BPI.',
                'deskripsi_en' => 'Leads the strategic direction and organizational coordination of BPI.',
                'linkedin' => null,
                'instagram' => null,
                'email' => null,
                'telepon' => null,
                'urutan' => 1,
                'status' => true,
            ],
            [
                'nama' => 'Nama Pengurus 2',
                'jabatan_id' => 'Wakil Ketua',
                'jabatan_en' => 'Vice Chairperson',
                'foto' => null,
                'deskripsi_id' => 'Mendukung koordinasi dan pelaksanaan program strategis BPI.',
                'deskripsi_en' => 'Supports coordination and implementation of BPI strategic programs.',
                'linkedin' => null,
                'instagram' => null,
                'email' => null,
                'telepon' => null,
                'urutan' => 2,
                'status' => true,
            ],
            [
                'nama' => 'Nama Pengurus 3',
                'jabatan_id' => 'Sekretaris',
                'jabatan_en' => 'Secretary',
                'foto' => null,
                'deskripsi_id' => 'Mengelola administrasi dan koordinasi internal organisasi.',
                'deskripsi_en' => 'Manages administration and internal organizational coordination.',
                'linkedin' => null,
                'instagram' => null,
                'email' => null,
                'telepon' => null,
                'urutan' => 3,
                'status' => true,
            ],
            [
                'nama' => 'Nama Pengurus 4',
                'jabatan_id' => 'Bendahara',
                'jabatan_en' => 'Treasurer',
                'foto' => null,
                'deskripsi_id' => 'Mengelola administrasi dan tata kelola keuangan organisasi.',
                'deskripsi_en' => 'Manages financial administration and governance.',
                'linkedin' => null,
                'instagram' => null,
                'email' => null,
                'telepon' => null,
                'urutan' => 4,
                'status' => true,
            ],
            [
                'nama' => 'Nama Pengurus 5',
                'jabatan_id' => 'Koordinator Program',
                'jabatan_en' => 'Program Coordinator',
                'foto' => null,
                'deskripsi_id' => 'Mengkoordinasikan program dan inisiatif strategis BPI.',
                'deskripsi_en' => 'Coordinates BPI strategic programs and initiatives.',
                'linkedin' => null,
                'instagram' => null,
                'email' => null,
                'telepon' => null,
                'urutan' => 5,
                'status' => true,
            ],
        ];

        foreach ($struktur as $item) {
            StrukturOrganisasi::create($item);
        }

        /*
        |--------------------------------------------------------------------------
        | KONTAK
        |--------------------------------------------------------------------------
        */

        Kontak::create([
            'judul_id' => 'Hubungi Kami',
            'judul_en' => 'Contact Us',
            'deskripsi_id' => 'Mari terhubung dan berkolaborasi untuk memajukan perfilman Indonesia.',
            'deskripsi_en' => 'Let us connect and collaborate to advance Indonesian cinema.',
            'alamat_id' => 'Gedung Film, Jl. M.T. Haryono Kav. 47-48, Jakarta Selatan 12770',
            'alamat_en' => 'Film Building, Jl. M.T. Haryono Kav. 47-48, South Jakarta 12770',
            'email' => 'info@bpi.or.id',
            'telepon' => '+62 21 798 0900',
            'whatsapp' => '+62 812 0000 0000',
            'media_sosial' => '@bpi.or.id',
            'latitude' => -6.2500000,
            'longitude' => 106.8500000,
            'status' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | MENU
        |--------------------------------------------------------------------------
        */

        $menus = [
            [
                'nama_id' => 'Beranda',
                'nama_en' => 'Home',
                'slug' => 'beranda',
                'url' => '/',
                'urutan' => 1,
                'status' => true,
            ],
            [
                'nama_id' => 'Stakeholders',
                'nama_en' => 'Stakeholders',
                'slug' => 'stakeholders',
                'url' => '/stakeholders',
                'urutan' => 2,
                'status' => true,
            ],
            [
                'nama_id' => 'Program',
                'nama_en' => 'Programs',
                'slug' => 'program',
                'url' => '/program',
                'urutan' => 3,
                'status' => true,
            ],
            [
                'nama_id' => 'Proyek',
                'nama_en' => 'Projects',
                'slug' => 'proyek',
                'url' => '/proyek',
                'urutan' => 4,
                'status' => true,
            ],
            [
                'nama_id' => 'Mitra',
                'nama_en' => 'Partners',
                'slug' => 'mitra',
                'url' => '/mitra',
                'urutan' => 5,
                'status' => true,
            ],
            [
                'nama_id' => 'Berita',
                'nama_en' => 'News',
                'slug' => 'berita',
                'url' => '/berita',
                'urutan' => 6,
                'status' => true,
            ],
            [
                'nama_id' => 'Tentang',
                'nama_en' => 'About',
                'slug' => 'tentang',
                'url' => '/tentang',
                'urutan' => 7,
                'status' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        $footer = [
            [
                'section' => 'tentang',
                'judul_id' => 'Tentang BPI',
                'judul_en' => 'About BPI',
                'deskripsi_id' => 'Badan Perfilman Indonesia. Memajukan Perfilman Indonesia.',
                'deskripsi_en' => 'Indonesian Film Board. Advancing Indonesian Cinema.',
                'link_nama_id' => 'Profil',
                'link_nama_en' => 'Profile',
                'link_url' => '/tentang',
                'icon' => null,
                'urutan' => 1,
                'status' => true,
            ],
            [
                'section' => 'tentang',
                'judul_id' => 'Visi & Misi',
                'judul_en' => 'Vision & Mission',
                'deskripsi_id' => 'Visi dan misi BPI.',
                'deskripsi_en' => 'BPI vision and mission.',
                'link_nama_id' => 'Visi & Misi',
                'link_nama_en' => 'Vision & Mission',
                'link_url' => '/tentang',
                'icon' => null,
                'urutan' => 2,
                'status' => true,
            ],
            [
                'section' => 'tentang',
                'judul_id' => 'Sejarah',
                'judul_en' => 'History',
                'deskripsi_id' => 'Sejarah Badan Perfilman Indonesia.',
                'deskripsi_en' => 'History of the Indonesian Film Board.',
                'link_nama_id' => 'Sejarah',
                'link_nama_en' => 'History',
                'link_url' => '/tentang',
                'icon' => null,
                'urutan' => 3,
                'status' => true,
            ],
            [
                'section' => 'tentang',
                'judul_id' => 'Struktur Organisasi',
                'judul_en' => 'Organizational Structure',
                'deskripsi_id' => 'Struktur organisasi BPI.',
                'deskripsi_en' => 'BPI organizational structure.',
                'link_nama_id' => 'Struktur Organisasi',
                'link_nama_en' => 'Organizational Structure',
                'link_url' => '/tentang',
                'icon' => null,
                'urutan' => 4,
                'status' => true,
            ],
            [
                'section' => 'informasi',
                'judul_id' => 'Informasi',
                'judul_en' => 'Information',
                'deskripsi_id' => 'Informasi dan dokumen BPI.',
                'deskripsi_en' => 'BPI information and documents.',
                'link_nama_id' => 'Rencana Strategis',
                'link_nama_en' => 'Strategic Plan',
                'link_url' => '/program',
                'icon' => null,
                'urutan' => 5,
                'status' => true,
            ],
            [
                'section' => 'informasi',
                'judul_id' => 'Laporan',
                'judul_en' => 'Reports',
                'deskripsi_id' => 'Laporan kegiatan dan perkembangan BPI.',
                'deskripsi_en' => 'BPI activity and development reports.',
                'link_nama_id' => 'Laporan Tahunan',
                'link_nama_en' => 'Annual Report',
                'link_url' => '/berita',
                'icon' => null,
                'urutan' => 6,
                'status' => true,
            ],
            [
                'section' => 'jaringan',
                'judul_id' => 'Jaringan & Kontak',
                'judul_en' => 'Network & Contact',
                'deskripsi_id' => 'Jaringan asosiasi dan informasi kontak BPI.',
                'deskripsi_en' => 'Association network and BPI contact information.',
                'link_nama_id' => 'Direktori Asosiasi',
                'link_nama_en' => 'Association Directory',
                'link_url' => '/stakeholders',
                'icon' => null,
                'urutan' => 7,
                'status' => true,
            ],
            [
                'section' => 'jaringan',
                'judul_id' => 'Hubungi Kami',
                'judul_en' => 'Contact Us',
                'deskripsi_id' => 'Hubungi BPI untuk informasi dan kolaborasi.',
                'deskripsi_en' => 'Contact BPI for information and collaboration.',
                'link_nama_id' => 'Hubungi Kami',
                'link_nama_en' => 'Contact Us',
                'link_url' => '/kontak',
                'icon' => null,
                'urutan' => 8,
                'status' => true,
            ],
        ];

        foreach ($footer as $item) {
            Footer::create($item);
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
        $this->command->info('==========================================');
    }
}
