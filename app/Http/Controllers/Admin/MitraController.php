<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = Mitra::orderBy('urutan')->get();
        return view('admin.mitra.index', compact('mitras'));
    }

    public function create()
    {
        return view('admin.mitra.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_id' => 'required|string|max:255',
            'nama_en' => 'required|string|max:255',
            'kategori_id' => 'required|string|max:100',
            'kategori_en' => 'required|string|max:100',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable|string|max:255',
            'alamat_id' => 'nullable|string',
            'alamat_en' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $imageName = time() . '.' . $request->logo->extension();
            $request->logo->storeAs('mitra', $imageName, 'public');
            $data['logo'] = $imageName;
        }

        Mitra::create($data);

        return redirect()->route('admin.mitra.index')
            ->with('success', 'Mitra berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mitra = Mitra::findOrFail($id);
        return view('admin.mitra.edit', compact('mitra'));
    }

    public function update(Request $request, $id)
    {
        $mitra = Mitra::findOrFail($id);

        $request->validate([
            'nama_id' => 'required|string|max:255',
            'nama_en' => 'required|string|max:255',
            'kategori_id' => 'required|string|max:100',
            'kategori_en' => 'required|string|max:100',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable|string|max:255',
            'alamat_id' => 'nullable|string',
            'alamat_en' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            if ($mitra->logo) {
                Storage::disk('public')->delete('mitra/' . $mitra->logo);
            }

            $imageName = time() . '.' . $request->logo->extension();
            $request->logo->storeAs('mitra', $imageName, 'public');
            $data['logo'] = $imageName;
        }

        $mitra->update($data);

        return redirect()->route('admin.mitra.index')
            ->with('success', 'Mitra berhasil diupdate');
    }

    public function destroy($id)
    {
        $mitra = Mitra::findOrFail($id);

        if ($mitra->logo) {
            Storage::disk('public')->delete('mitra/' . $mitra->logo);
        }

        $mitra->delete();

        return redirect()->route('admin.mitra.index')
            ->with('success', 'Mitra berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $mitra = Mitra::findOrFail($id);
        $mitra->status = !$mitra->status;
        $mitra->save();

        return response()->json(['success' => true]);
    }
}
