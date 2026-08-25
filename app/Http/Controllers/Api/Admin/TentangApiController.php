<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Tentang;

class TentangApiController extends BaseApiController
{
    protected $model = Tentang::class;

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'tentang';

    protected array $orderBy = ['urutan' => 'asc'];

    public function getActive()
    {
        $resources = $this->model::query()
            ->with([
                'translations',
                'poin' => fn ($q) => $q->where('status', true)->orderBy('urutan', 'asc'),
                'poin.translations'
            ])
            ->where('status', true)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }

    public function getBySection($section)
    {
        $resources = $this->model::query()
            ->with([
                'translations',
                'poin' => fn ($q) => $q->where('status', true)->orderBy('urutan', 'asc'),
                'poin.translations'
            ])
            ->where('section', $section)
            ->where('status', true)
            ->orderBy('urutan', 'asc')
            ->get();

        if ($resources->isEmpty()) {
            return $this->notFoundResponse('Tentang with section "'.$section.'" not found');
        }

        return $this->successResponse($resources);
    }
}
