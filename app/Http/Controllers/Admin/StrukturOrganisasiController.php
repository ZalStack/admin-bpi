<?php

namespace App\Http\Controllers\Admin;

use App\Models\StrukturOrganisasi;

class StrukturOrganisasiController extends AdminBaseController
{
    protected string $model = StrukturOrganisasi::class;

    protected string $viewPrefix = 'admin.struktur';

    protected string $routeName = 'admin.struktur';

    protected string $label = 'Struktur organisasi';

    protected array $validationRules = [
        'nama' => 'required|string|max:255',
        'linkedin' => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'telepon' => 'nullable|string|max:50',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'jabatan' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    protected ?string $imageField = 'foto';

    protected ?string $imagePath = 'struktur';
}
