<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannerHalaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = BannerHalaman::orderBy('id', 'desc')->get();
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'halaman' => 'required|string|max:50',
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('banners', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        BannerHalaman::create($data);

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner berhasil ditambahkan');
    }

    public function edit($id)
    {
        $banner = BannerHalaman::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = BannerHalaman::findOrFail($id);

        $request->validate([
            'halaman' => 'required|string|max:50',
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($banner->gambar) {
                Storage::disk('public')->delete('banners/'.$banner->gambar);
            }

            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('banners', $imageName, 'public');
            $data['gambar'] = $imageName;
        }

        $banner->update($data);

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner berhasil diupdate');
    }

    public function destroy($id)
    {
        $banner = BannerHalaman::findOrFail($id);

        if ($banner->gambar) {
            Storage::disk('public')->delete('banners/'.$banner->gambar);
        }

        $banner->delete();

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $banner = BannerHalaman::findOrFail($id);
        $banner->status = !$banner->status;
        $banner->save();

        return response()->json(['success' => true]);
    }
}
