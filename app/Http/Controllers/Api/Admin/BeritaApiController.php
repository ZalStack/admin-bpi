<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Bahasa;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BeritaApiController extends BaseApiController
{
    protected $model = Berita::class;

    protected ?string $imageField = 'gambar_utama';

    protected ?string $imagePath = 'berita';

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

    protected array $withRelations = ['translations', 'tags.translations'];

    public function index()
    {
        $resources = $this->model::query()
            ->with(['translations' => fn ($q) => $q->orderBy('id', 'asc'), 'tags.translations'])
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources->map(fn ($item) => $this->formatBeritaList($item))->values());
    }

    public function getActive()
    {
        $resources = $this->model::query()
            ->with(['translations' => fn ($q) => $q->orderBy('id', 'asc'), 'tags.translations'])
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources->map(fn ($item) => $this->formatBeritaList($item))->values());
    }

    public function getBySlug($slug)
    {
        $resource = $this->model::query()
            ->with([
                'galeri' => fn ($q) => $q->with('translations')->orderBy('urutan', 'asc'),
                'translations' => fn ($q) => $q->orderBy('id', 'asc'),
                'tags.translations' => fn ($q) => $q->orderBy('id', 'asc'),
            ])
            ->where('slug', $slug)
            ->first();

        if (! $resource) {
            return $this->notFoundResponse('Berita not found');
        }

        return $this->successResponse($this->formatBeritaDetail($resource));
    }

    public function show($id)
    {
        $resource = $this->model::query()
            ->with([
                'galeri' => fn ($q) => $q->with('translations')->orderBy('urutan', 'asc'),
                'translations' => fn ($q) => $q->orderBy('id', 'asc'),
                'tags.translations' => fn ($q) => $q->orderBy('id', 'asc'),
            ])
            ->find($id);

        if (! $resource) {
            return $this->notFoundResponse('Berita not found');
        }

        return $this->successResponse($this->formatBeritaDetail($resource));
    }

    public function getByStatus($status)
    {
        if (! in_array($status, ['published', 'draft', 'archived'])) {
            return $this->errorResponse('Invalid status', 400);
        }

        $resources = $this->model::query()
            ->with(['translations' => fn ($q) => $q->orderBy('id', 'asc'), 'tags.translations'])
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources->map(fn ($item) => $this->formatBeritaList($item))->values());
    }

    public function getByKategori($kategori)
    {
        $resources = $this->model::query()
            ->with(['translations' => fn ($q) => $q->orderBy('id', 'asc'), 'tags.translations'])
            ->whereHas('translations', function ($q) use ($kategori) {
                $q->where('kategori', $kategori);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources->map(fn ($item) => $this->formatBeritaList($item))->values());
    }

    public function getLatest()
    {
        $resources = $this->model::query()
            ->with(['translations' => fn ($q) => $q->orderBy('id', 'asc'), 'tags.translations'])
            ->where('status', 'published')
            ->orderBy('tanggal_publikasi', 'desc')
            ->limit(5)
            ->get();

        return $this->successResponse($resources->map(fn ($item) => $this->formatBeritaList($item))->values());
    }

    protected function formatBeritaList($berita): array
    {
        $tagsList = $berita->tags->map(function ($tag) use ($berita) {
            return [
                'id' => $tag->pivot->id ?? $tag->id,
                'berita_id' => $berita->id,
                'tag_id' => $tag->id,
            ];
        })->values()->all();

        $tagsFormatted = $berita->tags->map(function ($tag) {
            $tagName = $tag->translations->firstWhere('bahasa', app()->getLocale())?->tag
                ?? $tag->translations->firstWhere('bahasa', 'id')?->tag
                ?? $tag->translations->first()?->tag
                ?? $tag->slug;

            return [
                'id' => $tag->id,
                'tag' => $tagName,
                'slug' => $tag->slug,
                'status' => (bool) $tag->status,
            ];
        })->values()->all();

        return [
            'id' => $berita->id,
            'slug' => $berita->slug,
            'gambar_utama' => $berita->gambar_utama,
            'gambar_utama_url' => $berita->gambar_utama_url,
            'penulis' => $berita->penulis,
            'tanggal_publikasi' => $berita->tanggal_publikasi ? (is_string($berita->tanggal_publikasi) ? substr($berita->tanggal_publikasi, 0, 10) : $berita->tanggal_publikasi->format('Y-m-d')) : null,
            'status' => $berita->status,
            'tags' => $tagsFormatted,
            'translations' => $berita->translations->map(function ($t) use ($tagsList) {
                return [
                    'id' => $t->id,
                    'berita_id' => $t->berita_id,
                    'bahasa' => $t->bahasa,
                    'judul' => $t->judul,
                    'ringkasan' => $t->ringkasan,
                    'isi' => $t->isi,
                    'kategori' => $t->kategori,
                    'kutipan' => $t->kutipan,
                    'tags' => $tagsList,
                    'created_at' => $t->created_at?->toISOString(),
                    'updated_at' => $t->updated_at?->toISOString(),
                ];
            })->values()->all(),
        ];
    }

    protected function formatBeritaDetail($berita): array
    {
        return [
            'id' => $berita->id,
            'slug' => $berita->slug,
            'gambar_utama' => $berita->gambar_utama,
            'gambar_utama_url' => $berita->gambar_utama_url,
            'penulis' => $berita->penulis,
            'tanggal_publikasi' => $berita->tanggal_publikasi ? (is_string($berita->tanggal_publikasi) ? substr($berita->tanggal_publikasi, 0, 10) : $berita->tanggal_publikasi->format('Y-m-d')) : null,
            'status' => $berita->status,
            'created_at' => $berita->created_at?->toISOString(),
            'updated_at' => $berita->updated_at?->toISOString(),
            'galeri' => $berita->galeri->map(function ($g) {
                $trans = $g->translations->firstWhere('bahasa', app()->getLocale())
                    ?? $g->translations->firstWhere('bahasa', 'id')
                    ?? $g->translations->first();

                return [
                    'id' => $g->id,
                    'berita_id' => $g->berita_id,
                    'gambar' => $g->gambar,
                    'gambar_url' => $g->gambar_url,
                    'judul' => $trans?->judul ?? $trans?->caption,
                    'deskripsi' => $trans?->deskripsi,
                    'urutan' => $g->urutan,
                    'status' => (bool) $g->status,
                    'translations' => $g->translations->map(fn ($gt) => [
                        'id' => $gt->id,
                        'bahasa' => $gt->bahasa,
                        'judul' => $gt->judul ?? $gt->caption,
                        'deskripsi' => $gt->deskripsi,
                    ])->values()->all(),
                    'created_at' => $g->created_at?->toISOString(),
                    'updated_at' => $g->updated_at?->toISOString(),
                ];
            })->values()->all(),
            'translations' => $berita->translations->map(function ($t) {
                return [
                    'id' => $t->id,
                    'berita_id' => $t->berita_id,
                    'bahasa' => $t->bahasa,
                    'judul' => $t->judul,
                    'ringkasan' => $t->ringkasan,
                    'isi' => $t->isi,
                    'kategori' => $t->kategori,
                    'kutipan' => $t->kutipan,
                    'created_at' => $t->created_at?->toISOString(),
                    'updated_at' => $t->updated_at?->toISOString(),
                ];
            })->values()->all(),
            'tags' => $berita->tags->map(function ($tag) {
                $tagName = $tag->translations->firstWhere('bahasa', app()->getLocale())?->tag
                    ?? $tag->translations->firstWhere('bahasa', 'id')?->tag
                    ?? $tag->translations->first()?->tag
                    ?? $tag->slug;
                return [
                    'id' => $tag->id,
                    'tag' => $tagName,
                    'slug' => $tag->slug,
                    'status' => (bool) $tag->status,
                ];
            })->values()->all(),
        ];
    }

    public function getKategori(Request $request)
    {
        if ($request->boolean('with_count', false) || $request->has('count')) {
            $categories = DB::table('berita_translations')
                ->join('berita', 'berita.id', '=', 'berita_translations.berita_id')
                ->where('berita.status', 'published')
                ->select('berita_translations.kategori as name', DB::raw('count(distinct berita.id) as count'))
                ->groupBy('berita_translations.kategori')
                ->orderBy('name')
                ->get();

            return $this->successResponse($categories);
        }

        $categories = DB::table('berita_translations')
            ->join('berita', 'berita.id', '=', 'berita_translations.berita_id')
            ->where('berita.status', 'published')
            ->distinct()
            ->pluck('berita_translations.kategori')
            ->sort()
            ->values();

        return $this->successResponse($categories);
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

        if ($request->has('tag_ids')) {
            $resource->tags()->sync($request->input('tag_ids', []));
        }

        $resource->load(['translations', 'tags']);

        return $this->successResponse($resource, 'Berita created successfully', 201);
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

        if ($request->has('tag_ids')) {
            $resource->tags()->sync($request->input('tag_ids', []));
        }

        return $this->successResponse($resource->fresh(['galeri', 'translations', 'tags']), ucfirst(class_basename($resource)).' updated successfully');
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

        $resource->tags()->detach();

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
