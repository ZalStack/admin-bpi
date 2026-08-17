<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangController extends Controller
{
    public function index()
    {
        $tentangs = Tentang::orderBy('urutan')->get();
        return view('admin.tentang.index', compact('tentangs'));
    }

    public function create()
    {
        return view('admin.tentang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|string|max:100',
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'subjudul_id' => 'nullable|string|max:255',
            'subjudul_en' => 'nullable|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('tentang', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        Tentang::create($data);

        return redirect()->route('admin.tentang.index')
            ->with('success', 'Data tentang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tentang = Tentang::findOrFail($id);
        return view('admin.tentang.edit', compact('tentang'));
    }

    public function update(Request $request, $id)
    {
        $tentang = Tentang::findOrFail($id);

        $request->validate([
            'section' => 'required|string|max:100',
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'subjudul_id' => 'nullable|string|max:255',
            'subjudul_en' => 'nullable|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($tentang->gambar) {
                Storage::disk('public')->delete('tentang/' . $tentang->gambar);
            }

            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('tentang', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        $tentang->update($data);

        return redirect()->route('admin.tentang.index')
            ->with('success', 'Data tentang berhasil diupdate');
    }

    public function destroy($id)
    {
        $tentang = Tentang::findOrFail($id);

        if ($tentang->gambar) {
            Storage::disk('public')->delete('tentang/' . $tentang->gambar);
        }

        $tentang->delete();

        return redirect()->route('admin.tentang.index')
            ->with('success', 'Data tentang berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $tentang = Tentang::findOrFail($id);
        $tentang->status = !$tentang->status;
        $tentang->save();

        return response()->json(['success' => true]);
    }
}
