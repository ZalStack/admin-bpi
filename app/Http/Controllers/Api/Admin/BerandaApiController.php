<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Beranda;
use Illuminate\Http\Request;

class BerandaApiController extends BaseApiController
{
    protected $model = Beranda::class;
    protected $imageField = 'gambar';
    protected $imagePath = 'beranda';
    protected $orderBy = ['urutan' => 'asc'];

    protected $validationRules = [
        'section' => 'required|string|max:100',
        'judul_id' => 'required|string|max:255',
        'judul_en' => 'required|string|max:255',
        'deskripsi_id' => 'required|string',
        'deskripsi_en' => 'required|string',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean'
    ];

    protected $updateValidationRules = [
        'section' => 'required|string|max:100',
        'judul_id' => 'required|string|max:255',
        'judul_en' => 'required|string|max:255',
        'deskripsi_id' => 'required|string',
        'deskripsi_en' => 'required|string',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            return $this->notFoundResponse('Beranda with section "' . $section . '" not found');
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

        if ($this->imageField && $request->hasFile($this->imageField)) {
            $data[$this->imageField] = $this->uploadFile(
                $request->file($this->imageField),
                $this->imagePath
            );
        }

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

        if ($this->imageField && $request->hasFile($this->imageField)) {
            $oldFile = $resource->{$this->imageField};
            $data[$this->imageField] = $this->uploadFile(
                $request->file($this->imageField),
                $this->imagePath,
                $oldFile
            );
        }

        if ($this->imageField && !$request->hasFile($this->imageField)) {
            unset($data[$this->imageField]);
        }

        return $this->updateResource($this->model, $id, $data);
    }

    public function destroy($id)
    {
        $resource = $this->model->find($id);

        if (!$resource) {
            return $this->notFoundResponse();
        }

        if ($this->imageField && $resource->{$this->imageField}) {
            $this->deleteFile($this->imagePath, $resource->{$this->imageField});
        }

        $resource->delete();
        return $this->successResponse(null, 'Beranda deleted successfully');
    }

    public function toggleStatus($id)
    {
        return $this->toggleStatus($this->model, $id);
    }

    public function updateUrutan(Request $request)
    {
        $validator = validator($request->all(), [
            'urutan' => 'required|array',
            'urutan.*.id' => 'required|exists:beranda,id',
            'urutan.*.urutan' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        foreach ($request->urutan as $item) {
            Beranda::where('id', $item['id'])->update(['urutan' => $item['urutan']]);
        }

        return $this->successResponse(null, 'Urutan updated successfully');
    }
}
