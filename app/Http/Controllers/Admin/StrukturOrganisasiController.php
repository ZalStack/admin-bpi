<?php

namespace App\Http\Controllers\Admin;

use App\Models\StrukturOrganisasi;

class StrukturOrganisasiController extends AdminBaseController
{
    protected string $model = StrukturOrganisasi::class;

    protected string $viewPrefix = 'admin.struktur';

    protected string $routeName = 'admin.struktur';

    protected string $label = 'Organizational Structure';

    protected array $validationRules = [
        'nama' => 'required|string|max:255',
        'kategori' => 'required|string|in:pimpinan,dewan,bidang,komite,satgas_pokja',
        'sub_kategori' => 'nullable|string|max:50',
        'departemen' => 'nullable|string|max:255',
        'level' => 'nullable|integer|between:1,4',
        'linkedin' => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'telepon' => 'nullable|string|max:50',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'jabatan' => 'required|string|max:255',
        'departemen' => 'nullable|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    protected ?string $imageField = 'foto';

    protected ?string $imagePath = 'struktur';
}