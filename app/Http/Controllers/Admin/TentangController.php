<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tentang;

class TentangController extends AdminBaseController
{
    protected string $model = Tentang::class;

    protected string $viewPrefix = 'admin.tentang';

    protected string $routeName = 'admin.tentang';

    protected string $label = 'Data tentang';

    protected array $validationRules = [
        'section' => 'required|string|max:100',
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'subjudul' => 'nullable|string|max:255',
        'deskripsi' => 'required|string',
    ];

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'tentang';
}
