<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Beranda;

class BerandaApiController extends BaseApiController
{
    protected $model = Beranda::class;

    protected ?string $imageField = null;

    protected ?string $imagePath = null;

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'section' => 'required|string|in:tentang,struktur,proyek,program,berita,mitra',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    public function index()
    {
        $resources = $this->model::query()
            ->with(['translations' => fn ($q) => $q->orderBy('id', 'asc')])
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($this->formatBerandaList($resources));
    }

    public function getActive()
    {
        $resources = $this->model::query()
            ->with(['translations' => fn ($q) => $q->orderBy('id', 'asc')])
            ->where('status', true)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($this->formatBerandaList($resources));
    }

    public function getBySection($section)
    {
        $resource = $this->model::query()
            ->with(['translations' => fn ($q) => $q->orderBy('id', 'asc')])
            ->where('section', $section)
            ->where('status', true)
            ->first();

        if (! $resource) {
            return $this->notFoundResponse('Beranda with section "'.$section.'" not found');
        }

        return $this->successResponse($this->formatBerandaItem($resource));
    }

    protected function formatBerandaList($items)
    {
        return $items->map(fn ($item) => $this->formatBerandaItem($item))->values()->all();
    }

    protected function formatBerandaItem($item): array
    {
        return [
            'id' => $item->id,
            'section' => $item->section,
            'urutan' => (int) $item->urutan,
            'status' => (bool) $item->status,
            'created_at' => $item->created_at?->toISOString(),
            'updated_at' => $item->updated_at?->toISOString(),
            'translations' => $item->translations->map(function ($t) {
                return [
                    'id' => $t->id,
                    'beranda_id' => $t->beranda_id,
                    'bahasa' => $t->bahasa,
                    'judul' => $t->judul,
                    'created_at' => $t->created_at?->toISOString(),
                    'updated_at' => $t->updated_at?->toISOString(),
                ];
            })->values()->all(),
        ];
    }
}
