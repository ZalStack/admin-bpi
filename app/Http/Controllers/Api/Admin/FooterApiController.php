<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterApiController extends BaseApiController
{
    protected $model = Footer::class;
    protected $orderBy = ['urutan' => 'asc'];

    protected $validationRules = [
        'section' => 'required|string|max:100',
        'judul_id' => 'required|string|max:255',
        'judul_en' => 'required|string|max:255',
        'deskripsi_id' => 'nullable|string',
        'deskripsi_en' => 'nullable|string',
        'link_nama_id' => 'nullable|string|max:255',
        'link_nama_en' => 'nullable|string|max:255',
        'link_url' => 'nullable|string|max:255',
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean'
    ];

    protected $updateValidationRules = [
        'section' => 'required|string|max:100',
        'judul_id' => 'required|string|max:255',
        'judul_en' => 'required|string|max:255',
        'deskripsi_id' => 'nullable|string',
        'deskripsi_en' => 'nullable|string',
        'link_nama_id' => 'nullable|string|max:255',
        'link_nama_en' => 'nullable|string|max:255',
        'link_url' => 'nullable|string|max:255',
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean'
    ];

    public function getActive()
    {
        $resources = $this->model->where('status', true)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }

    public function getBySection($section)
    {
        $resources = $this->model->where('section', $section)
            ->orderBy('urutan', 'asc')
            ->get();

        if ($resources->isEmpty()) {
            return $this->notFoundResponse('Footer with section "' . $section . '" not found');
        }

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

    public function updateUrutan(Request $request)
    {
        $validator = validator($request->all(), [
            'urutan' => 'required|array',
            'urutan.*.id' => 'required|exists:footer,id',
            'urutan.*.urutan' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        foreach ($request->urutan as $item) {
            Footer::where('id', $item['id'])->update(['urutan' => $item['urutan']]);
        }

        return $this->successResponse(null, 'Urutan updated successfully');
    }
}
