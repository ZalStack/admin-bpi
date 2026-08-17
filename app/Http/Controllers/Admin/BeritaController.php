<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->get();
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'ringkasan_id' => 'required|string',
            'ringkasan_en' => 'required|string',
            'isi_id' => 'required|string',
            'isi_en' => 'required|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_id' => 'required|string|max:100',
            'kategori_en' => 'required|string|max:100',
            'penulis' => 'required|string|max:255',
            'tanggal_publikasi' => 'required|date',
            'kutipan_id' => 'nullable|string',
            'kutipan_en' => 'nullable|string',
            'status' => 'nullable|string|max:50'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul_id) . '-' . time();

        if ($request->hasFile('gambar_utama')) {
            $imageName = time() . '.' . $request->gambar_utama->extension();
            $request->gambar_utama->storeAs('berita', $imageName, 'public');
            $data['gambar_utama'] = $imageName;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::with('galeri')->findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'ringkasan_id' => 'required|string',
            'ringkasan_en' => 'required|string',
            'isi_id' => 'required|string',
            'isi_en' => 'required|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_id' => 'required|string|max:100',
            'kategori_en' => 'required|string|max:100',
            'penulis' => 'required|string|max:255',
            'tanggal_publikasi' => 'required|date',
            'kutipan_id' => 'nullable|string',
            'kutipan_en' => 'nullable|string',
            'status' => 'nullable|string|max:50'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_utama')) {
            if ($berita->gambar_utama) {
                Storage::disk('public')->delete('berita/' . $berita->gambar_utama);
            }

            $imageName = time() . '.' . $request->gambar_utama->extension();
            $request->gambar_utama->storeAs('berita', $imageName, 'public');
            $data['gambar_utama'] = $imageName;
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diupdate');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar_utama) {
            Storage::disk('public')->delete('berita/' . $berita->gambar_utama);
        }

        foreach ($berita->galeri as $galeri) {
            if ($galeri->gambar) {
                Storage::disk('public')->delete('berita/galeri/' . $galeri->gambar);
            }
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->status = $berita->status == 'published' ? 'draft' : 'published';
        $berita->save();

        return response()->json(['success' => true]);
    }
}
