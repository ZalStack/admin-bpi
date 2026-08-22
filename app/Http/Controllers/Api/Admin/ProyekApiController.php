<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Bahasa;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProyekApiController extends BaseApiController
{
    protected $model = Proyek::class;

    protected ?string $imageField = 'gambar_utama';

    protected ?string $imagePath = 'proyek';

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'slug' => 'nullable|string|max:255|unique:proyek,slug',
        'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tahun' => 'required|string|max:20',
        'status' => 'nullable|string|in:draft,published,archived',
        'urutan' => 'nullable|integer',
    ];

    protected array $updateValidationRules = [
        'slug' => 'nullable|string|max:255',
        'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tahun' => 'required|string|max:20',
        'status' => 'nullable|string|in:draft,published,archived',
        'urutan' => 'nullable|integer',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'kategori' => 'required|string|max:255',
        'deskripsi_singkat' => 'required|string',
        'deskripsi' => 'required|string',
        'lokasi' => 'required|string|max:255',
        'tujuan' => 'required|string',
        'dampak' => 'required|string',
        'kegiatan_utama' => 'required|string',
        'capaian' => 'required|string',
        'timeline' => 'required|string',
    ];

    protected array $withRelations = ['galeri', 'translations', 'mitra'];

    public function getBySlug($slug)
    {
        $resource = $this->model::query()
            ->with(['galeri', 'translations', 'mitra'])
            ->where('slug', $slug)
            ->first();

        if (! $resource) {
            return $this->notFoundResponse('Proyek not found');
        }

        return $this->successResponse($resource);
    }

    public function getByStatus($status)
    {
        if (! in_array($status, ['published', 'draft', 'archived'])) {
            return $this->errorResponse('Invalid status', 400);
        }

        $resources = $this->model::query()
            ->with(['galeri', 'translations', 'mitra'])
            ->where('status', $status)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }

    public function getByKategori($kategori)
    {
        $resources = $this->model::query()
            ->with(['galeri', 'translations', 'mitra'])
            ->whereHas('translations', function ($q) use ($kategori) {
                $q->where('kategori', $kategori);
            })
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->buildValidationRules(false));

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $this->neutralData($request);
        $data['slug'] = $data['slug'] ?? Str::slug(
            (string) data_get($request->input('translations', []), Bahasa::defaultKode().'.judul', ''),
            '-'
        ).'-'.time();

        if ($this->imageField && $request->hasFile($this->imageField)) {
            $data[$this->imageField] = $this->uploadFile(
                $request->file($this->imageField),
                $this->imagePath
            );
        }

        $resource = $this->model::create($data);
        $resource->storeTranslations((array) $request->input('translations', []));

        if ($request->has('mitra_ids')) {
            $resource->mitra()->sync($request->input('mitra_ids', []));
        }

        $resource->load(['translations', 'mitra']);

        return $this->successResponse($resource, 'Proyek created successfully', 201);
    }

    public function update(Request $request, $id)
    {
        $resource = $this->model::find($id);

        if (! $resource) {
            return $this->notFoundResponse();
        }

        $validator = validator($request->all(), $this->buildValidationRules(true));

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $this->neutralData($request);

        if ($this->imageField && $request->hasFile($this->imageField)) {
            $oldFile = $resource->{$this->imageField};
            $data[$this->imageField] = $this->uploadFile(
                $request->file($this->imageField),
                $this->imagePath,
                $oldFile
            );
        }

        $resource->update($data);

        if ($this->usesTranslations() && $request->has('translations')) {
            $resource->storeTranslations((array) $request->input('translations', []));
        }

        if ($request->has('mitra_ids')) {
            $resource->mitra()->sync($request->input('mitra_ids', []));
        }

        return $this->successResponse($resource->fresh(['galeri', 'translations', 'mitra']), ucfirst(class_basename($resource)).' updated successfully');
    }
}
