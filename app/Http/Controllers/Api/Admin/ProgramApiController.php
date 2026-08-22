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

    public function getActive()
    {
        $resources = $this->model::query()
            ->with(['translations', 'poin', 'poin.translations'])
            ->where('status', true)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }

    public function show($id)
    {
        $resource = $this->model::query()
            ->with(['translations', 'poin', 'poin.translations'])
            ->find($id);

        if (! $resource) {
            return $this->notFoundResponse();
        }

        return $this->successResponse($resource);
    }
}
