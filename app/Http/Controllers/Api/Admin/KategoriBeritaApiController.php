<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriBeritaApiController extends BaseApiController
{
    protected $model = KategoriBerita::class;

    protected array $orderBy = ['id' => 'asc'];

    protected array $validationRules = [
        'warna' => 'nullable|string|max:50',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255',
    ];

    public function index()
    {
        $categories = $this->model::query()
            ->with(['translations' => fn ($q) => $q->orderBy('id', 'asc')])
            ->orderBy('id', 'asc')
            ->get();

        $data = $categories->map(function ($item) {
            return [
                'id' => $item->id,
                'warna' => $item->warna ?? '#68001C',
                'translations' => $item->translations->map(function ($t) {
                    return [
                        'id' => $t->id,
                        'judul' => $t->judul,
                        'slug' => $t->slug,
                        'bahasa' => $t->bahasa,
                        'created_at' => $t->created_at?->toISOString(),
                        'updated_at' => $t->updated_at?->toISOString(),
                    ];
                })->values()->all(),
            ];
        })->values()->all();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $data,
        ]);
    }

    public function show($id)
    {
        $item = $this->model::query()
            ->with(['translations' => fn ($q) => $q->orderBy('id', 'asc')])
            ->find($id);

        if (! $item) {
            return $this->notFoundResponse('Category not found');
        }

        return $this->successResponse([
            'id' => $item->id,
            'warna' => $item->warna ?? '#68001C',
            'translations' => $item->translations,
        ]);
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->buildValidationRules(false));

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $this->neutralData($request);
        if (empty($data['warna'])) {
            $data['warna'] = '#68001C';
        }
        $resource = $this->model::create($data);

        $translations = (array) $request->input('translations', []);
        foreach ($translations as $lang => $transData) {
            if (empty($transData['slug']) && ! empty($transData['judul'])) {
                $translations[$lang]['slug'] = Str::slug($transData['judul']);
            }
        }

        $resource->storeTranslations($translations);
        $resource->load('translations');

        return $this->successResponse($resource, 'Kategori Berita created successfully', 201);
    }

    public function update(Request $request, $id)
    {
        $resource = $this->model::find($id);

        if (! $resource) {
            return $this->notFoundResponse('Category not found');
        }

        $validator = validator($request->all(), $this->buildValidationRules(true));

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $this->neutralData($request);
        if (empty($data['warna'])) {
            $data['warna'] = '#68001C';
        }
        $resource->update($data);

        if ($this->usesTranslations() && $request->has('translations')) {
            $translations = (array) $request->input('translations', []);
            foreach ($translations as $lang => $transData) {
                if (empty($transData['slug']) && ! empty($transData['judul'])) {
                    $translations[$lang]['slug'] = Str::slug($transData['judul']);
                }
            }
            $resource->storeTranslations($translations);
        }

        return $this->successResponse($resource->fresh('translations'), 'Category updated successfully');
    }
}
