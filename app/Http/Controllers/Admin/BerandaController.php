<?php

namespace App\Http\Controllers\Admin;

use App\Models\Beranda;

class BerandaController extends AdminBaseController
{
    protected string $model = Beranda::class;

    protected string $viewPrefix = 'admin.beranda';

    protected string $routeName = 'admin.beranda';

    protected string $label = 'Data beranda';

    protected array $validationRules = [
        'section' => 'required|string|max:100',
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'beranda';
}
