<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\TentangPoin;

class TentangPoinApiController extends BaseApiController
{
    protected $model = TentangPoin::class;

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'tentang_id' => 'required|exists:tentang,id',
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    public function getByTentang($tentangId)
    {
        $resources = $this->model::query()
            ->with($this->withRelations)
            ->where('tentang_id', $tentangId)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }
}
