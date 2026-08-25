<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\StrukturOrganisasi;

class StrukturOrganisasiApiController extends BaseApiController
{
    protected $model = StrukturOrganisasi::class;

    protected ?string $imageField = 'foto';

    protected ?string $imagePath = 'struktur';

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'nama' => 'required|string|max:255',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'linkedin' => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'jabatan' => 'required|string|max:255',
    ];
}
