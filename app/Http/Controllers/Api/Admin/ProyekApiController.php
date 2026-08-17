<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProyekApiController extends BaseApiController
{
    protected $model = Proyek::class;
    protected $imageField = 'gambar_utama';
    protected $imagePath = 'proyek';
    protected $withRelations = ['galeri'];
    protected $orderBy = ['urutan' => 'asc'];

    protected $validationRules = [
        'judul_id' => 'required|string|max:255',
        'judul_en' => 'required|string|max:255',
        'kategori_id' => 'required|string|max:255',
        'kategori_en' => 'required|string|max:255',
        'deskripsi_singkat_id' => 'required|string',
        'deskripsi_singkat_en' => 'required|string',
        'deskripsi_id' => 'required|string',
        'deskripsi_en' => 'required|string',
        'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'lokasi_id' => 'required|string|max:255',
        'lokasi_en' => 'required|string|max:255',
        'tahun' => 'required|string|max:20',
        'tujuan_id' => 'required|string',
        'tujuan_en' => 'required|string',
        'dampak_id' => 'required|string',
        'dampak_en' => 'required|string',
        'kegiatan_utama_id' => 'required|string',
        'kegiatan_utama_en' => 'required|string',
        'capaian_id' => 'required|string',
        'capaian_en' => 'required|string',
        'timeline_id' => 'required|string',
        'timeline_en' => 'required|string',
        'status' => 'nullable|string|max:50',
        'urutan' => 'nullable|integer'
    ];

    protected $updateValidationRules = [
        'judul_id' => 'required|string|max:255',
        'judul_en' => 'required|string|max:255',
        'kategori_id' => 'required|string|max:255',
        'kategori_en' => 'required|string|max:255',
        'deskripsi_singkat_id' => 'required|string',
        'deskripsi_singkat_en' => 'required|string',
        'deskripsi_id' => 'required|string',
        'deskripsi_en' => 'required|string',
        'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'lokasi_id' => 'required|string|max:255',
        'lokasi_en' => 'required|string|max:255',
        'tahun' => 'required|string|max:20',
        'tujuan_id' => 'required|string',
        'tujuan_en' => 'required|string',
        'dampak_id' => 'required|string',
        'dampak_en' => 'required|string',
        'kegiatan_utama_id' => 'required|string',
        'kegiatan_utama_en' => 'required|string',
        'capaian_id' => 'required|string',
        'capaian_en' => 'required|string',
        'timeline_id' => 'required|string',
        'timeline_en' => 'required|string',
        'status' => 'nullable|string|max:50',
        'urutan' => 'nullable|integer'
    ];

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul_id) . '-' . time();

        // Handle file upload for gambar_utama
        if ($this->imageField && $request->hasFile($this->imageField)) {
            $data[$this->imageField] = $this->uploadFile(
                $request->file($this->imageField),
                $this->imagePath
            );
        }

        return $this->createResource($this->model, $data);
    }

    /**
     * Update the specified resource in storage.
     */
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

        // Handle file upload for gambar_utama
        if ($this->imageField && $request->hasFile($this->imageField)) {
            $oldFile = $resource->{$this->imageField};
            $data[$this->imageField] = $this->uploadFile(
                $request->file($this->imageField),
                $this->imagePath,
                $oldFile
            );
        }

        // Remove image field if no new file uploaded
        if ($this->imageField && !$request->hasFile($this->imageField)) {
            unset($data[$this->imageField]);
        }

        return $this->updateResource($this->model, $id, $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $resource = $this->model->with('galeri')->find($id);

        if (!$resource) {
            return $this->notFoundResponse();
        }

        // Delete main image
        if ($this->imageField && $resource->{$this->imageField}) {
            $this->deleteFile($this->imagePath, $resource->{$this->imageField});
        }

        // Delete all gallery images
        foreach ($resource->galeri as $galeri) {
            if ($galeri->gambar) {
                $this->deleteFile('proyek/galeri', $galeri->gambar);
            }
        }

        $resource->delete();
        return $this->successResponse(null, 'Proyek deleted successfully');
    }

    /**
     * Toggle proyek status (published/draft)
     */
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

    /**
     * Get proyek by slug
     */
    public function getBySlug($slug)
    {
        $resource = $this->model->with('galeri')->where('slug', $slug)->first();

        if (!$resource) {
            return $this->notFoundResponse('Proyek not found');
        }

        return $this->successResponse($resource);
    }

    /**
     * Get proyek by status
     */
    public function getByStatus($status)
    {
        if (!in_array($status, ['published', 'draft'])) {
            return $this->errorResponse('Invalid status', 400);
        }

        $resources = $this->model->with('galeri')
            ->where('status', $status)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }

    /**
     * Get proyek by kategori
     */
    public function getByKategori($kategori)
    {
        $resources = $this->model->with('galeri')
            ->where('kategori_id', $kategori)
            ->orWhere('kategori_en', $kategori)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }

    /**
     * Update proyek urutan
     */
    public function updateUrutan(Request $request)
    {
        $validator = validator($request->all(), [
            'urutan' => 'required|array',
            'urutan.*.id' => 'required|exists:proyek,id',
            'urutan.*.urutan' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        foreach ($request->urutan as $item) {
            Proyek::where('id', $item['id'])->update(['urutan' => $item['urutan']]);
        }

        return $this->successResponse(null, 'Urutan updated successfully');
    }
}
