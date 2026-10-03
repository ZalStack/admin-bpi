<?php

namespace App\Http\Controllers\Admin;

use App\Models\BannerHalaman;

class BannerController extends AdminBaseController
{
    protected string $model = BannerHalaman::class;

    protected string $viewPrefix = 'admin.banner';

    protected string $routeName = 'admin.banner';

    protected string $label = 'Banner';

    protected string $indexOrderColumn = 'urutan';

    protected string $indexOrderDirection = 'asc';

    protected array $validationRules = [
        'halaman' => 'required|string|max:50',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ];

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'banners';

    public function index()
    {
        $items = $this->model::query()
            ->orderBy('urutan', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return view($this->viewPrefix.'.index', $this->viewData(['items' => $items]));
    }
}
