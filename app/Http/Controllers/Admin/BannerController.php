<?php

namespace App\Http\Controllers\Admin;

use App\Models\BannerHalaman;

class BannerController extends AdminBaseController
{
    protected string $model = BannerHalaman::class;

    protected string $viewPrefix = 'admin.banner';

    protected string $routeName = 'admin.banner';

    protected string $label = 'Banner';

    protected string $indexOrderColumn = 'id';

    protected string $indexOrderDirection = 'desc';

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
}
