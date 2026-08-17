<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Mitra;
use Illuminate\Http\Request;

class MitraApiController extends BaseApiController
{
    protected $model = Mitra::class;
    protected $imageField = 'logo';
    protected $imagePath = 'mitra';
    protected $orderBy = ['urutan' => 'asc'];

    protected $validationRules = [
        'nama_id' => 'required|string|max:255',
        'nama_en' => 'required|string|max:255',
        'kategori_id' => 'required|string|max:100',
        'kategori_en' => 'required|string|max:100',
        'deskripsi_id' => 'required|string',
        'deskripsi_en' => 'required|string',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'website' => 'nullable|string|max:255',
        'alamat_id' => 'nullable|string',
        'alamat_en' => 'nullable|string',
        'urutan' => 'nullable|integer',
        'status' => 'boolean'
    ];

    protected $updateValidationRules = [
        'nama_id' => 'required|string|max:255',
        'nama_en' => 'required|string|max:255',
        'kategori_id' => 'required|string|max:100',
        'kategori_en' => 'required|string|max:100',
        'deskripsi_id' => 'required|string',
        'deskripsi_en' => 'required|string',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'website' => 'nullable|string|max:255',
        'alamat_id' => 'nullable|string',
        'alamat_en' => 'nullable|string',
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

    public function getByKategori($kategori)
    {
        $resources = $this->model
            ->where('kategori_id', $kategori)
            ->orWhere('kategori_en', $kategori)
            ->orderBy('urutan', 'asc')
            ->get();

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
        return $this->successResponse(null, 'Mitra deleted successfully');
    }

    public function toggleStatus($id)
    {
        return $this->toggleStatus($this->model, $id);
    }

    public function updateUrutan(Request $request)
    {
        $validator = validator($request->all(), [
            'urutan' => 'required|array',
            'urutan.*.id' => 'required|exists:mitra,id',
            'urutan.*.urutan' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        foreach ($request->urutan as $item) {
            Mitra::where('id', $item['id'])->update(['urutan' => $item['urutan']]);
        }

        return $this->successResponse(null, 'Urutan updated successfully');
    }
}
