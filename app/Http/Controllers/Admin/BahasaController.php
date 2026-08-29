<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bahasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BahasaController extends Controller
{
    public function index()
    {
        $items = Bahasa::orderByDesc('is_default')->orderBy('nama')->get();

        return view('admin.bahasa.index', [
            'items' => $items,
            'defaultKode' => Bahasa::defaultKode(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:5|alpha_dash|unique:bahasa,kode',
            'nama' => 'required|string|max:100',
            'aktif' => 'boolean',
        ]);

        Bahasa::create($validated + ['is_default' => false]);
        Bahasa::clearCache();

        return redirect()->route('admin.bahasa.index')
            ->with('success', "Language '{$validated['nama']}' added successfully");
    }

    public function update(Request $request, $kode)
    {
        $bahasa = Bahasa::findOrFail($kode);

        if ($bahasa->is_default && ! $request->boolean('aktif')) {
            return redirect()->route('admin.bahasa.index')
                ->with('error', 'Default language cannot be deactivated.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'aktif' => 'boolean',
        ]);

        $bahasa->update($validated);
        Bahasa::clearCache();

        return redirect()->route('admin.bahasa.index')
            ->with('success', 'Language updated successfully');
    }

    public function setDefault($kode)
    {
        $bahasa = Bahasa::findOrFail($kode);

        Bahasa::query()->where('is_default', true)->update(['is_default' => false]);
        $bahasa->update(['is_default' => true, 'aktif' => true]);

        Session::put('locale', $bahasa->kode);
        Bahasa::clearCache();

        return redirect()->route('admin.bahasa.index')
            ->with('success', "'{$bahasa->nama}' is now the default language");
    }

    public function toggleStatus($kode)
    {
        $bahasa = Bahasa::findOrFail($kode);

        if ($bahasa->is_default) {
            return response()->json([
                'success' => false,
                'message' => 'Default language cannot be deactivated.',
            ], 422);
        }

        $bahasa->aktif = ! $bahasa->aktif;
        $bahasa->save();
        Bahasa::clearCache();

        return response()->json(['success' => true]);
    }

    public function destroy($kode)
    {
        $bahasa = Bahasa::findOrFail($kode);

        if ($bahasa->is_default) {
            return redirect()->route('admin.bahasa.index')
                ->with('error', 'Default language cannot be deleted. Please set another language as default first.');
        }

        // Semua translations untuk bahasa ini ikut terhapus via FK cascade.
        $bahasa->delete();
        Bahasa::clearCache();

        return redirect()->route('admin.bahasa.index')
            ->with('success', "Language '{$bahasa->nama}' and all its translations deleted successfully");
    }

    public function switchLang($locale)
    {
        if (Bahasa::query()->where('kode', $locale)->where('aktif', true)->exists()) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
