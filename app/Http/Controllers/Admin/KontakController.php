<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kontak;

class KontakController extends AdminBaseController
{
    protected string $model = Kontak::class;

    protected string $viewPrefix = 'admin.kontak';

    protected string $routeName = 'admin.kontak';

    protected string $label = 'Kontak';

    protected string $indexOrderColumn = 'id';

    protected array $validationRules = [
        'email' => 'nullable|email|max:255',
        'telepon' => 'nullable|string|max:100',
        'whatsapp' => 'nullable|string|max:100',
        'media_sosial' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'alamat' => 'nullable|string',
    ];
}
