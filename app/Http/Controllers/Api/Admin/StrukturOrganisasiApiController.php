<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Bahasa;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class StrukturOrganisasiApiController extends BaseApiController
{
    protected $model = StrukturOrganisasi::class;

    protected ?string $imageField = 'foto';

    protected ?string $imagePath = 'struktur';

    protected array $orderBy = [
        'urutan' => 'asc',
        'level' => 'asc',
        'id' => 'asc',
    ];

    protected array $validationRules = [
        'nama' => 'required|string|max:255',
        'kategori' => 'required|string|in:pimpinan,dewan,bidang,komite,satgas_pokja',
        'sub_kategori' => 'nullable|string|max:50',
        'departemen' => 'nullable|string|max:255',
        'level' => 'nullable|integer|between:1,4',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

    public function store(Request $request)
    {
        $defaultKode = Bahasa::defaultKode();
        if ($request->filled("translations.{$defaultKode}.departemen") && ! $request->filled('departemen')) {
            $request->merge([
                'departemen' => $request->input("translations.{$defaultKode}.departemen"),
            ]);
        }

        return parent::store($request);
    }

    public function update(Request $request, $id)
    {
        $defaultKode = Bahasa::defaultKode();
        if ($request->filled("translations.{$defaultKode}.departemen")) {
            $request->merge([
                'departemen' => $request->input("translations.{$defaultKode}.departemen"),
            ]);
        }

        return parent::update($request, $id);
    }
}
