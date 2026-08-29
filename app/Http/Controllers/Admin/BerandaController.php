<?php

namespace App\Http\Controllers\Admin;

use App\Models\Beranda;

class BerandaController extends AdminBaseController
{
    protected string $model = Beranda::class;

    protected string $viewPrefix = 'admin.beranda';

    protected string $routeName = 'admin.beranda';

    protected string $label = 'Homepage Data';

    protected array $validationRules = [
        'section' => 'required|string|in:tentang,struktur,proyek,program,berita,mitra',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'nullable|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    protected ?string $imageField = null;

    protected ?string $imagePath = null;
}
