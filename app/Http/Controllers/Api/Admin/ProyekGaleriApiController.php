<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\ProyekGaleri;
use Illuminate\Http\Request;

class ProyekGaleriApiController extends BaseApiController
{
    protected $model = ProyekGaleri::class;

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'proyek/galeri';

    protected array $validationRules = [
        'proyek_id' => 'required|exists:proyek,id',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'nullable|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    public function getByProyek($proyekId)
    {
        $resources = $this->model::query()
            ->with($this->withRelations)
            ->where('proyek_id', $proyekId)
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
            return $this->errorResponse('Image is required', 422);
        }

        $data = $this->neutralData($request);
        $data[$this->imageField] = $this->uploadFile(
            $request->file($this->imageField),
            $this->imagePath
        );

        $resource = $this->model::create($data);
        $resource->storeTranslations((array) $request->input('translations', []));
        $resource->load('translations');

        return $this->successResponse($resource, 'Proyek galeri created successfully', 201);
    }
}
