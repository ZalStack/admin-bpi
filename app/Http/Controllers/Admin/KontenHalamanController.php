<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bahasa;
use App\Models\KontenHalaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Form edit teks statis per halaman frontend (tabel konten_halaman).
 * Tidak punya menu sendiri: setiap halaman dipasang di menu modul terkait
 * lewat route dengan default parameter 'halaman' (lihat routes/web.php).
 */
class KontenHalamanController extends Controller
{
    /**
     * Pengaturan tampilan form per halaman.
     */
    private const PAGES = [
        'tentang' => [
            'title' => 'Structure Section Texts',
            'subtitle' => 'Edit the titles, subtitles, and labels shown in the Organizational Structure section of the About page.',
            'parent_label' => 'Organizational Structure',
            'parent_route' => 'admin.struktur.index',
            'update_route' => 'admin.struktur.texts.update',
            'update_url' => '/admin/struktur-texts',
        ],
        'proyek' => [
            'title' => 'Projects Page Texts',
            'subtitle' => 'Edit the section titles, descriptions, and labels shown on the Projects page and the section titles of each project detail page.',
            'parent_label' => 'Projects',
            'parent_route' => 'admin.proyek.index',
            'update_route' => 'admin.proyek.texts.update',
            'update_url' => '/admin/proyek-texts',
        ],
        'stakeholder' => [
            'title' => 'Stakeholders Page Texts',
            'subtitle' => 'Edit the labels, section titles, and call-to-action texts on the Stakeholders page. The Partners section header is managed in Partners → Partner Page Intro.',
            'parent_label' => 'Stakeholders',
            'parent_route' => 'admin.stakeholder.index',
            'update_route' => 'admin.stakeholder.texts.update',
            'update_url' => '/admin/stakeholder-texts',
        ],
        'beranda' => [
            'title' => 'Homepage Texts',
            'subtitle' => 'Edit the section titles, badges, and buttons on the homepage. Section order and visibility are managed in the Homepage list; banner texts in Banner; the About Us texts in About.',
            'parent_label' => 'Homepage',
            'parent_route' => 'admin.beranda.index',
            'update_route' => 'admin.beranda.texts.update',
            'update_url' => '/admin/beranda-texts',
        ],
        'kontak' => [
            'title' => 'Contact Page Texts',
            'subtitle' => 'Edit the card labels, buttons, and contact form texts on the Contact page. Headers, descriptions, address, and contact details are managed in the Contact data form.',
            'parent_label' => 'Contact',
            'parent_route' => 'admin.kontak.index',
            'update_route' => 'admin.kontak.texts.update',
            'update_url' => '/admin/kontak-texts',
        ],
        'footer' => [
            'title' => 'Footer Texts',
            'subtitle' => 'Edit the tagline, column titles, link labels, and copyright text in the website footer. Address, email, and social links come from Contact.',
            'parent_label' => 'Footer & Legal',
            'parent_route' => 'admin.footer.texts',
            'update_route' => 'admin.footer.texts.update',
            'update_url' => '/admin/footer-texts',
            'links' => self::LEGAL_LINKS,
        ],
        'privasi' => [
            'title' => 'Privacy Policy Page',
            'subtitle' => 'Edit the header and full content of the Privacy Policy page.',
            'parent_label' => 'Footer & Legal',
            'parent_route' => 'admin.footer.texts',
            'update_route' => 'admin.footer.privacy.update',
            'update_url' => '/admin/privacy-policy-texts',
            'links' => self::LEGAL_LINKS,
        ],
        'syarat' => [
            'title' => 'Terms & Conditions Page',
            'subtitle' => 'Edit the header and full content of the Terms & Conditions page.',
            'parent_label' => 'Footer & Legal',
            'parent_route' => 'admin.footer.texts',
            'update_route' => 'admin.footer.terms.update',
            'update_url' => '/admin/terms-texts',
            'links' => self::LEGAL_LINKS,
        ],
    ];

    /**
     * Pages edited from the "Footer & Legal" menu, shown as tabs in the header.
     */
    private const LEGAL_LINKS = [
        ['label' => 'Footer', 'route' => 'admin.footer.texts', 'url' => '/admin/footer-texts'],
        ['label' => 'Privacy Policy', 'route' => 'admin.footer.privacy', 'url' => '/admin/privacy-policy-texts'],
        ['label' => 'Terms & Conditions', 'route' => 'admin.footer.terms', 'url' => '/admin/terms-texts'],
    ];

    public function edit(string $halaman)
    {
        $page = $this->page($halaman);

        $groups = KontenHalaman::query()
            ->with('translations')
            ->where('halaman', $halaman)
            ->orderBy('urutan')
            ->get()
            ->groupBy('grup');

        return view('admin.konten-halaman.edit', [
            'page' => $page,
            'groups' => $groups,
            'bahasas' => Bahasa::activeLanguages(),
        ]);
    }

    public function update(Request $request, string $halaman)
    {
        $this->page($halaman);

        $request->validate([
            'konten' => 'nullable|array',
            'konten.*' => 'array',
            // Rich text (e.g. legal pages) can be long; the column is TEXT (64 KB).
            'konten.*.*' => 'nullable|string|max:60000',
        ]);

        $input = (array) $request->input('konten', []);
        $kodes = Bahasa::activeKodes()->all();

        DB::transaction(function () use ($halaman, $input, $kodes) {
            $items = KontenHalaman::query()->where('halaman', $halaman)->get();

            foreach ($items as $item) {
                $values = (array) ($input[$item->id] ?? []);
                $translations = [];

                foreach ($kodes as $kode) {
                    if (array_key_exists($kode, $values)) {
                        $value = trim((string) $values[$kode]);
                        $translations[$kode] = ['nilai' => $value === '' ? null : $value];
                    }
                }

                $item->storeTranslations($translations);
            }
        });

        return back()->with('success', 'Texts saved successfully');
    }

    private function page(string $halaman): array
    {
        abort_unless(isset(self::PAGES[$halaman]), 404);

        return self::PAGES[$halaman];
    }
}
