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
        'deskripsi_singkat' => 'required|string',
        'deskripsi' => 'required|string',
        'lokasi' => 'required|string|max:255',
        'icon' => 'nullable|string|max:100',
        'ruang_lingkup' => 'nullable|string|max:255',
        'status_proyek' => 'nullable|string|max:100',
        'timeline' => 'required|string',
    ];

    protected array $withRelations = ['galeri', 'translations', 'mitra.translations'];

    public function index()
    {
        $resources = $this->model::query()
            ->with(['galeri', 'translations', 'mitra.translations'])
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources->map(fn ($item) => $this->formatProyekList($item))->values());
    }

    public function getActive()
    {
        $resources = $this->model::query()
            ->with(['galeri', 'translations', 'mitra.translations'])
            ->where('status', 'published')
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources->map(fn ($item) => $this->formatProyekList($item))->values());
    }

    public function getBySlug($slug)
    {
        $resource = $this->model::query()
            ->with([
                'galeri' => fn ($q) => $q->with('translations')->orderBy('urutan', 'asc'),
                'translations' => fn ($q) => $q->orderBy('id', 'asc'),
                'translations.tujuan' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'translations.dampak_capaian' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'translations.kegiatan_utama' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'translations.linimasa_proyek' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'mitra' => fn ($q) => $q->orderBy('urutan', 'asc'),
            ])
            ->where('slug', $slug)
            ->first();

        if (! $resource) {
            return $this->notFoundResponse('Proyek not found');
        }

        return $this->successResponse($this->formatProyekDetail($resource));
    }

    public function show($id)
    {
        $resource = $this->model::query()
            ->with([
                'galeri' => fn ($q) => $q->with('translations')->orderBy('urutan', 'asc'),
                'translations' => fn ($q) => $q->orderBy('id', 'asc'),
                'translations.tujuan' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'translations.dampak_capaian' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'translations.kegiatan_utama' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'translations.linimasa_proyek' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'mitra' => fn ($q) => $q->orderBy('urutan', 'asc'),
            ])
            ->find($id);

        if (! $resource) {
            return $this->notFoundResponse('Proyek not found');
        }

        return $this->successResponse($this->formatProyekDetail($resource));
    }

    public function getByStatus($status)
    {
        if (! in_array($status, ['published', 'draft', 'archived'])) {
            return $this->errorResponse('Invalid status', 400);
        }

        $resources = $this->model::query()
            ->with(['galeri', 'translations', 'mitra.translations'])
            ->where('status', $status)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources->map(fn ($item) => $this->formatProyekList($item))->values());
    }

    public function getByKategori($kategori)
    {
        $resources = $this->model::query()
            ->with(['galeri', 'translations', 'mitra.translations'])
            ->whereHas('translations', function ($q) use ($kategori) {
                $q->where('kategori', $kategori);
            })
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources->map(fn ($item) => $this->formatProyekList($item))->values());
    }

    protected function formatProyekList($proyek): array
    {
        return [
            'id' => $proyek->id,
            'slug' => $proyek->slug,
            'gambar_utama' => $proyek->gambar_utama,
            'gambar_utama_url' => $proyek->gambar_utama_url,
            'tahun' => $proyek->tahun,
            'status' => $proyek->status,
            'urutan' => $proyek->urutan,
            'galeri' => $proyek->galeri->map(function ($g) {
                return [
                    'id' => $g->id,
                    'proyek_id' => $g->proyek_id,
                    'gambar' => $g->gambar,
                    'gambar_url' => $g->gambar_url,
                    'urutan' => $g->urutan,
                    'status' => (bool) $g->status,
                ];
            })->values()->all(),
            'translations' => $proyek->translations->map(function ($t) {
                return [
                    'id' => $t->id,
                    'proyek_id' => $t->proyek_id,
                    'bahasa' => $t->bahasa,
                    'judul' => $t->judul,
                    'deskripsi_singkat' => $t->deskripsi_singkat,
                    'icon' => $t->icon,
                ];
            })->values()->all(),
            'mitra' => $proyek->mitra->map(function ($m) {
                $namaMitra = $m->translations->firstWhere('bahasa', app()->getLocale())?->nama
                    ?? $m->translations->firstWhere('bahasa', 'id')?->nama
                    ?? $m->translations->first()?->nama
                    ?? '';
                return [
                    'id' => $m->id,
                    'mitra' => $namaMitra,
                    'logo' => $m->logo,
                    'logo_url' => $m->logo_url,
                    'website' => $m->website,
                    'urutan' => $m->urutan,
                    'status' => (bool) $m->status,
                ];
            })->values()->all(),
        ];
    }

    protected function formatProyekDetail($proyek): array
    {
        return [
            'id' => $proyek->id,
            'slug' => $proyek->slug,
            'gambar_utama' => $proyek->gambar_utama,
            'gambar_utama_url' => $proyek->gambar_utama_url,
            'tahun' => $proyek->tahun,
            'status' => $proyek->status,
            'urutan' => $proyek->urutan,
            'created_at' => $proyek->created_at?->toISOString(),
            'updated_at' => $proyek->updated_at?->toISOString(),
            'galeri' => $proyek->galeri->map(function ($g) {
                $trans = $g->translations->firstWhere('bahasa', app()->getLocale())
                    ?? $g->translations->firstWhere('bahasa', 'id')
                    ?? $g->translations->first();

                return [
                    'id' => $g->id,
                    'proyek_id' => $g->proyek_id,
                    'gambar' => $g->gambar,
                    'gambar_url' => $g->gambar_url,
                    'judul' => $trans?->judul,
                    'deskripsi' => $trans?->deskripsi,
                    'urutan' => $g->urutan,
                    'status' => (bool) $g->status,
                    'translations' => $g->translations->map(fn ($gt) => [
                        'id' => $gt->id,
                        'bahasa' => $gt->bahasa,
                        'judul' => $gt->judul,
                        'deskripsi' => $gt->deskripsi,
                    ])->values()->all(),
                    'created_at' => $g->created_at?->toISOString(),
                    'updated_at' => $g->updated_at?->toISOString(),
                ];
            })->values()->all(),
            'translations' => $proyek->translations->map(function ($t) {
                return [
                    'id' => $t->id,
                    'proyek_id' => $t->proyek_id,
                    'bahasa' => $t->bahasa,
                    'judul' => $t->judul,
                    'deskripsi_singkat' => $t->deskripsi_singkat,
                    'deskripsi' => $t->deskripsi,
                    'lokasi' => $t->lokasi,
                    'ruang_lingkup' => $t->ruang_lingkup,
                    'status_proyek' => $t->status_proyek,
                    'tujuan' => $t->tujuan->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'deskripsi' => $item->deskripsi,
                            'icon' => $item->icon,
                        ];
                    })->values()->all(),
                    'dampak_capaian' => $t->dampak_capaian->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'icon' => $item->icon,
                            'total_capaian' => $item->total_capaian,
                            'deskripsi' => $item->deskripsi,
                        ];
                    })->values()->all(),
                    'kegiatan_utama' => $t->kegiatan_utama->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'deskripsi' => $item->deskripsi,
                            'icon' => $item->icon,
                        ];
                    })->values()->all(),
                    'linimasa_proyek' => $t->linimasa_proyek->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'tahun' => $item->tahun,
                            'urutan' => $item->urutan,
                            'deskripsi' => $item->deskripsi,
                        ];
                    })->values()->all(),
                    'timeline' => $t->timeline,
                    'created_at' => $t->created_at?->toISOString(),
                    'updated_at' => $t->updated_at?->toISOString(),
                ];
            })->values()->all(),
            'mitra' => $proyek->mitra->map(function ($m) {
                $namaMitra = $m->translations->firstWhere('bahasa', app()->getLocale())?->nama
                    ?? $m->translations->firstWhere('bahasa', 'id')?->nama
                    ?? $m->translations->first()?->nama
                    ?? '';
                return [
                    'id' => $m->id,
                    'mitra' => $namaMitra,
                    'logo' => $m->logo,
                    'logo_url' => $m->logo_url,
                    'website' => $m->website,
                    'urutan' => $m->urutan,
                    'status' => (bool) $m->status,
                ];
            })->values()->all(),
        ];
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
