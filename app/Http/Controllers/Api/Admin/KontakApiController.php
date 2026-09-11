<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Kontak;

class KontakApiController extends BaseApiController
{
    protected $model = Kontak::class;

    protected array $orderBy = ['created_at' => 'desc'];

    protected array $validationRules = [
        'gmaps_url' => 'nullable|string|max:1000',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'nama_kantor' => 'nullable|string|max:255',
        'alamat' => 'nullable|string|max:1000',
        'jam_operasional' => 'nullable|string|max:255',
    ];

    protected array $withRelations = ['social_media', 'email', 'phone'];

    public function index()
    {
        $resource = $this->model::query()
            ->with([
                'social_media' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'email' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'phone' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'translations',
            ])
            ->where('status', true)
            ->orderBy('created_at', 'desc')
            ->first()
            ?? $this->model::query()
            ->with([
                'social_media' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'email' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'phone' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'translations',
            ])
            ->orderBy('created_at', 'desc')
            ->first();

        return $this->successResponse($this->formatKontak($resource));
    }

    public function getActive()
    {
        return $this->index();
    }

    public function show($id)
    {
        $resource = $this->model::query()
            ->with([
                'social_media' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'email' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'phone' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'translations',
            ])
            ->find($id);

        if (! $resource) {
            return $this->notFoundResponse('Kontak not found');
        }

        return $this->successResponse($this->formatKontak($resource));
    }

    protected function formatKontak($kontak): ?array
    {
        if (! $kontak) {
            return null;
        }

        $trans = $kontak->translations->firstWhere('bahasa', app()->getLocale())
            ?? $kontak->translations->firstWhere('bahasa', 'id')
            ?? $kontak->translations->first();

        return [
            'id' => $kontak->id,
            'latitude' => $kontak->latitude,
            'longitude' => $kontak->longitude,
            'gmaps_url' => $kontak->gmaps_url,
            'status' => (bool) $kontak->status,
            'judul' => $trans?->judul ?? 'HUBUNGI KAMI',
            'nama_kantor' => $trans?->nama_kantor ?? 'Sekretariat Pusat BPI',
            'alamat' => $trans?->alamat ?? 'Gedung Film lt. 2, Jl. MT Haryono Kav. 47-48, Cikoko, Pancoran, Jakarta Selatan 12770',
            'jam_operasional' => $trans?->jam_operasional ?? 'Senin – Jumat: 09.00 – 17.00 WIB',
            'translations' => $kontak->translations->map(function ($t) {
                return [
                    'id' => $t->id,
                    'kontak_id' => $t->kontak_id,
                    'bahasa' => $t->bahasa,
                    'judul' => $t->judul,
                    'nama_kantor' => $t->nama_kantor,
                    'alamat' => $t->alamat,
                    'jam_operasional' => $t->jam_operasional,
                ];
            })->values()->all(),
            'social_media' => $kontak->social_media->map(function ($s) {
                return [
                    'id' => $s->id,
                    'platform' => $s->platform,
                    'username' => $s->username,
                    'url' => $s->url,
                ];
            })->values()->all(),
            'email' => $kontak->email->map(function ($e) {
                return [
                    'id' => $e->id,
                    'email' => $e->email,
                    'description' => $e->description,
                    'url' => $e->url,
                ];
            })->values()->all(),
            'phone' => $kontak->phone->map(function ($p) {
                return [
                    'id' => $p->id,
                    'number' => $p->number,
                    'type' => $p->type,
                    'url' => $p->url,
                ];
            })->values()->all(),
        ];
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validator = validator($request->all(), $this->buildValidationRules(false));

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $this->neutralData($request);

        $resource = $this->model::create($data);

        if ($this->usesTranslations()) {
            $resource->storeTranslations((array) $request->input('translations', []));
            $resource->load('translations');
        }

        return $this->successResponse($resource->fresh(['translations', 'social_media', 'email', 'phone']), ucfirst(class_basename($resource)).' created successfully', 201);
    }

    public function update(\Illuminate\Http\Request $request, $id)
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

        $resource->update($data);

        if ($this->usesTranslations() && $request->has('translations')) {
            $resource->storeTranslations((array) $request->input('translations', []));
        }

        return $this->successResponse($resource->fresh(['translations', 'social_media', 'email', 'phone']), ucfirst(class_basename($resource)).' updated successfully');
    }
}
