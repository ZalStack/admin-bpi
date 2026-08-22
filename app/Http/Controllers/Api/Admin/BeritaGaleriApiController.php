<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\BeritaGaleri;
use Illuminate\Http\Request;

class BeritaGaleriApiController extends BaseApiController
{
    protected $model = BeritaGaleri::class;

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'berita/galeri';

    protected array $validationRules = [
        'berita_id' => 'required|exists:berita,id',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'caption' => 'nullable|string|max:255',
    ];

    public function getByBerita($beritaId)
    {
        $resources = $this->model::query()
            ->with($this->withRelations)
            ->where('berita_id', $beritaId)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->buildValidationRules(false));

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        if (! $request->hasFile('gambar')) {
            return $this->errorResponse('Gambar wajib diunggah', 422);
        }

        $data = $this->neutralData($request);
        $data[$this->imageField] = $this->uploadFile(
            $request->file($this->imageField),
            $this->imagePath
        );

        $resource = $this->model::create($data);
        $resource->storeTranslations((array) $request->input('translations', []));
        $resource->load('translations');

        return $this->successResponse($resource, 'Berita galeri created successfully', 201);
    }
}
