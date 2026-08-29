<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\MitraIntro;
use Illuminate\Http\Request;

class MitraIntroController extends AdminBaseController
{
    protected string $model = MitraIntro::class;

    protected string $viewPrefix = 'admin.mitra-intro';

    protected string $routeName = 'admin.mitra-intro';

    protected string $label = 'Partner Intro';

    protected array $validationRules = [
        'status' => 'boolean',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'subjudul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'mitra';

    public function index()
    {
        $intro = MitraIntro::firstOrCreate(['id' => 1], [
            'urutan' => 1,
            'status' => 1,
        ]);

        return redirect()->route('admin.mitra-intro.edit', $intro->id);
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

        return redirect()->route($this->routeName.'.edit', $item->id)
            ->with('success', $this->label.' updated successfully');
    }
}
