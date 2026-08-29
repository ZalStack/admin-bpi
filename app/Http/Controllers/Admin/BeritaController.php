<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends AdminBaseController
{
    protected string $model = Berita::class;

    protected string $viewPrefix = 'admin.berita';

    protected string $routeName = 'admin.berita';

    protected string $label = 'News';

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

    public function create()
    {
        $tags = Tag::with('translations')->where('status', true)->get();
        $kategoris = KategoriBerita::with('translations')->get();

        return view($this->viewPrefix.'.create', $this->viewData([
            'tags' => $tags,
            'kategoris' => $kategoris,
        ]));
    }

    public function edit($id)
    {
        $item = Berita::with(['galeri', 'tags'])->findOrFail($id);
        $tags = Tag::with('translations')->where('status', true)->get();
        $kategoris = KategoriBerita::with('translations')->get();

        return view($this->viewPrefix.'.edit', $this->viewData([
            'item' => $item,
            'tags' => $tags,
            'kategoris' => $kategoris,
        ]));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->buildValidationRules(false));

        $item = $this->model::create(array_merge(
            $this->neutralData($validated, $request),
            $this->extraData($request, true),
            $this->uploadedImage($request)
        ));

        if ($this->usesTranslations()) {
            $item->storeTranslations((array) $request->input('translations', []));
        }

        if ($request->has('tag_ids')) {
            $item->tags()->sync($request->input('tag_ids', []));
        }

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' added successfully');
    }

    public function update(Request $request, $id)
    {
        $item = $this->model::query()->findOrFail($id);

        $validated = $request->validate($this->buildValidationRules(true));

        $item->update(array_merge(
            $this->neutralData($validated, $request),
            $this->extraData($request, false),
            $this->uploadedImage($request, $item)
        ));

        if ($this->usesTranslations() && $request->has('translations')) {
            $item->storeTranslations((array) $request->input('translations', []));
        }

        $item->tags()->sync($request->input('tag_ids', []));

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' updated successfully');
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
