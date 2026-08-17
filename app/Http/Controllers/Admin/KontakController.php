<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontaks = Kontak::all();
        return view('admin.kontak.index', compact('kontaks'));
    }

    public function create()
    {
        return view('admin.kontak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'alamat_id' => 'nullable|string',
            'alamat_en' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:100',
            'whatsapp' => 'nullable|string|max:100',
            'media_sosial' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'status' => 'boolean'
        ]);

        Kontak::create($request->all());

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Kontak berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kontak = Kontak::findOrFail($id);
        return view('admin.kontak.edit', compact('kontak'));
    }

    public function update(Request $request, $id)
    {
        $kontak = Kontak::findOrFail($id);

        $request->validate([
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'alamat_id' => 'nullable|string',
            'alamat_en' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:100',
            'whatsapp' => 'nullable|string|max:100',
            'media_sosial' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'status' => 'boolean'
        ]);

        $kontak->update($request->all());

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Kontak berhasil diupdate');
    }

    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Kontak berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->status = !$kontak->status;
        $kontak->save();

        return response()->json(['success' => true]);
    }
}
