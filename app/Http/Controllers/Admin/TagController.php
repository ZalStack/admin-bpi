<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;

class TagController extends AdminBaseController
{
    protected string $model = Tag::class;

    protected string $viewPrefix = 'admin.tag';

    protected string $routeName = 'admin.tag';

    protected string $label = 'Tag';

    protected array $validationRules = [
        'slug' => 'nullable|string|max:255',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'tag' => 'required|string|max:100',
    ];
}
