<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Kontak;

class KontakApiController extends BaseApiController
{
    protected $model = Kontak::class;

    protected array $orderBy = ['created_at' => 'desc'];

    protected array $validationRules = [
        'email' => 'nullable|email|max:255',
        'telepon' => 'nullable|string|max:100',
        'whatsapp' => 'nullable|string|max:100',
        'media_sosial' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'alamat' => 'nullable|string',
    ];

    public function getActive()
    {
        $resources = $this->model::query()
            ->with(['translations', 'detail', 'detail.translations'])
            ->where('status', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources);
    }

    public function show($id)
    {
        $resource = $this->model::query()
            ->with(['translations', 'detail', 'detail.translations'])
            ->find($id);

        if (! $resource) {
            return $this->notFoundResponse();
        }

        return $this->successResponse($resource);
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

        return $this->successResponse($resource->fresh(['translations', 'detail', 'detail.translations']), ucfirst(class_basename($resource)).' created successfully', 201);
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

        return $this->successResponse($resource->fresh(['translations', 'detail', 'detail.translations']), ucfirst(class_basename($resource)).' updated successfully');
    }
}
