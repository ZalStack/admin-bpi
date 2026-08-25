<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\BannerHalaman;

class BannerApiController extends BaseApiController
{
    protected $model = BannerHalaman::class;

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'banners';

    protected array $validationRules = [
        'halaman' => 'required|string|max:50',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];

    public function getByHalaman($halaman)
    {
        $resource = $this->model::query()
            ->with($this->withRelations)
            ->where('halaman', $halaman)
            ->where('status', true)
            ->first();

        if (! $resource) {
            return $this->notFoundResponse("Banner for halaman '{$halaman}' not found");
        }

        return $this->successResponse($resource);
    }
}
