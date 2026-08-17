<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stakeholder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StakeholderController extends Controller
{
    public function index()
    {
        $stakeholders = Stakeholder::orderBy('urutan')->get();
        return view('admin.stakeholder.index', compact('stakeholders'));
    }

    public function create()
    {
        return view('admin.stakeholder.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_id' => 'required|string|max:255',
            'nama_en' => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('stakeholder', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        Stakeholder::create($data);

        return redirect()->route('admin.stakeholder.index')
            ->with('success', 'Stakeholder berhasil ditambahkan');
    }

    public function edit($id)
    {
        $stakeholder = Stakeholder::findOrFail($id);
        return view('admin.stakeholder.edit', compact('stakeholder'));
    }

    public function update(Request $request, $id)
    {
        $stakeholder = Stakeholder::findOrFail($id);

        $request->validate([
            'nama_id' => 'required|string|max:255',
            'nama_en' => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($stakeholder->gambar) {
                Storage::disk('public')->delete('stakeholder/' . $stakeholder->gambar);
            }

            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('stakeholder', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        $stakeholder->update($data);

        return redirect()->route('admin.stakeholder.index')
            ->with('success', 'Stakeholder berhasil diupdate');
    }

    public function destroy($id)
    {
        $stakeholder = Stakeholder::findOrFail($id);

        if ($stakeholder->gambar) {
            Storage::disk('public')->delete('stakeholder/' . $stakeholder->gambar);
        }

        $stakeholder->delete();

        return redirect()->route('admin.stakeholder.index')
            ->with('success', 'Stakeholder berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $stakeholder = Stakeholder::findOrFail($id);
        $stakeholder->status = !$stakeholder->status;
        $stakeholder->save();

        return response()->json(['success' => true]);
    }
}
