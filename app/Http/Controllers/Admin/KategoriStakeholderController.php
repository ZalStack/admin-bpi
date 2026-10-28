<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\KategoriStakeholder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriStakeholderController extends AdminBaseController
{
    protected string $model = KategoriStakeholder::class;

    protected string $viewPrefix = 'admin.kategori-stakeholder';

    protected string $routeName = 'admin.kategori-stakeholder';

    protected string $label = 'Stakeholder Category';

    protected array $validationRules = [
        'slug' => 'nullable|string|max:100',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'nama' => 'required|string|max:255',
    ];

    protected function extraData(Request $request, bool $isCreate = false): array
    {
        $slug = $request->input('slug');
        if (empty($slug)) {
            $defaultName = $request->input('translations.' . Bahasa::defaultKode() . '.nama')
                ?? $request->input('translations.id.nama')
                ?? 'kategori';
            $slug = Str::slug($defaultName);
        } else {
            $slug = Str::slug($slug);
        }

        return [
            'slug' => $slug,
        ];
    }
}
