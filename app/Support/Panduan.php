<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;

/**
 * Guidebook (panduan) CMS untuk Admin & Editor, dalam dua bahasa.
 *
 * Isi tiap bab ditulis sebagai Markdown di resources/panduan/{bahasa}/{slug}.md.
 * Daftar bab, urutan, judul per bahasa, dan siapa yang boleh membacanya diatur di BAB.
 *
 * Tautan khusus di dalam Markdown:
 * - [teks](bab:slug#anchor)  -> tautan ke bab lain (jadi teks biasa jika
 *                               pembaca tidak punya akses ke bab itu)
 * - [teks](cms:nama.route)   -> tautan ke halaman CMS
 */
class Panduan
{
    /** Bahasa guide => label pada toggle. */
    public const BAHASA = ['id' => 'ID', 'en' => 'EN'];

    public const BAHASA_DEFAULT = 'id';

    /** Pilihan bahasa guide disimpan di session agar tetap saat pindah bab. */
    public const SESSION_KEY = 'panduan_bahasa';

    /** Role yang boleh membaca bab, dari yang paling luas. */
    public const SEMUA = ['super_admin', 'admin', 'editor'];

    public const ADMIN = ['super_admin', 'admin'];

    public const SUPER_ADMIN = ['super_admin'];

    public const GRUP = [
        'mulai' => ['id' => 'Memulai', 'en' => 'Getting Started'],
        'konten' => ['id' => 'Content Manager', 'en' => 'Content Manager'],
        'tools' => ['id' => 'Tools', 'en' => 'Tools'],
        'akun' => ['id' => 'Akun & Sistem', 'en' => 'Account & System'],
        'bantuan' => ['id' => 'Bantuan', 'en' => 'Help'],
    ];

    /**
     * Urutan grup & bab mengikuti urutan menu di sidebar CMS.
     * 'routes' = pola nama route halaman CMS yang dijelaskan bab ini
     * (dipakai tombol bantuan di setiap halaman).
     */
    public const BAB = [
        'mulai' => [
            'judul' => ['id' => 'Mengenal CMS & Cara Masuk', 'en' => 'Getting to Know the CMS'],
            'ringkasan' => [
                'id' => 'Apa itu CMS, cara login, tampilan Dashboard, dan pembagian hak akses.',
                'en' => 'What the CMS is, how to log in, the Dashboard, and who can access what.',
            ],
            'grup' => 'mulai',
            'roles' => self::SEMUA,
            'routes' => ['dashboard'],
        ],
        'dasar' => [
            'judul' => ['id' => 'Konsep Dasar (Wajib Dibaca)', 'en' => 'Basics (Read This First)'],
            'ringkasan' => [
                'id' => 'Dua bahasa, status tampil, urutan, upload gambar, ikon, dan editor teks.',
                'en' => 'Two languages, visibility status, ordering, image uploads, icons, and the text editor.',
            ],
            'grup' => 'mulai',
            'roles' => self::SEMUA,
            'routes' => [],
        ],
        'cepat' => [
            'judul' => ['id' => 'Panduan Cepat: "Saya Ingin…"', 'en' => 'Quick Guide: "I Want To…"'],
            'ringkasan' => [
                'id' => 'Daftar tugas yang paling sering dilakukan dan di menu mana mengerjakannya.',
                'en' => 'The most common tasks and which menu to use for each.',
            ],
            'grup' => 'mulai',
            'roles' => self::ADMIN,
            'routes' => [],
        ],
        'teks-halaman' => [
            'judul' => ['id' => 'Teks Halaman (Page Texts)', 'en' => 'Page Texts'],
            'ringkasan' => [
                'id' => 'Mengubah judul, label, dan tombol bawaan di setiap halaman website.',
                'en' => 'Changing the built-in titles, labels, and buttons on each website page.',
            ],
            'grup' => 'mulai',
            'roles' => self::ADMIN,
            'routes' => [],
        ],
        'banner' => [
            'judul' => ['id' => 'Banner', 'en' => 'Banner'],
            'ringkasan' => [
                'id' => 'Gambar besar beserta judul di bagian paling atas setiap halaman.',
                'en' => 'The large image and title at the very top of each page.',
            ],
            'grup' => 'konten',
            'roles' => self::ADMIN,
            'routes' => ['admin.banner.*'],
        ],
        'beranda' => [
            'judul' => ['id' => 'Homepage (Beranda)', 'en' => 'Homepage'],
            'ringkasan' => [
                'id' => 'Mengatur bagian apa saja yang tampil di halaman depan dan urutannya.',
                'en' => 'Choosing which sections appear on the homepage and in what order.',
            ],
            'grup' => 'konten',
            'roles' => self::ADMIN,
            'routes' => ['admin.beranda.*'],
        ],
        'tentang' => [
            'judul' => ['id' => 'About (Tentang Kami, Visi & Misi)', 'en' => 'About (Profile, Vision & Mission)'],
            'ringkasan' => [
                'id' => 'Profil singkat BPI, teks visi, serta kartu-kartu misi.',
                'en' => 'The BPI profile, the vision statement, and the mission cards.',
            ],
            'grup' => 'konten',
            'roles' => self::ADMIN,
            'routes' => ['admin.tentang.*', 'admin.tentang-poin.*'],
        ],
        'mitra' => [
            'judul' => ['id' => 'Partners (Mitra)', 'en' => 'Partners'],
            'ringkasan' => [
                'id' => 'Daftar mitra beserta logo, kategori mitra, dan teks pembuka bagian mitra.',
                'en' => 'Partner logos, partner categories, and the intro text of the partners section.',
            ],
            'grup' => 'konten',
            'roles' => self::ADMIN,
            'routes' => ['admin.mitra.*', 'admin.kategori-mitra.*', 'admin.mitra-intro.*'],
        ],
        'stakeholder' => [
            'judul' => ['id' => 'Stakeholder (Asosiasi)', 'en' => 'Stakeholders (Associations)'],
            'ringkasan' => [
                'id' => 'Daftar asosiasi profesi/pemangku kepentingan di halaman Stakeholders.',
                'en' => 'Professional associations and stakeholders listed on the Stakeholders page.',
            ],
            'grup' => 'konten',
            'roles' => self::ADMIN,
            'routes' => ['admin.stakeholder.*'],
        ],
        'program' => [
            'judul' => ['id' => 'Programs & Roadmap', 'en' => 'Programs & Roadmap'],
            'ringkasan' => [
                'id' => 'Pilar program strategis beserta sub-poinnya, dan peta jalan per tahun.',
                'en' => 'Strategic program pillars with their sub-points, and the yearly roadmap.',
            ],
            'grup' => 'konten',
            'roles' => self::ADMIN,
            'routes' => ['admin.program.*', 'admin.program-roadmap.*', 'admin.program-poin.*'],
        ],
        'proyek' => [
            'judul' => ['id' => 'Projects (Proyek Kolaborasi)', 'en' => 'Projects'],
            'ringkasan' => [
                'id' => 'Proyek lengkap dengan tujuan, capaian, kegiatan, linimasa, mitra, dan galeri foto.',
                'en' => 'Projects with objectives, achievements, activities, timeline, partners, and a photo gallery.',
            ],
            'grup' => 'konten',
            'roles' => self::ADMIN,
            'routes' => ['admin.proyek.*'],
        ],
        'berita' => [
            'judul' => ['id' => 'News (Berita)', 'en' => 'News'],
            'ringkasan' => [
                'id' => 'Menulis dan menerbitkan berita, mengatur kategori, tag, dan galeri foto berita.',
                'en' => 'Writing and publishing news, and managing categories, tags, and news galleries.',
            ],
            'grup' => 'konten',
            'roles' => self::SEMUA,
            'routes' => ['admin.berita.*', 'admin.kategori-berita.*', 'admin.tag.*'],
        ],
        'struktur' => [
            'judul' => ['id' => 'Org. Structure (Struktur Organisasi)', 'en' => 'Org. Structure'],
            'ringkasan' => [
                'id' => 'Anggota pengurus BPI, foto, jabatan, dan tata letak bagan organisasi.',
                'en' => 'BPI board members, their photos and positions, and the org chart layout.',
            ],
            'grup' => 'konten',
            'roles' => self::ADMIN,
            'routes' => ['admin.struktur.*'],
        ],
        'kontak' => [
            'judul' => ['id' => 'Contact (Kontak)', 'en' => 'Contact'],
            'ringkasan' => [
                'id' => 'Alamat, peta Google Maps, media sosial, email, dan nomor WhatsApp BPI.',
                'en' => 'The BPI address, Google Maps location, social media, email, and WhatsApp number.',
            ],
            'grup' => 'konten',
            'roles' => self::ADMIN,
            'routes' => ['admin.kontak.*'],
        ],
        'pesan-kontak' => [
            'judul' => ['id' => 'Contact Messages (Pesan Masuk)', 'en' => 'Contact Messages'],
            'ringkasan' => [
                'id' => 'Membaca, menandai, dan membalas pesan dari formulir kontak website.',
                'en' => 'Reading, marking, and replying to messages from the website contact form.',
            ],
            'grup' => 'konten',
            'roles' => self::ADMIN,
            'routes' => ['admin.kontak-form.*'],
        ],
        'menu' => [
            'judul' => ['id' => 'Menu Navigasi', 'en' => 'Navigation Menu'],
            'ringkasan' => [
                'id' => 'Menu di bagian atas website: nama, tujuan tautan, dan urutannya.',
                'en' => 'The menu at the top of the website: names, link targets, and order.',
            ],
            'grup' => 'konten',
            'roles' => self::ADMIN,
            'routes' => ['admin.menu.*'],
        ],
        'footer-legal' => [
            'judul' => ['id' => 'Footer & Legal', 'en' => 'Footer & Legal'],
            'ringkasan' => [
                'id' => 'Teks di bagian paling bawah website, Kebijakan Privasi, serta Syarat & Ketentuan.',
                'en' => 'The website footer texts, the Privacy Policy, and the Terms & Conditions.',
            ],
            'grup' => 'konten',
            'roles' => self::ADMIN,
            'routes' => ['admin.footer.*'],
        ],
        'bahasa' => [
            'judul' => ['id' => 'Language Settings (Bahasa)', 'en' => 'Language Settings'],
            'ringkasan' => [
                'id' => 'Bahasa yang tersedia di website dan bahasa utama (default).',
                'en' => 'The languages available on the website and the main (default) language.',
            ],
            'grup' => 'konten',
            'roles' => self::ADMIN,
            'routes' => ['admin.bahasa.*'],
        ],
        'shortlink' => [
            'judul' => ['id' => 'Shortlink (Tautan Pendek)', 'en' => 'Shortlink'],
            'ringkasan' => [
                'id' => 'Membuat tautan pendek yang mudah dibagikan dan menghitung jumlah klik.',
                'en' => 'Creating short, shareable links and counting their clicks.',
            ],
            'grup' => 'tools',
            'roles' => self::ADMIN,
            'routes' => ['admin.shortlink.*'],
        ],
        'qrcode' => [
            'judul' => ['id' => 'QR Code', 'en' => 'QR Code'],
            'ringkasan' => [
                'id' => 'Membuat QR Code berlogo BPI yang siap cetak.',
                'en' => 'Creating print-ready QR codes with the BPI logo.',
            ],
            'grup' => 'tools',
            'roles' => self::ADMIN,
            'routes' => ['admin.qrcode.*'],
        ],
        'role' => [
            'judul' => ['id' => 'Role Management (Kelola Akun)', 'en' => 'Role Management'],
            'ringkasan' => [
                'id' => 'Menambah akun Admin/Editor, mengganti role, dan mereset password.',
                'en' => 'Adding Admin/Editor accounts, changing roles, and resetting passwords.',
            ],
            'grup' => 'akun',
            'roles' => self::SUPER_ADMIN,
            'routes' => ['admin.role-management.*'],
        ],
        'akun' => [
            'judul' => ['id' => 'Profil & Keamanan Akun', 'en' => 'Profile & Account Security'],
            'ringkasan' => [
                'id' => 'Mengubah nama, email, password, dan kebiasaan aman menggunakan CMS.',
                'en' => 'Changing your name, email, and password, and using the CMS safely.',
            ],
            'grup' => 'akun',
            'roles' => self::SEMUA,
            'routes' => ['profile.*'],
        ],
        'faq' => [
            'judul' => ['id' => 'Tanya Jawab & Mengatasi Masalah', 'en' => 'FAQ & Troubleshooting'],
            'ringkasan' => [
                'id' => 'Solusi untuk masalah yang paling sering ditemui saat memakai CMS.',
                'en' => 'Solutions to the most common problems when using the CMS.',
            ],
            'grup' => 'bantuan',
            'roles' => self::SEMUA,
            'routes' => [],
        ],
        'istilah' => [
            'judul' => ['id' => 'Daftar Istilah', 'en' => 'Glossary'],
            'ringkasan' => [
                'id' => 'Arti istilah teknis dan tombol berbahasa Inggris yang ada di CMS.',
                'en' => 'Technical terms and the Indonesian words you will see in the CMS and on the website.',
            ],
            'grup' => 'bantuan',
            'roles' => self::SEMUA,
            'routes' => [],
        ],
    ];

    /** Teks antarmuka halaman Guide per bahasa. */
    public const TEKS = [
        'id' => [
            'judul_index' => 'Panduan Penggunaan CMS',
            'subjudul_index' => 'Buku panduan mengelola isi website Badan Perfilman Indonesia, ditulis dengan bahasa sederhana.',
            'cetak_pdf' => 'Cetak / Simpan PDF',
            'cari_label' => 'Cari di panduan',
            'cari_placeholder' => 'Contoh: ganti logo mitra, terbitkan berita, password, gambar tidak muncul',
            'hasil' => 'bab ditemukan',
            'tidak_ada' => 'Tidak ada hasil. Coba kata lain yang lebih sederhana.',
            'daftar_isi' => 'Daftar Isi',
            'cetak_bab' => 'Cetak Bab Ini',
            'pilih_bab' => 'Pilih bab lain',
            'sebelumnya' => 'Sebelumnya',
            'berikutnya' => 'Berikutnya',
            'di_bab_ini' => 'Di bab ini',
            'bab' => 'Bab',
            'sampul_subjudul' => 'Admin Panel Website Badan Perfilman Indonesia',
            'dicetak_oleh' => 'Dicetak oleh',
            'tautan_bagian' => 'Tautan ke bagian ini',
            'perbesar' => 'Klik untuk memperbesar',
            'bahasa_panduan' => 'Bahasa panduan',
        ],
        'en' => [
            'judul_index' => 'CMS User Guide',
            'subjudul_index' => 'A plain-language guide to managing the Badan Perfilman Indonesia website content.',
            'cetak_pdf' => 'Print / Save as PDF',
            'cari_label' => 'Search the guide',
            'cari_placeholder' => 'Example: change partner logo, publish news, password, image not showing',
            'hasil' => 'chapters found',
            'tidak_ada' => 'No results. Try a different, simpler word.',
            'daftar_isi' => 'Contents',
            'cetak_bab' => 'Print This Chapter',
            'pilih_bab' => 'Choose another chapter',
            'sebelumnya' => 'Previous',
            'berikutnya' => 'Next',
            'di_bab_ini' => 'In this chapter',
            'bab' => 'Chapter',
            'sampul_subjudul' => 'Badan Perfilman Indonesia Website Admin Panel',
            'dicetak_oleh' => 'Printed by',
            'tautan_bagian' => 'Link to this section',
            'perbesar' => 'Click to enlarge',
            'bahasa_panduan' => 'Guide language',
        ],
    ];

    /** Label kotak berwarna (blockquote) => class CSS, untuk semua bahasa. */
    protected const CALLOUT = [
        'Perhatian' => 'callout-danger',
        'Warning' => 'callout-danger',
        'Penting' => 'callout-warning',
        'Important' => 'callout-warning',
        'Tips' => 'callout-tip',
        'Tip' => 'callout-tip',
        'Catatan' => 'callout-info',
        'Note' => 'callout-info',
    ];

    public static function bahasaValid(?string $bahasa): string
    {
        return isset(self::BAHASA[$bahasa]) ? $bahasa : self::BAHASA_DEFAULT;
    }

    /**
     * Semua bab yang boleh dibaca user, dalam urutan BAB, dengan judul,
     * ringkasan, dan nama grup dalam bahasa yang dipilih.
     *
     * @return Collection<string, array>
     */
    public static function untuk(?User $user, string $bahasa = self::BAHASA_DEFAULT): Collection
    {
        return collect(self::BAB)
            ->filter(fn (array $bab, string $slug) => self::bolehBaca($user, $slug))
            ->map(fn (array $bab, string $slug) => [
                'slug' => $slug,
                'judul' => $bab['judul'][$bahasa],
                'ringkasan' => $bab['ringkasan'][$bahasa],
                'grup' => self::GRUP[$bab['grup']][$bahasa],
            ]);
    }

    public static function bolehBaca(?User $user, string $slug): bool
    {
        return $user !== null
            && isset(self::BAB[$slug])
            && $user->hasAnyRole(self::BAB[$slug]['roles']);
    }

    /**
     * Bab yang menjelaskan halaman CMS dengan nama route ini (untuk tombol bantuan).
     */
    public static function babUntukRoute(?string $routeName, ?User $user): ?string
    {
        if (! $routeName) {
            return null;
        }

        foreach (self::BAB as $slug => $bab) {
            if (Str::is($bab['routes'], $routeName) && self::bolehBaca($user, $slug)) {
                return $slug;
            }
        }

        return null;
    }

    public static function path(string $slug, string $bahasa = self::BAHASA_DEFAULT): string
    {
        return resource_path('panduan/'.$bahasa.'/'.$slug.'.md');
    }

    /**
     * Render satu bab ke HTML. Heading mendapat id agar bisa ditaut langsung.
     *
     * @return array{html: string, toc: array<int, array{id: string, judul: string}>}
     */
    public static function render(string $slug, ?User $user, string $bahasa = self::BAHASA_DEFAULT): array
    {
        $markdown = file_get_contents(self::path($slug, $bahasa));

        $html = Str::markdown($markdown, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
            'heading_permalink' => [
                'html_class' => 'heading-anchor',
                'id_prefix' => '',
                'fragment_prefix' => '',
                'apply_id_to_heading' => true,
                'insert' => 'after',
                'symbol' => '#',
                'title' => self::TEKS[$bahasa]['tautan_bagian'],
                'aria_hidden' => true,
            ],
        ], [new HeadingPermalinkExtension]);

        $html = self::resolveLinks($html, $user);
        $html = self::callouts($html);
        $html = self::figures($html, $bahasa);

        return ['html' => $html, 'toc' => self::toc($html)];
    }

    /**
     * Teks polos bab (untuk pencarian di halaman daftar isi).
     */
    public static function teksPolos(string $slug, string $bahasa = self::BAHASA_DEFAULT): string
    {
        $markdown = file_get_contents(self::path($slug, $bahasa));

        return Str::of(strip_tags(Str::markdown($markdown, ['html_input' => 'strip'])))
            ->replaceMatches('/\s+/', ' ')
            ->trim()
            ->toString();
    }

    /**
     * Ubah tautan bab:slug dan cms:route menjadi URL sebenarnya.
     */
    protected static function resolveLinks(string $html, ?User $user): string
    {
        return preg_replace_callback(
            '#<a href="(bab|cms):([^"\#]+)(\#[^"]*)?"([^>]*)>(.*?)</a>#s',
            function (array $m) use ($user) {
                [, $jenis, $target, $anchor, $attrs, $teks] = $m + [3 => '', 4 => ''];

                if ($jenis === 'bab') {
                    return self::bolehBaca($user, $target)
                        ? '<a href="'.e(route('admin.panduan.show', $target)).$anchor.'"'.$attrs.'>'.$teks.'</a>'
                        : '<span>'.$teks.'</span>';
                }

                if (! Route::has($target)) {
                    return '<span>'.$teks.'</span>';
                }

                return '<a href="'.e(route($target)).'" class="cms-link" target="_blank" rel="noopener"'.$attrs.'>'.$teks.'</a>';
            },
            $html
        );
    }

    /**
     * Blockquote yang diawali label di CALLOUT (cth. "**Perhatian:**" atau
     * "**Warning:**") ditampilkan sebagai kotak berwarna.
     */
    protected static function callouts(string $html): string
    {
        return preg_replace_callback(
            '#<blockquote>(\s*<p><strong>('.implode('|', array_keys(self::CALLOUT)).')\b)#',
            fn (array $m) => '<blockquote class="callout '.self::CALLOUT[$m[2]].'">'.$m[1],
            $html
        );
    }

    /**
     * Gambar yang berdiri sendiri dalam satu paragraf menjadi <figure>:
     * alt text tampil sebagai keterangan, dan gambar bisa diklik untuk
     * dibuka ukuran penuh (screenshot lebar sulit dibaca di kolom isi).
     */
    protected static function figures(string $html, string $bahasa): string
    {
        $judul = self::TEKS[$bahasa]['perbesar'];

        return preg_replace_callback(
            '#<p><img src="([^"]+)" alt="([^"]*)"\s*/?></p>#',
            fn (array $m) => '<figure class="guide-figure">'
                .'<a href="'.$m[1].'" target="_blank" rel="noopener" title="'.$judul.'">'
                .'<img src="'.$m[1].'" alt="'.$m[2].'" loading="lazy"></a>'
                .($m[2] !== '' ? '<figcaption>'.$m[2].'</figcaption>' : '')
                .'</figure>',
            $html
        );
    }

    /**
     * Daftar isi dari heading level 2.
     */
    protected static function toc(string $html): array
    {
        preg_match_all('#<h2 id="([^"]+)">(.*?)</h2>#s', $html, $matches, PREG_SET_ORDER);

        return array_map(fn (array $m) => [
            'id' => $m[1],
            'judul' => trim(html_entity_decode(strip_tags(preg_replace('#<a[^>]*heading-anchor[^>]*>.*?</a>#s', '', $m[2])))),
        ], $matches);
    }
}
