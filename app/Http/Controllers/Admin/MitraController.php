<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mitra;

class MitraController extends AdminBaseController
{
    protected string $model = Mitra::class;

    protected string $viewPrefix = 'admin.mitra';

    protected string $routeName = 'admin.mitra';

    protected string $label = 'Mitra';

    protected array $validationRules = [
        'website' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'nama' => 'required|string|max:255',
        'kategori' => 'required|string|max:100',
        'deskripsi' => 'required|string',
        'alamat' => 'nullable|string',
    ];

    protected ?string $imageField = 'logo';

    protected ?string $imagePath = 'mitra';
}
