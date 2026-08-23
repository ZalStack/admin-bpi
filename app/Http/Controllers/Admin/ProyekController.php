<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\Proyek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProyekController extends AdminBaseController
{
    protected string $model = Proyek::class;

    protected string $viewPrefix = 'admin.proyek';

    protected string $routeName = 'admin.proyek';

    protected string $label = 'Proyek';

    protected array $validationRules = [
        'tahun' => 'required|string|max:20',
        'status' => 'nullable|string|in:draft,published,archived',
        'urutan' => 'nullable|integer',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'kategori' => 'required|string|max:255',
        'deskripsi_singkat' => 'required|string',
        'deskripsi' => 'required|string',
        'lokasi' => 'required|string|max:255',
        'icon' => 'nullable|string|max:100',
        'ruang_lingkup' => 'nullable|string|max:255',
        'status_proyek' => 'nullable|string|max:100',
        'timeline' => 'required|string',
    ];

    protected ?string $imageField = 'gambar_utama';

    protected ?string $imagePath = 'proyek';

    public function edit($id)
    {
        $item = Proyek::with('galeri')->findOrFail($id);

        return view($this->viewPrefix.'.edit', $this->viewData(['proyek' => $item]));
    }

    public function toggleStatus($id)
    {
        $proyek = Proyek::findOrFail($id);
        $proyek->status = $proyek->status === 'published' ? 'draft' : 'published';
        $proyek->save();

        return response()->json(['success' => true]);
    }

    protected function extraData(Request $request, bool $creating): array
    {
        if (! $creating) {
            return [];
        }

        $defaultKode = Bahasa::defaultKode();

        return ['slug' => Str::slug($request->input("translations.$defaultKode.judul", '')).'-'.time()];
    }

    protected function beforeDelete(Model $item): array
    {
        return $item->galeri
            ->filter(fn ($galeri) => $galeri->gambar !== null)
            ->map(fn ($galeri) => 'proyek/galeri/'.$galeri->gambar)
            ->all();
    }
}
