<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Bahasa;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaApiController extends BaseApiController
{
    protected $model = Berita::class;

    protected ?string $imageField = 'gambar_utama';

    protected ?string $imagePath = 'berita';

    protected array $withRelations = ['galeri'];

    protected array $orderBy = ['created_at' => 'desc'];

    protected array $validationRules = [
        'slug' => 'nullable|string|max:255|unique:berita,slug',
        'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'penulis' => 'required|string|max:255',
        'tanggal_publikasi' => 'required|date',
        'status' => 'nullable|string|in:draft,published,archived',
    ];

    protected array $updateValidationRules = [
        'slug' => 'nullable|string|max:255',
        'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'penulis' => 'required|string|max:255',
        'tanggal_publikasi' => 'required|date',
        'status' => 'nullable|string|in:draft,published,archived',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'ringkasan' => 'required|string',
        'isi' => 'required|string',
        'kategori' => 'required|string|max:100',
        'kutipan' => 'nullable|string',
    ];

    public function getActive()
    {
        $resources = $this->model::query()
            ->with(['galeri', 'translations'])
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources);
    }

    public function getBySlug($slug)
    {
        $resource = $this->model::query()
            ->with(['galeri', 'translations'])
            ->where('slug', $slug)
            ->first();

        if (! $resource) {
            return $this->notFoundResponse('Berita not found');
        }

        return $this->successResponse($resource);
    }

    public function getByStatus($status)
    {
        if (! in_array($status, ['published', 'draft', 'archived'])) {
            return $this->errorResponse('Invalid status', 400);
        }

        $resources = $this->model::query()
            ->with(['galeri', 'translations'])
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources);
    }

    public function getByKategori($kategori)
    {
        $resources = $this->model::query()
            ->with(['galeri', 'translations'])
            ->whereHas('translations', function ($q) use ($kategori) {
                $q->where('kategori', $kategori);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources);
    }

    public function getLatest()
    {
        $resources = $this->model::query()
            ->with(['galeri', 'translations'])
            ->where('status', 'published')
            ->orderBy('tanggal_publikasi', 'desc')
            ->limit(5)
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
        $defaultJudul = (string) data_get($request->input('translations', []), Bahasa::defaultKode().'.judul', '');
        $data['slug'] = $data['slug'] ?? Str::slug($defaultJudul, '-').'-'.time();

        if ($this->imageField && $request->hasFile($this->imageField)) {
            $data[$this->imageField] = $this->uploadFile(
                $request->file($this->imageField),
                $this->imagePath
            );
        }

        $resource = $this->model::create($data);
        $resource->storeTranslations((array) $request->input('translations', []));
        $resource->load('translations');

        return $this->successResponse($resource, 'Berita created successfully', 201);
    }

    public function destroy($id)
    {
        $resource = $this->model::query()->with('galeri')->find($id);

        if (! $resource) {
            return $this->notFoundResponse();
        }

        if ($this->imageField && $resource->{$this->imageField}) {
            $this->deleteFile($this->imagePath, $resource->{$this->imageField});
        }

        foreach ($resource->galeri as $galeri) {
            if ($galeri->gambar) {
                $this->deleteFile('berita/galeri', $galeri->gambar);
            }
        }

        return $this->deleteResource($this->model, $id);
    }

    public function toggleStatus($id)
    {
        $resource = $this->model::find($id);

        if (! $resource) {
            return $this->notFoundResponse();
        }

        $resource->status = $resource->status === 'published' ? 'draft' : 'published';
        $resource->save();

        return $this->successResponse([
            'id' => $resource->id,
            'status' => $resource->status,
        ], 'Status updated successfully');
    }
}
