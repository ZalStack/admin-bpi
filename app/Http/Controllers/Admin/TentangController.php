<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tentang;
use App\Models\TentangPoin;
use Illuminate\Http\Request;

class TentangController extends AdminBaseController
{
    protected string $model = Tentang::class;

    protected string $viewPrefix = 'admin.tentang';

    protected string $routeName = 'admin.tentang';

    protected string $label = 'Data tentang';

    protected array $validationRules = [
        'section' => 'required|string|in:intro,visi,misi',
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'subjudul' => 'nullable|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'tentang';

    public function store(Request $request)
    {
        $validated = $request->validate($this->buildValidationRules(false));

        $item = $this->model::create(array_merge(
            $this->neutralData($validated, $request),
            $this->extraData($request, true),
            $this->uploadedImage($request)
        ));

        if ($this->usesTranslations() && $request->has('translations')) {
            $item->storeTranslations((array) $request->input('translations', []));
        }

        // Handle points for visi / misi on creation
        if (in_array($item->section, ['visi', 'misi']) && $request->has('poin')) {
            foreach ($request->input('poin', []) as $poinData) {
                $poin = TentangPoin::create([
                    'tentang_id' => $item->id,
                    'icon' => $poinData['icon'] ?? null,
                    'urutan' => $poinData['urutan'] ?? 0,
                    'status' => !empty($poinData['status']),
                ]);

                if ($poin && !empty($poinData['translations'])) {
                    $poin->storeTranslations($poinData['translations']);
                }
            }
        }

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = $this->model::query()
            ->with(['translations', 'poin' => fn ($q) => $q->orderBy('urutan', 'asc'), 'poin.translations'])
            ->findOrFail($id);

        return view($this->viewPrefix.'.edit', $this->viewData(['item' => $item]));
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

        // Handle points for visi / misi
        if (in_array($item->section, ['visi', 'misi'])) {
            // Delete removed points if any
            if ($request->has('deleted_poin')) {
                $deletedIds = array_filter(explode(',', (string)$request->input('deleted_poin')));
                if (!empty($deletedIds)) {
                    TentangPoin::where('tentang_id', $item->id)->whereIn('id', $deletedIds)->delete();
                }
            }

            // Save / Update points
            if ($request->has('poin')) {
                foreach ($request->input('poin', []) as $poinId => $poinData) {
                    if (str_starts_with((string)$poinId, 'new_')) {
                        $poin = TentangPoin::create([
                            'tentang_id' => $item->id,
                            'icon' => $poinData['icon'] ?? null,
                            'urutan' => $poinData['urutan'] ?? 0,
                            'status' => !empty($poinData['status']),
                        ]);
                    } else {
                        $poin = TentangPoin::where('tentang_id', $item->id)->find($poinId);
                        if ($poin) {
                            $poin->update([
                                'icon' => $poinData['icon'] ?? null,
                                'urutan' => $poinData['urutan'] ?? 0,
                                'status' => !empty($poinData['status']),
                            ]);
                        }
                    }

                    if ($poin && !empty($poinData['translations'])) {
                        $poin->storeTranslations($poinData['translations']);
                    }
                }
            }
        }

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' berhasil diupdate');
    }
}
