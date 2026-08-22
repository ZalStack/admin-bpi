<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Kontak;

class KontakApiController extends BaseApiController
{
    protected $model = Kontak::class;

    protected array $orderBy = ['created_at' => 'desc'];

    protected array $validationRules = [
        'email' => 'nullable|email|max:255',
        'telepon' => 'nullable|string|max:100',
        'whatsapp' => 'nullable|string|max:100',
        'media_sosial' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'alamat' => 'nullable|string',
    ];
}
