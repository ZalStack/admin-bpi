<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\KategoriMitra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriMitraController extends AdminBaseController
{
    protected string $model = KategoriMitra::class;

    protected string $viewPrefix = 'admin.kategori-mitra';

    protected string $routeName = 'admin.kategori-mitra';

    protected string $label = 'Kategori Mitra';

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
