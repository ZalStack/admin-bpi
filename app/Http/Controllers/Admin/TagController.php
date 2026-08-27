<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;

class TagController extends AdminBaseController
{
    protected string $model = Tag::class;

    protected string $viewPrefix = 'admin.tag';

    protected string $routeName = 'admin.tag';

    protected string $label = 'Tag';

    protected string $indexOrderColumn = 'id';

    protected string $indexOrderDirection = 'asc';

    protected array $validationRules = [
        'slug' => 'nullable|string|max:255',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'tag' => 'required|string|max:100',
    ];

    protected function extraData(\Illuminate\Http\Request $request, bool $creating): array
    {
        if ($request->filled('slug')) {
            return ['slug' => \Illuminate\Support\Str::slug($request->input('slug'))];
        }

        $defaultKode = \App\Models\Bahasa::defaultKode();
        $namaTag = $request->input("translations.{$defaultKode}.tag")
            ?? $request->input("translations.id.tag")
            ?? (collect((array) $request->input('translations', []))->first()['tag'] ?? '');

        if (! empty($namaTag)) {
            return ['slug' => \Illuminate\Support\Str::slug($namaTag)];
        }

        return [];
    }
}
