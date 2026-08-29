<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\Program;
use App\Models\ProgramPoin;
use App\Models\ProgramRoadmap;
use Illuminate\Http\Request;

class ProgramController extends AdminBaseController
{
    protected string $model = Program::class;

    protected string $viewPrefix = 'admin.program';

    protected string $routeName = 'admin.program';

    protected string $label = 'Program';

    protected array $validationRules = [
        'icon' => 'nullable|string|max:255',
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
        $items = $this->model::query()
            ->with(['translations', 'poin' => fn ($q) => $q->orderBy('urutan', 'asc'), 'poin.translations'])
            ->orderBy('urutan', 'asc')
            ->get();

        $roadmaps = ProgramRoadmap::query()
            ->with(['translations'])
            ->orderBy('urutan', 'asc')
            ->get();

        return view($this->viewPrefix.'.index', $this->viewData([
            'items' => $items,
            'roadmaps' => $roadmaps,
        ]));
    }

    public function create()
    {
        return view($this->viewPrefix.'.create', $this->viewData());
    }

    public function edit($id)
    {
        $item = $this->model::query()
            ->with(['translations', 'poin' => fn ($q) => $q->orderBy('urutan', 'asc'), 'poin.translations'])
            ->findOrFail($id);

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
            $item->storeTranslations((array) $request->input('translations', []));
        }

        // Save sub-points if any
        if ($request->has('poin')) {
            $this->saveProgramPoints($item, (array) $request->input('poin', []));
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

        // Delete removed points if any
        if ($request->has('deleted_poin')) {
            $deletedIds = array_filter(explode(',', (string) $request->input('deleted_poin')));
            if (!empty($deletedIds)) {
                ProgramPoin::where('program_id', $item->id)->whereIn('id', $deletedIds)->delete();
            }
        }

        // Save / Update points
        if ($request->has('poin')) {
            $this->saveProgramPoints($item, (array) $request->input('poin', []));
        }

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' updated successfully');
    }

    protected function saveProgramPoints(Program $program, array $points): void
    {
        foreach ($points as $poinId => $poinData) {
            if (str_starts_with((string) $poinId, 'new_')) {
                $poin = ProgramPoin::create([
                    'program_id' => $program->id,
                    'icon' => $poinData['icon'] ?? null,
                    'urutan' => $poinData['urutan'] ?? 0,
                    'status' => !empty($poinData['status']),
                ]);
            } else {
                $poin = ProgramPoin::where('program_id', $program->id)->find($poinId);
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
