<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $strukturs = StrukturOrganisasi::orderBy('urutan')->get();
        return view('admin.struktur.index', compact('strukturs'));
    }

    public function create()
    {
        return view('admin.struktur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'required|string|max:255',
            'jabatan_en' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:50',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('struktur', $imageName, 'public');
            $data['foto'] = $imageName;
        }

        StrukturOrganisasi::create($data);

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Struktur organisasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);
        return view('admin.struktur.edit', compact('struktur'));
    }

    public function update(Request $request, $id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'required|string|max:255',
            'jabatan_en' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:50',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($struktur->foto) {
                Storage::disk('public')->delete('struktur/' . $struktur->foto);
            }

            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('struktur', $imageName, 'public');
            $data['foto'] = $imageName;
        }

        $struktur->update($data);

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Struktur organisasi berhasil diupdate');
    }

    public function destroy($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);

        if ($struktur->foto) {
            Storage::disk('public')->delete('struktur/' . $struktur->foto);
        }

        $struktur->delete();

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Struktur organisasi berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);
        $struktur->status = !$struktur->status;
        $struktur->save();

        return response()->json(['success' => true]);
    }
}
