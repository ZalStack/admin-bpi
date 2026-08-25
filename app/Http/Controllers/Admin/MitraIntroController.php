<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\MitraIntro;
use Illuminate\Http\Request;

class MitraIntroController extends AdminBaseController
{
    protected string $model = MitraIntro::class;

    protected string $viewPrefix = 'admin.mitra-intro';

    protected string $routeName = 'admin.mitra-intro';

    protected string $label = 'Intro Mitra';

    protected array $validationRules = [
        'status' => 'boolean',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'subjudul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'mitra';

    public function index()
    {
        $intro = MitraIntro::firstOrCreate(['id' => 1], [
            'urutan' => 1,
            'status' => 1,
        ]);

        return redirect()->route('admin.mitra-intro.edit', $intro->id);
    }
}
