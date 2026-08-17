<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Berita;
use App\Models\BeritaGaleri;
use Illuminate\Http\Request;

class BeritaGaleriApiController extends BaseApiController
{
    protected $model = BeritaGaleri::class;
    protected $imageField = 'gambar';
    protected $imagePath = 'berita/galeri';

    protected $validationRules = [
        'berita_id' => 'required|exists:berita,id',
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'caption_id' => 'nullable|string|max:255',
        'caption_en' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean'
    ];

    protected $updateValidationRules = [
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'caption_id' => 'nullable|string|max:255',
        'caption_en' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean'
    ];

    /**
     * Get gallery by berita ID
     */
    public function getByBerita($beritaId)
    {
        $berita = Berita::find($beritaId);

        if (!$berita) {
            return $this->notFoundResponse('Berita not found');
        }

        $galeris = BeritaGaleri::where('berita_id', $beritaId)
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
