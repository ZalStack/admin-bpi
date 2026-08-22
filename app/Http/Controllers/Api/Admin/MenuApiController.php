<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Menu;

class MenuApiController extends BaseApiController
{
    protected $model = Menu::class;

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'slug' => 'required|string|max:255|unique:menu,slug',
        'url' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $updateValidationRules = [
        'slug' => 'sometimes|required|string|max:255',
        'url' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'nama' => 'required|string|max:100',
    ];

    public function getBySlug($slug)
    {
        $resource = $this->model::query()
            ->with($this->withRelations)
            ->where('slug', $slug)
            ->first();

        if (! $resource) {
            return $this->notFoundResponse('Menu not found');
        }

        return $this->successResponse($resource);
    }
}
