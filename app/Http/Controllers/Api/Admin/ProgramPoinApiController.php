<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\ProgramPoin;

class ProgramPoinApiController extends BaseApiController
{
    protected $model = ProgramPoin::class;

    protected array $orderBy = ['urutan' => 'asc'];

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

    public function getByProgram($programId)
    {
        $resources = $this->model::query()
            ->with($this->withRelations)
            ->where('program_id', $programId)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }
}
