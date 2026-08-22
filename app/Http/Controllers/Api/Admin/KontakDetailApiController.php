<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\KontakDetail;

class KontakDetailApiController extends BaseApiController
{
    protected $model = KontakDetail::class;

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'kontak_id' => 'required|exists:kontak,id',
        'icon' => 'nullable|string|max:255',
        'link_url' => 'nullable|string|max:255',
        'link_nama' => 'nullable|string|max:255',
        'handle' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'nilai' => 'nullable|string',
    ];

    public function getByKontak($kontakId)
    {
        $resources = $this->model::query()
            ->with($this->withRelations)
            ->where('kontak_id', $kontakId)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }
}
