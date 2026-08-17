<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('urutan')->get();
        return view('admin.program.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
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
            $request->gambar->storeAs('program', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        Program::create($data);

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil ditambahkan');
    }

    public function edit($id)
    {
        $program = Program::findOrFail($id);
        return view('admin.program.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $request->validate([
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($program->gambar) {
                Storage::disk('public')->delete('program/' . $program->gambar);
            }

            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('program', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        $program->update($data);

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil diupdate');
    }

    public function destroy($id)
    {
        $program = Program::findOrFail($id);

        if ($program->gambar) {
            Storage::disk('public')->delete('program/' . $program->gambar);
        }

        $program->delete();

        return redirect()->route('admin.program.index')
            ->with('success', 'Program berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $program = Program::findOrFail($id);
        $program->status = !$program->status;
        $program->save();

        return response()->json(['success' => true]);
    }
}
