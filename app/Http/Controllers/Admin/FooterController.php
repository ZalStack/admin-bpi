<?php

namespace App\Http\Controllers\Admin;

use App\Models\Footer;

class FooterController extends AdminBaseController
{
    protected string $model = Footer::class;

    protected string $viewPrefix = 'admin.footer';

    protected string $routeName = 'admin.footer';

    protected string $label = 'Footer';

    protected array $validationRules = [
        'section' => 'required|string|max:100',
        'link_url' => 'nullable|string|max:255',
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'link_nama' => 'nullable|string|max:255',
    ];
}
