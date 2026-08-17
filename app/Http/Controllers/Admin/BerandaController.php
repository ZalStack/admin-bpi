<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beranda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerandaController extends Controller
{
    public function index()
    {
        $berandas = Beranda::orderBy('urutan')->get();
        return view('admin.beranda.index', compact('berandas'));
    }

    public function create()
    {
        return view('admin.beranda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|string|max:100',
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('beranda', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        Beranda::create($data);

        return redirect()->route('admin.beranda.index')
            ->with('success', 'Data beranda berhasil ditambahkan');
    }

    public function edit($id)
    {
        $beranda = Beranda::findOrFail($id);
        return view('admin.beranda.edit', compact('beranda'));
    }

    public function update(Request $request, $id)
    {
        $beranda = Beranda::findOrFail($id);

        $request->validate([
            'section' => 'required|string|max:100',
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($beranda->gambar) {
                Storage::disk('public')->delete('beranda/'.$beranda->gambar);
            }

            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('beranda', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        $beranda->update($data);

        return redirect()->route('admin.beranda.index')
            ->with('success', 'Data beranda berhasil diupdate');
    }

    public function destroy($id)
    {
        $beranda = Beranda::findOrFail($id);

        if ($beranda->gambar) {
            Storage::disk('public')->delete('beranda/'.$beranda->gambar);
        }

        $beranda->delete();

        return redirect()->route('admin.beranda.index')
            ->with('success', 'Data beranda berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $beranda = Beranda::findOrFail($id);
        $beranda->status = !$beranda->status;
        $beranda->save();

        return response()->json(['success' => true]);
    }
}
