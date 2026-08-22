<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stakeholder;

class StakeholderController extends AdminBaseController
{
    protected string $model = Stakeholder::class;

    protected string $viewPrefix = 'admin.stakeholder';

    protected string $routeName = 'admin.stakeholder';

    protected string $label = 'Stakeholder';

    protected array $validationRules = [
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'stakeholder';
}
