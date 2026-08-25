<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\ProgramRoadmap;

class ProgramRoadmapApiController extends BaseApiController
{
    protected $model = ProgramRoadmap::class;

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'tahun' => 'required|string|max:50',
        'icon' => 'nullable|string|max:100',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'items' => 'nullable|array',
    ];
}
