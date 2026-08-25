<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tentang;
use App\Models\TentangPoin;

class TentangPoinController extends AdminBaseController
{
    protected string $model = TentangPoin::class;

    protected string $viewPrefix = 'admin.tentang-poin';

    protected string $routeName = 'admin.tentang-poin';

    protected string $label = 'Poin Visi & Misi';

    protected array $validationRules = [
        'tentang_id' => 'required|exists:tentang,id',
        'icon' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    protected function viewData(array $merge = []): array
    {
        return array_merge(parent::viewData(), [
            'tentangs' => Tentang::whereIn('section', ['visi', 'misi'])->orderBy('urutan')->get(),
        ], $merge);
    }
}
