<?php

namespace App\Http\Controllers\Admin;

use App\Models\KategoriStakeholder;
use App\Models\Stakeholder;

class StakeholderController extends AdminBaseController
{
    protected string $model = Stakeholder::class;

    protected string $viewPrefix = 'admin.stakeholder';

    protected string $routeName = 'admin.stakeholder';

    protected string $label = 'Stakeholder';

    protected array $validationRules = [
        'icon' => 'nullable|string|max:255',
        'kategori' => 'nullable|string|max:100',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'stakeholder';

    protected int $imageMaxSize = 800;

    public function index()
    {
        $items = $this->model::query()
            ->with(['translations'])
            ->orderBy('urutan', 'asc')
            ->get();

        // Semua kategori (termasuk nonaktif) supaya nama kategori tetap tampil di tabel
        $kategoris = KategoriStakeholder::with('translations')->get()->keyBy('slug');

        return view($this->viewPrefix.'.index', $this->viewData(['items' => $items, 'kategoris' => $kategoris]));
    }

    public function create()
    {
        $kategoris = KategoriStakeholder::where('status', true)->orderBy('urutan', 'asc')->get();

        return view($this->viewPrefix.'.create', array_merge($this->viewData(), ['kategoris' => $kategoris]));
    }

    public function edit($id)
    {
        $item = $this->model::query()->with(['translations'])->findOrFail($id);
        $kategoris = KategoriStakeholder::where('status', true)->orderBy('urutan', 'asc')->get();

        return view($this->viewPrefix.'.edit', array_merge($this->viewData(['item' => $item]), ['kategoris' => $kategoris]));
    }
}
