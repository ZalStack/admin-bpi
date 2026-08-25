<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\KategoriMitra;
use App\Models\Mitra;
use App\Models\MitraIntro;
use Illuminate\Http\Request;

class MitraApiController extends BaseApiController
{
    protected $model = Mitra::class;

    protected ?string $imageField = 'logo';

    protected ?string $imagePath = 'mitra';

    protected array $orderBy = ['urutan' => 'asc'];

    protected array $validationRules = [
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        'website' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'nama' => 'required|string|max:255',
        'kategori' => 'required|string|max:100',
    ];

    public function getIntro()
    {
        $intro = MitraIntro::with('translations')
            ->where('status', true)
            ->first();

        if (!$intro) {
            return $this->notFoundResponse('Data intro mitra belum tersedia');
        }

        return $this->successResponse($intro);
    }

    public function getKategori()
    {
        $kategori = KategoriMitra::with('translations')
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
            ->whereHas('translations', function ($q) use ($kategori) {
                $q->where('kategori', $kategori);
            })
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }
}
