<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Tentang;

class TentangApiController extends BaseApiController
{
    protected $model = Tentang::class;

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'tentang';

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'section' => 'required|string|in:intro,visi,misi',
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'subjudul' => 'nullable|string|max:255',
        'deskripsi' => 'nullable|string',
        'highlight_words' => 'nullable|string',
    ];

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
