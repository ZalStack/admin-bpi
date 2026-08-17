<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanBahasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class BahasaController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanBahasa::first();
        return view('admin.bahasa.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'bahasa_default' => 'required|in:id,en',
            'bahasa_tersedia' => 'required|string'
        ]);

        $pengaturan = PengaturanBahasa::first();
        if (!$pengaturan) {
            $pengaturan = new PengaturanBahasa();
        }

        $pengaturan->bahasa_default = $request->bahasa_default;
        $pengaturan->bahasa_tersedia = $request->bahasa_tersedia;
        $pengaturan->status = $request->has('status');
        $pengaturan->save();

        // Set session language
        Session::put('locale', $request->bahasa_default);
        App::setLocale($request->bahasa_default);

        return redirect()->route('admin.bahasa.index')
            ->with('success', 'Pengaturan bahasa berhasil diupdate');
    }

    public function switchLang($locale)
    {
        if (in_array($locale, ['id', 'en'])) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }

        return redirect()->back();
    }
}
