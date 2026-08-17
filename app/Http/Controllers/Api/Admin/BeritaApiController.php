<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaApiController extends BaseApiController
{
    protected $model = Berita::class;
    protected $imageField = 'gambar_utama';
    protected $imagePath = 'berita';
    protected $withRelations = ['galeri'];
    protected $orderBy = ['created_at' => 'desc'];

    protected $validationRules = [
        'judul_id' => 'required|string|max:255',
        'judul_en' => 'required|string|max:255',
        'ringkasan_id' => 'required|string',
        'ringkasan_en' => 'required|string',
        'isi_id' => 'required|string',
        'isi_en' => 'required|string',
        'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'kategori_id' => 'required|string|max:100',
        'kategori_en' => 'required|string|max:100',
        'penulis' => 'required|string|max:255',
        'tanggal_publikasi' => 'required|date',
        'kutipan_id' => 'nullable|string',
        'kutipan_en' => 'nullable|string',
        'status' => 'nullable|string|max:50'
    ];

    protected $updateValidationRules = [
        'judul_id' => 'required|string|max:255',
        'judul_en' => 'required|string|max:255',
        'ringkasan_id' => 'required|string',
        'ringkasan_en' => 'required|string',
        'isi_id' => 'required|string',
        'isi_en' => 'required|string',
        'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'kategori_id' => 'required|string|max:100',
        'kategori_en' => 'required|string|max:100',
        'penulis' => 'required|string|max:255',
        'tanggal_publikasi' => 'required|date',
        'kutipan_id' => 'nullable|string',
        'kutipan_en' => 'nullable|string',
        'status' => 'nullable|string|max:50'
    ];

    public function getActive()
    {
        $resources = $this->model->with('galeri')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources);
    }

    public function getBySlug($slug)
    {
        $resource = $this->model->with('galeri')->where('slug', $slug)->first();

        if (!$resource) {
            return $this->notFoundResponse('Berita not found');
        }

        return $this->successResponse($resource);
    }

    public function getByStatus($status)
    {
        if (!in_array($status, ['published', 'draft'])) {
            return $this->errorResponse('Invalid status', 400);
        }

        $resources = $this->model->with('galeri')
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources);
    }

    public function getByKategori($kategori)
    {
        $resources = $this->model->with('galeri')
            ->where('kategori_id', $kategori)
            ->orWhere('kategori_en', $kategori)
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources);
    }

    public function getLatest()
    {
        $resources = $this->model->with('galeri')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(5)
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
        $data['slug'] = Str::slug($request->judul_id) . '-' . time();

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
        $resource = $this->model->with('galeri')->find($id);

        if (!$resource) {
            return $this->notFoundResponse();
        }

        if ($this->imageField && $resource->{$this->imageField}) {
            $this->deleteFile($this->imagePath, $resource->{$this->imageField});
        }

        foreach ($resource->galeri as $galeri) {
            if ($galeri->gambar) {
                $this->deleteFile('berita/galeri', $galeri->gambar);
            }
        }

        return $this->deleteResource($this->model, $id);
    }

    public function toggleStatus($id)
    {
        $resource = $this->model->find($id);

        if (!$resource) {
            return $this->notFoundResponse();
        }

        $resource->status = $resource->status == 'published' ? 'draft' : 'published';
        $resource->save();

        return $this->successResponse([
            'id' => $resource->id,
            'status' => $resource->status
        ], 'Status updated successfully');
    }
}
