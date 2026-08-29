<?php

namespace App\Http\Controllers\Admin;

use App\Models\Program;
use App\Models\ProgramPoin;

class ProgramPoinController extends AdminBaseController
{
    protected string $model = ProgramPoin::class;

    protected string $viewPrefix = 'admin.program-poin';

    protected string $routeName = 'admin.program-poin';

    protected string $label = 'Program Points';

    protected array $validationRules = [
        'program_id' => 'required|exists:program,id',
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    protected function viewData(array $merge = []): array
    {
        return array_merge(parent::viewData(), [
            'programs' => Program::orderBy('urutan')->get(),
        ], $merge);
    }
}
