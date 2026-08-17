<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuApiController extends BaseApiController
{
    protected $model = Menu::class;
    protected $orderBy = ['urutan' => 'asc'];

    protected $validationRules = [
        'nama_id' => 'required|string|max:100',
        'nama_en' => 'required|string|max:100',
        'url' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean'
    ];

    protected $updateValidationRules = [
        'nama_id' => 'required|string|max:100',
        'nama_en' => 'required|string|max:100',
        'url' => 'nullable|string|max:255',
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

    public function getBySlug($slug)
    {
        $resource = $this->model->where('slug', $slug)->first();

        if (!$resource) {
            return $this->notFoundResponse('Menu not found');
        }

        return $this->successResponse($resource);
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_id) . '-' . time();

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
            'urutan.*.id' => 'required|exists:menu,id',
            'urutan.*.urutan' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        foreach ($request->urutan as $item) {
            Menu::where('id', $item['id'])->update(['urutan' => $item['urutan']]);
        }

        return $this->successResponse(null, 'Urutan updated successfully');
    }
}
