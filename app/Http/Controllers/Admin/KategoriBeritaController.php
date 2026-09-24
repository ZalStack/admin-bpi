<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriBeritaController extends AdminBaseController
{
    protected string $model = KategoriBerita::class;

    protected string $viewPrefix = 'admin.kategori-berita';

    protected string $routeName = 'admin.kategori-berita';

    protected string $label = 'News Category';

    protected string $indexOrderColumn = 'id';

    protected string $indexOrderDirection = 'asc';

    protected array $validationRules = [
        'warna' => 'nullable|string|max:50',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255',
    ];

    protected function normalizeWarna(?string $warna): string
    {
        $w = trim((string) $warna);
        if ($w !== '' && !str_starts_with($w, '#')) {
            $w = '#' . $w;
        }
        if ($w === '' || !preg_match('/^#[0-9a-fA-F]{3,8}$/', $w)) {
            return '#68001C';
        }
        return $w;
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->buildValidationRules(false));
        $neutral = $this->neutralData($validated, $request);
        $neutral['warna'] = $this->normalizeWarna($neutral['warna'] ?? null);

        $item = $this->model::create(array_merge(
            $neutral,
            $this->extraData($request, true),
            $this->uploadedImage($request)
        ));

        if ($this->usesTranslations()) {
            $translations = (array) $request->input('translations', []);
            foreach ($translations as $lang => $transData) {
                if (empty($transData['slug']) && ! empty($transData['judul'])) {
                    $translations[$lang]['slug'] = Str::slug($transData['judul']);
                }
            }
            $item->storeTranslations($translations);
        }

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' added successfully');
    }

    public function update(Request $request, $id)
    {
        $item = $this->model::query()->findOrFail($id);

        $validated = $request->validate($this->buildValidationRules(true));
        $neutral = $this->neutralData($validated, $request);
        $neutral['warna'] = $this->normalizeWarna($neutral['warna'] ?? null);

        $item->update(array_merge(
            $neutral,
            $this->extraData($request, false),
            $this->uploadedImage($request, $item)
        ));

        if ($this->usesTranslations() && $request->has('translations')) {
            $translations = (array) $request->input('translations', []);
            foreach ($translations as $lang => $transData) {
                if (empty($transData['slug']) && ! empty($transData['judul'])) {
                    $translations[$lang]['slug'] = Str::slug($transData['judul']);
                }
            }
            $item->storeTranslations($translations);
        }

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' updated successfully');
    }
}
