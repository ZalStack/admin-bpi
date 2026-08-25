<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\KategoriMitra;
use App\Models\Mitra;
use Illuminate\Http\Request;

class MitraController extends AdminBaseController
{
    protected string $model = Mitra::class;

    protected string $viewPrefix = 'admin.mitra';

    protected string $routeName = 'admin.mitra';

    protected string $label = 'Mitra';

    protected array $validationRules = [
        'website' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
    ];

    protected array $translatableRules = [
        'nama' => 'required|string|max:255',
        'kategori' => 'required|string|max:100',
    ];

    protected ?string $imageField = 'logo';

    protected ?string $imagePath = 'mitra';

    public function index()
    {
        $defaultKode = Bahasa::defaultKode();

        $items = $this->model::query()
            ->with(['translations'])
            ->leftJoin('mitra_translations', function ($join) use ($defaultKode) {
                $join->on('mitra.id', '=', 'mitra_translations.mitra_id')
                    ->where('mitra_translations.bahasa', '=', $defaultKode);
            })
            ->select('mitra.*')
            ->orderByRaw('LOWER(mitra_translations.kategori) ASC')
            ->orderBy('mitra.urutan', 'asc')
            ->orderBy('mitra_translations.nama', 'asc')
            ->get();

        return view($this->viewPrefix.'.index', $this->viewData(['items' => $items]));
    }

    public function create()
    {
        $kategoris = KategoriMitra::where('status', true)->orderBy('urutan', 'asc')->get();
        return view($this->viewPrefix.'.create', array_merge($this->viewData(), ['kategoris' => $kategoris]));
    }

    public function edit($id)
    {
        $item = $this->model::query()->with(['translations'])->findOrFail($id);
        $kategoris = KategoriMitra::where('status', true)->orderBy('urutan', 'asc')->get();

        return view($this->viewPrefix.'.edit', array_merge($this->viewData(['item' => $item]), ['kategoris' => $kategoris]));
    }
}
