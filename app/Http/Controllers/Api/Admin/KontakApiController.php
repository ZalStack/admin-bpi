<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakApiController extends BaseApiController
{
    protected $model = Kontak::class;

    protected $validationRules = [
        'judul_id' => 'required|string|max:255',
        'judul_en' => 'required|string|max:255',
        'deskripsi_id' => 'required|string',
        'deskripsi_en' => 'required|string',
        'alamat_id' => 'nullable|string',
        'alamat_en' => 'nullable|string',
        'email' => 'nullable|email|max:255',
        'telepon' => 'nullable|string|max:100',
        'whatsapp' => 'nullable|string|max:100',
        'media_sosial' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'status' => 'boolean'
    ];

    protected $updateValidationRules = [
        'judul_id' => 'required|string|max:255',
        'judul_en' => 'required|string|max:255',
        'deskripsi_id' => 'required|string',
        'deskripsi_en' => 'required|string',
        'alamat_id' => 'nullable|string',
        'alamat_en' => 'nullable|string',
        'email' => 'nullable|email|max:255',
        'telepon' => 'nullable|string|max:100',
        'whatsapp' => 'nullable|string|max:100',
        'media_sosial' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'status' => 'boolean'
    ];

    public function getActive()
    {
        $resources = $this->model->where('status', true)->get();

        return $this->successResponse($resources);
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $request->all();

        return $this->createResource($this->model, $data);
    }

    public function update(Request $request, $id)
    {
        $validator = validator($request->all(), $this->updateValidationRules);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $request->all();
        $resource = $this->model->find($id);

        if (!$resource) {
            return $this->notFoundResponse();
        }

        return $this->updateResource($this->model, $id, $data);
    }

    public function destroy($id)
    {
        return $this->deleteResource($this->model, $id);
    }

    public function toggleStatus($id)
    {
        return $this->toggleStatus($this->model, $id);
    }
}
