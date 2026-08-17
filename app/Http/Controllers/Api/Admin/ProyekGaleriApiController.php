<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Proyek;
use App\Models\ProyekGaleri;
use Illuminate\Http\Request;

class ProyekGaleriApiController extends BaseApiController
{
    protected $model = ProyekGaleri::class;
    protected $imageField = 'gambar';
    protected $imagePath = 'proyek/galeri';

    protected $validationRules = [
        'proyek_id' => 'required|exists:proyek,id',
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'judul_id' => 'nullable|string|max:255',
        'judul_en' => 'nullable|string|max:255',
        'deskripsi_id' => 'nullable|string',
        'deskripsi_en' => 'nullable|string',
        'urutan' => 'nullable|integer',
        'status' => 'boolean'
    ];

    protected $updateValidationRules = [
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'judul_id' => 'nullable|string|max:255',
        'judul_en' => 'nullable|string|max:255',
        'deskripsi_id' => 'nullable|string',
        'deskripsi_en' => 'nullable|string',
        'urutan' => 'nullable|integer',
        'status' => 'boolean'
    ];

    /**
     * Get gallery by proyek ID
     */
    public function getByProyek($proyekId)
    {
        $proyek = Proyek::find($proyekId);

        if (!$proyek) {
            return $this->notFoundResponse('Proyek not found');
        }

        $galeris = ProyekGaleri::where('proyek_id', $proyekId)
            ->orderBy('urutan')
            ->get();

        return $this->successResponse($galeris);
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->uploadFile(
                $request->file('gambar'),
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

        if ($request->hasFile('gambar')) {
            $oldFile = $resource->gambar;
            $data['gambar'] = $this->uploadFile(
                $request->file('gambar'),
                $this->imagePath,
                $oldFile
            );
        }

        if (!$request->hasFile('gambar')) {
            unset($data['gambar']);
        }

        return $this->updateResource($this->model, $id, $data);
    }
}
