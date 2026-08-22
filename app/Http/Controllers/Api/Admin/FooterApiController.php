<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Footer;

class FooterApiController extends BaseApiController
{
    protected $model = Footer::class;

    protected ?string $imageField = 'icon';

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'section' => 'required|string|max:100',
        'link_url' => 'nullable|string|max:255',
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'link_nama' => 'nullable|string|max:255',
    ];

    public function getBySection($section)
    {
        $resources = $this->model::query()
            ->with($this->withRelations)
            ->where('section', $section)
            ->orderBy('urutan', 'asc')
            ->get();

        if ($resources->isEmpty()) {
            return $this->notFoundResponse('Footer with section "'.$section.'" not found');
        }

        return $this->successResponse($resources);
    }
}
