<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\KategoriStakeholder;
use App\Models\Stakeholder;
use Illuminate\Http\Request;

class StakeholderApiController extends BaseApiController
{
    protected $model = Stakeholder::class;

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'stakeholder';

    protected int $imageMaxSize = 800;

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'icon' => 'nullable|string|max:255',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'kategori' => 'nullable|string|max:100',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];

    public function getKategori()
    {
        $kategori = KategoriStakeholder::with('translations')
            ->where('status', true)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($kategori);
    }

    public function getByKategori(Request $request, $kategori)
    {
        $resources = $this->model::query()
            ->with($this->withRelations)
            ->where('status', true)
            ->where('kategori', $kategori)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }
}
