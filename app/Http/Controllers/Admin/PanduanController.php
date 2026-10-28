<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\Panduan;
use Illuminate\Http\Request;

/**
 * Guidebook CMS: daftar isi, satu bab, dan versi cetak semua bab.
 * Bab yang tampil disaring sesuai role user (lihat App\Support\Panduan).
 * Bahasa dipilih lewat ?lang=id|en dan diingat di session.
 */
class PanduanController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $bahasa = $this->bahasa($request);
        $babs = Panduan::untuk($user, $bahasa);

        $indeksPencarian = $babs
            ->map(fn (array $bab) => [
                'slug' => $bab['slug'],
                'judul' => $bab['judul'],
                'grup' => $bab['grup'],
                'teks' => Panduan::teksPolos($bab['slug'], $bahasa),
                'url' => route('admin.panduan.show', $bab['slug']),
            ])
            ->values();

        return view('admin.panduan.index', [
            'grups' => $babs->groupBy('grup'),
            'indeksPencarian' => $indeksPencarian,
            'bahasa' => $bahasa,
            't' => Panduan::TEKS[$bahasa],
        ]);
    }

    public function show(Request $request, string $bab)
    {
        $user = $request->user();

        abort_unless(isset(Panduan::BAB[$bab]), 404);
        abort_unless(Panduan::bolehBaca($user, $bab), 403, 'This guide chapter is not available for your role.');

        $bahasa = $this->bahasa($request);
        $babs = Panduan::untuk($user, $bahasa);
        $slugs = $babs->keys()->values();
        $posisi = $slugs->search($bab);

        return view('admin.panduan.show', [
            'bab' => $babs[$bab],
            'konten' => Panduan::render($bab, $user, $bahasa),
            'grups' => $babs->groupBy('grup'),
            'sebelumnya' => $posisi > 0 ? $babs[$slugs[$posisi - 1]] : null,
            'berikutnya' => $posisi < $slugs->count() - 1 ? $babs[$slugs[$posisi + 1]] : null,
            'bahasa' => $bahasa,
            't' => Panduan::TEKS[$bahasa],
        ]);
    }

    /**
     * Semua bab dalam satu halaman, untuk dicetak / disimpan sebagai PDF.
     */
    public function cetak(Request $request)
    {
        $user = $request->user();
        $bahasa = $this->bahasa($request);

        $babs = Panduan::untuk($user, $bahasa)
            ->map(fn (array $bab) => $bab + ['konten' => Panduan::render($bab['slug'], $user, $bahasa)]);

        return view('admin.panduan.cetak', [
            'babs' => $babs,
            'bahasa' => $bahasa,
            't' => Panduan::TEKS[$bahasa],
        ]);
    }

    /**
     * Bahasa guide: dari ?lang (lalu disimpan di session), atau pilihan sebelumnya.
     */
    protected function bahasa(Request $request): string
    {
        if ($request->filled('lang')) {
            $request->session()->put(Panduan::SESSION_KEY, Panduan::bahasaValid($request->query('lang')));
        }

        return Panduan::bahasaValid($request->session()->get(Panduan::SESSION_KEY));
    }
}
