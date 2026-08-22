<?php

namespace App\Http\Controllers\Admin;

use App\Models\Program;

class ProgramController extends AdminBaseController
{
    protected string $model = Program::class;

    protected string $viewPrefix = 'admin.program';

    protected string $routeName = 'admin.program';

    protected string $label = 'Program';

    protected array $validationRules = [
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'program';
}
