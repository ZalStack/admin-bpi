<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\ProgramRoadmap;
use Illuminate\Http\Request;

class ProgramRoadmapController extends AdminBaseController
{
    protected string $model = ProgramRoadmap::class;

    protected string $viewPrefix = 'admin.program-roadmap';

    protected string $routeName = 'admin.program-roadmap';

    protected string $label = 'Peta Jalan';

    protected array $validationRules = [
        'tahun' => 'required|string|max:50',
        'icon' => 'nullable|string|max:100',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'program';

    public function index()
    {
        return redirect()->route('admin.program.index');
    }

    public function create()
    {
        return view($this->viewPrefix.'.create', $this->viewData());
    }

    public function edit($id)
    {
        $item = $this->model::query()->with(['translations'])->findOrFail($id);
        return view($this->viewPrefix.'.edit', $this->viewData(['item' => $item]));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->buildValidationRules(false));

        $item = $this->model::create(array_merge(
            $this->neutralData($validated, $request),
            $this->extraData($request, true),
            $this->uploadedImage($request)
        ));

        if ($this->usesTranslations() && $request->has('translations')) {
            $this->saveRoadmapTranslations($item, (array) $request->input('translations', []));
        }

        return redirect()->route('admin.program.index')
            ->with('success', 'Peta Jalan berhasil ditambahkan');
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
            $this->saveRoadmapTranslations($item, (array) $request->input('translations', []));
        }

        return redirect()->route('admin.program.index')
            ->with('success', 'Peta Jalan berhasil diupdate');
    }

    public function destroy($id)
    {
        $item = $this->model::query()->findOrFail($id);
        $item->delete();

        return redirect()->route('admin.program.index')
            ->with('success', 'Peta Jalan berhasil dihapus');
    }

    protected function saveRoadmapTranslations(ProgramRoadmap $roadmap, array $translations): void
    {
        foreach ($translations as $kode => $transData) {
            // Process items from array or textarea lines
            $items = [];
            if (isset($transData['items'])) {
                if (is_array($transData['items'])) {
                    $items = array_values(array_filter(array_map('trim', $transData['items'])));
                } elseif (is_string($transData['items'])) {
                    $items = array_values(array_filter(array_map('trim', explode("\n", $transData['items']))));
                }
            }

            $transData['items'] = $items;
            $roadmap->translations()->updateOrCreate(
                ['bahasa' => $kode],
                $transData
            );
        }
    }
}
