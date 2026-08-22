<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Bahasa;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagApiController extends BaseApiController
{
    protected $model = Tag::class;

    protected array $orderBy = ['created_at' => 'desc'];

    protected array $validationRules = [
        'slug' => 'nullable|string|max:255|unique:tags,slug',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'nama' => 'required|string|max:255',
    ];

    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->buildValidationRules(false));

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $this->neutralData($request);
        $defaultKode = Bahasa::defaultKode();
        $defaultNama = (string) data_get($request->input('translations', []), "$defaultKode.nama", '');
        $data['slug'] = $data['slug'] ?? Str::slug($defaultNama, '-').'-'.time();

        $resource = $this->model::create($data);
        $resource->storeTranslations((array) $request->input('translations', []));
        $resource->load('translations');

        return $this->successResponse($resource, 'Tag created successfully', 201);
    }
}
