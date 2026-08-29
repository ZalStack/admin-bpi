<?php

namespace App\Http\Controllers\Admin;

use App\Models\Proyek;
use App\Models\ProyekGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyekGaleriController extends AdminBaseController
{
    protected string $model = ProyekGaleri::class;

    protected string $viewPrefix = 'admin.proyek.galeri';

    protected string $routeName = 'admin.proyek.galeri';

    protected string $label = 'Project Gallery';

    protected array $validationRules = [
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $updateValidationRules = [
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'nullable|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'proyek/galeri';

    public function index($proyek_id = null)
    {
        $proyek = Proyek::findOrFail($proyek_id);
        $items = ProyekGaleri::where('proyek_id', $proyek_id)->orderBy('urutan')->get();

        return view($this->viewPrefix.'.index', $this->viewData(['proyek' => $proyek, 'items' => $items]));
    }

    public function create($proyek_id = null)
    {
        $proyek = Proyek::findOrFail($proyek_id);

        return view($this->viewPrefix.'.create', $this->viewData(['proyek' => $proyek]));
    }

    public function store(Request $request, $proyek_id = null)
    {
        $validated = $request->validate($this->buildValidationRules(false));

        $item = $this->model::create(array_merge(
            ['proyek_id' => $proyek_id],
            $this->neutralData($validated, $request),
            $this->uploadedImage($request)
        ));

        if ($this->usesTranslations()) {
            $item->storeTranslations((array) $request->input('translations', []));
        }

        return redirect()->route($this->routeName.'.index', $proyek_id)
            ->with('success', $this->label.' added successfully');
    }

    public function edit($proyek_id = null, $id = null)
    {
        $proyek = Proyek::findOrFail($proyek_id);
        $item = ProyekGaleri::findOrFail($id);

        return view($this->viewPrefix.'.edit', $this->viewData(['proyek' => $proyek, 'galeri' => $item]));
    }

    public function update(Request $request, $proyek_id = null, $id = null)
    {
        $item = ProyekGaleri::findOrFail($id);

        $validated = $request->validate($this->buildValidationRules(true));

        $item->update(array_merge(
            $this->neutralData($validated, $request),
            $this->uploadedImage($request, $item)
        ));

        if ($this->usesTranslations() && $request->has('translations')) {
            $item->storeTranslations((array) $request->input('translations', []));
        }

        return redirect()->route($this->routeName.'.index', $proyek_id)
            ->with('success', $this->label.' updated successfully');
    }

    public function destroy($proyek_id = null, $id = null)
    {
        $item = ProyekGaleri::findOrFail($id);

        if ($item->gambar) {
            Storage::disk('public')->delete($this->imagePath.'/'.$item->gambar);
        }

        $item->delete();

        return redirect()->route($this->routeName.'.index', $proyek_id)
            ->with('success', $this->label.' deleted successfully');
    }
}
