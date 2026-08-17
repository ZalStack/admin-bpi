<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proyek;
use App\Models\ProyekGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyekGaleriController extends Controller
{
    public function index($proyek_id)
    {
        $proyek = Proyek::findOrFail($proyek_id);
        $galeris = ProyekGaleri::where('proyek_id', $proyek_id)->orderBy('urutan')->get();
        return view('admin.proyek.galeri.index', compact('proyek', 'galeris'));
    }

    public function create($proyek_id)
    {
        $proyek = Proyek::findOrFail($proyek_id);
        return view('admin.proyek.galeri.create', compact('proyek'));
    }

    public function store(Request $request, $proyek_id)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'judul_id' => 'nullable|string|max:255',
            'judul_en' => 'nullable|string|max:255',
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();
        $data['proyek_id'] = $proyek_id;

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('proyek/galeri', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        ProyekGaleri::create($data);

        return redirect()->route('admin.proyek.galeri.index', $proyek_id)
            ->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit($proyek_id, $id)
    {
        $proyek = Proyek::findOrFail($proyek_id);
        $galeri = ProyekGaleri::findOrFail($id);
        return view('admin.proyek.galeri.edit', compact('proyek', 'galeri'));
    }

    public function update(Request $request, $proyek_id, $id)
    {
        $galeri = ProyekGaleri::findOrFail($id);

        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'judul_id' => 'nullable|string|max:255',
            'judul_en' => 'nullable|string|max:255',
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar) {
                Storage::disk('public')->delete('proyek/galeri/' . $galeri->gambar);
            }

            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('proyek/galeri', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        $galeri->update($data);

        return redirect()->route('admin.proyek.galeri.index', $proyek_id)
            ->with('success', 'Galeri berhasil diupdate');
    }

    public function destroy($proyek_id, $id)
    {
        $galeri = ProyekGaleri::findOrFail($id);

        if ($galeri->gambar) {
            Storage::disk('public')->delete('proyek/galeri/' . $galeri->gambar);
        }

        $galeri->delete();

        return redirect()->route('admin.proyek.galeri.index', $proyek_id)
            ->with('success', 'Galeri berhasil dihapus');
    }

    public function toggleStatus($proyek_id, $id)
    {
        $galeri = ProyekGaleri::findOrFail($id);
        $galeri->status = !$galeri->status;
        $galeri->save();

        return response()->json(['success' => true]);
    }
}
