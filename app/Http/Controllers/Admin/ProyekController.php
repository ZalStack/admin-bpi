<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proyek;
use App\Models\ProyekGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProyekController extends Controller
{
    public function index()
    {
        $proyeks = Proyek::orderBy('urutan')->get();
        return view('admin.proyek.index', compact('proyeks'));
    }

    public function create()
    {
        return view('admin.proyek.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'kategori_id' => 'required|string|max:255',
            'kategori_en' => 'required|string|max:255',
            'deskripsi_singkat_id' => 'required|string',
            'deskripsi_singkat_en' => 'required|string',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lokasi_id' => 'required|string|max:255',
            'lokasi_en' => 'required|string|max:255',
            'tahun' => 'required|string|max:20',
            'tujuan_id' => 'required|string',
            'tujuan_en' => 'required|string',
            'dampak_id' => 'required|string',
            'dampak_en' => 'required|string',
            'kegiatan_utama_id' => 'required|string',
            'kegiatan_utama_en' => 'required|string',
            'capaian_id' => 'required|string',
            'capaian_en' => 'required|string',
            'timeline_id' => 'required|string',
            'timeline_en' => 'required|string',
            'status' => 'nullable|string|max:50',
            'urutan' => 'nullable|integer'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul_id) . '-' . time();

        if ($request->hasFile('gambar_utama')) {
            $imageName = time() . '.' . $request->gambar_utama->extension();
            $request->gambar_utama->storeAs('proyek', $imageName, 'public');
            $data['gambar_utama'] = $imageName;
        }

        Proyek::create($data);

        return redirect()->route('admin.proyek.index')
            ->with('success', 'Proyek berhasil ditambahkan');
    }

    public function edit($id)
    {
        $proyek = Proyek::with('galeri')->findOrFail($id);
        return view('admin.proyek.edit', compact('proyek'));
    }

    public function update(Request $request, $id)
    {
        $proyek = Proyek::findOrFail($id);

        $request->validate([
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'kategori_id' => 'required|string|max:255',
            'kategori_en' => 'required|string|max:255',
            'deskripsi_singkat_id' => 'required|string',
            'deskripsi_singkat_en' => 'required|string',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lokasi_id' => 'required|string|max:255',
            'lokasi_en' => 'required|string|max:255',
            'tahun' => 'required|string|max:20',
            'tujuan_id' => 'required|string',
            'tujuan_en' => 'required|string',
            'dampak_id' => 'required|string',
            'dampak_en' => 'required|string',
            'kegiatan_utama_id' => 'required|string',
            'kegiatan_utama_en' => 'required|string',
            'capaian_id' => 'required|string',
            'capaian_en' => 'required|string',
            'timeline_id' => 'required|string',
            'timeline_en' => 'required|string',
            'status' => 'nullable|string|max:50',
            'urutan' => 'nullable|integer'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_utama')) {
            if ($proyek->gambar_utama) {
                Storage::disk('public')->delete('proyek/' . $proyek->gambar_utama);
            }

            $imageName = time() . '.' . $request->gambar_utama->extension();
            $request->gambar_utama->storeAs('proyek', $imageName, 'public');
            $data['gambar_utama'] = $imageName;
        }

        $proyek->update($data);

        return redirect()->route('admin.proyek.index')
            ->with('success', 'Proyek berhasil diupdate');
    }

    public function destroy($id)
    {
        $proyek = Proyek::findOrFail($id);

        if ($proyek->gambar_utama) {
            Storage::disk('public')->delete('proyek/' . $proyek->gambar_utama);
        }

        // Delete all gallery images
        foreach ($proyek->galeri as $galeri) {
            if ($galeri->gambar) {
                Storage::disk('public')->delete('proyek/galeri/' . $galeri->gambar);
            }
        }

        $proyek->delete();

        return redirect()->route('admin.proyek.index')
            ->with('success', 'Proyek berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $proyek = Proyek::findOrFail($id);
        $proyek->status = $proyek->status == 'published' ? 'draft' : 'published';
        $proyek->save();

        return response()->json(['success' => true]);
    }
}
