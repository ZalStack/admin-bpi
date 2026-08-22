<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Beranda;

class BerandaApiController extends BaseApiController
{
    protected $model = Beranda::class;

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'beranda';

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'section' => 'required|string|max:100',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];

    public function getBySection($section)
    {
        $resources = $this->model::query()
            ->with($this->withRelations)
            ->where('section', $section)
            ->orderBy('urutan', 'asc')
            ->get();

        if ($resources->isEmpty()) {
            return $this->notFoundResponse('Beranda with section "'.$section.'" not found');
        }

        return $this->successResponse($resources);
    }
}
