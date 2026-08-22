<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Stakeholder;

class StakeholderApiController extends BaseApiController
{
    protected $model = Stakeholder::class;

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'stakeholder';

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'icon' => 'nullable|string|max:255',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];
}
