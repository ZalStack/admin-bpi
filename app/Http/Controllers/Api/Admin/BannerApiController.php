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
        'urutan' => 'nullable|integer',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];

    public function getByHalaman($halaman)
    {
        $halamanMap = [
            'project' => 'proyek',
            'projects' => 'proyek',
            'news' => 'berita',
            'articles' => 'berita',
            'about' => 'tentang',
            'contact' => 'kontak',
        ];
        $targetHalaman = $halamanMap[$halaman] ?? $halaman;

        $resources = $this->model::query()
            ->with($this->withRelations)
            ->where(function ($q) use ($halaman, $targetHalaman) {
                $q->where('halaman', $halaman)
                  ->orWhere('halaman', $targetHalaman);
            })
            ->where('status', true)
            ->orderBy('urutan', 'asc')
            ->get();

        if ($resources->isEmpty()) {
            return $this->notFoundResponse("Banner for halaman '{$halaman}' not found");
        }

        return $this->successResponse($resources);
    }
}
