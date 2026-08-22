<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Mitra;
use Illuminate\Http\Request;

class MitraApiController extends BaseApiController
{
    protected $model = Mitra::class;

    protected ?string $imageField = 'logo';

    protected ?string $imagePath = 'mitra';

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'website' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'nama' => 'required|string|max:255',
        'kategori' => 'required|string|max:100',
        'deskripsi' => 'required|string',
        'alamat' => 'nullable|string',
    ];

    public function getByKategori(Request $request, $kategori)
    {
        $resources = $this->model::query()
            ->with($this->withRelations)
            ->whereHas('translations', function ($q) use ($kategori) {
                $q->where('kategori', $kategori);
            })
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }
}
