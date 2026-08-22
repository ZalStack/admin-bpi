<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Program;

class ProgramApiController extends BaseApiController
{
    protected $model = Program::class;

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'program';

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'icon' => 'nullable|string|max:255',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];
}
