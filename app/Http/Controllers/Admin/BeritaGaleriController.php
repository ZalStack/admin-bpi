<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaGaleriController extends Controller
{
    public function index($berita_id)
    {
        $berita = Berita::findOrFail($berita_id);
        $galeris = BeritaGaleri::where('berita_id', $berita_id)->orderBy('urutan')->get();
        return view('admin.berita.galeri.index', compact('berita', 'galeris'));
    }

    public function create($berita_id)
    {
        $berita = Berita::findOrFail($berita_id);
        return view('admin.berita.galeri.create', compact('berita'));
    }

    public function store(Request $request, $berita_id)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'caption_id' => 'nullable|string|max:255',
            'caption_en' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();
        $data['berita_id'] = $berita_id;

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('berita/galeri', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        BeritaGaleri::create($data);

        return redirect()->route('admin.berita.galeri.index', $berita_id)
            ->with('success', 'Galeri berita berhasil ditambahkan');
    }

    public function edit($berita_id, $id)
    {
        $berita = Berita::findOrFail($berita_id);
        $galeri = BeritaGaleri::findOrFail($id);
        return view('admin.berita.galeri.edit', compact('berita', 'galeri'));
    }

    public function update(Request $request, $berita_id, $id)
    {
        $galeri = BeritaGaleri::findOrFail($id);

        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'caption_id' => 'nullable|string|max:255',
            'caption_en' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar) {
                Storage::disk('public')->delete('berita/galeri/' . $galeri->gambar);
            }

            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('berita/galeri', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        $galeri->update($data);

        return redirect()->route('admin.berita.galeri.index', $berita_id)
            ->with('success', 'Galeri berita berhasil diupdate');
    }

    public function destroy($berita_id, $id)
    {
        $galeri = BeritaGaleri::findOrFail($id);

        if ($galeri->gambar) {
            Storage::disk('public')->delete('berita/galeri/' . $galeri->gambar);
        }

        $galeri->delete();

        return redirect()->route('admin.berita.galeri.index', $berita_id)
            ->with('success', 'Galeri berita berhasil dihapus');
    }

    public function toggleStatus($berita_id, $id)
    {
        $galeri = BeritaGaleri::findOrFail($id);
        $galeri->status = !$galeri->status;
        $galeri->save();

        return response()->json(['success' => true]);
    }
}
