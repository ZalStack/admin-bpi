<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{
    public function index()
    {
        $footers = Footer::orderBy('urutan')->get();
        return view('admin.footer.index', compact('footers'));
    }

    public function create()
    {
        return view('admin.footer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|string|max:100',
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
            'link_nama_id' => 'nullable|string|max:255',
            'link_nama_en' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        Footer::create($request->all());

        return redirect()->route('admin.footer.index')
            ->with('success', 'Footer berhasil ditambahkan');
    }

    public function edit($id)
    {
        $footer = Footer::findOrFail($id);
        return view('admin.footer.edit', compact('footer'));
    }

    public function update(Request $request, $id)
    {
        $footer = Footer::findOrFail($id);

        $request->validate([
            'section' => 'required|string|max:100',
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
            'link_nama_id' => 'nullable|string|max:255',
            'link_nama_en' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $footer->update($request->all());

        return redirect()->route('admin.footer.index')
            ->with('success', 'Footer berhasil diupdate');
    }

    public function destroy($id)
    {
        $footer = Footer::findOrFail($id);
        $footer->delete();

        return redirect()->route('admin.footer.index')
            ->with('success', 'Footer berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $footer = Footer::findOrFail($id);
        $footer->status = !$footer->status;
        $footer->save();

        return response()->json(['success' => true]);
    }
}
