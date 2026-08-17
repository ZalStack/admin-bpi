<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('urutan')->get();
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_id' => 'required|string|max:100',
            'nama_en' => 'required|string|max:100',
            'url' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_id) . '-' . time();

        Menu::create($data);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil ditambahkan');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'nama_id' => 'required|string|max:100',
            'nama_en' => 'required|string|max:100',
            'url' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
            'status' => 'boolean'
        ]);

        $data = $request->all();

        $menu->update($data);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil diupdate');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->status = !$menu->status;
        $menu->save();

        return response()->json(['success' => true]);
    }
}
