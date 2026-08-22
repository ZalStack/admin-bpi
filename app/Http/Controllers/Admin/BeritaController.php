<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\Berita;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends AdminBaseController
{
    protected string $model = Berita::class;

    protected string $viewPrefix = 'admin.berita';

    protected string $routeName = 'admin.berita';

    protected string $label = 'Berita';

    protected string $indexOrderColumn = 'created_at';

    protected string $indexOrderDirection = 'desc';

    protected array $validationRules = [
        'penulis' => 'required|string|max:255',
        'tanggal_publikasi' => 'required|date',
        'status' => 'nullable|string|in:draft,published,archived',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'ringkasan' => 'required|string',
        'isi' => 'required|string',
        'kategori' => 'required|string|max:100',
        'kutipan' => 'nullable|string',
    ];

    protected ?string $imageField = 'gambar_utama';

    protected ?string $imagePath = 'berita';

    public function edit($id)
    {
        $item = Berita::with('galeri')->findOrFail($id);

        return view($this->viewPrefix.'.edit', $this->viewData(['item' => $item]));
    }

    public function toggleStatus($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->status = $berita->status === 'published' ? 'draft' : 'published';
        $berita->save();

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
            ->map(fn ($galeri) => 'berita/galeri/'.$galeri->gambar)
            ->all();
    }
}
