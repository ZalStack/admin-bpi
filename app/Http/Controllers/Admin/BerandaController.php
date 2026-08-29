<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\Beranda;
use Illuminate\Http\Request;

class BerandaController extends AdminBaseController
{
    protected string $model = Beranda::class;

    protected string $viewPrefix = 'admin.beranda';

    protected string $routeName = 'admin.beranda';

    protected string $label = 'Homepage Section';

    protected array $validationRules = [
        'section' => 'required|string|in:tentang,struktur,proyek,program,berita,mitra',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [];

    protected ?string $imageField = null;

    protected ?string $imagePath = null;

    protected function buildValidationRules(bool $forUpdate): array
    {
        $rules = $this->validationRules;
        $rules['translations'] = ['nullable', 'array'];

        return $rules;
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->buildValidationRules(false));

        $item = $this->model::create([
            'section' => $validated['section'],
            'urutan' => $validated['urutan'] ?? 1,
            'status' => $request->boolean('status', true),
        ]);

        $defaultTitles = [
            'tentang' => ['id' => 'Tentang Kami', 'en' => 'About Us'],
            'struktur' => ['id' => 'Struktur Organisasi', 'en' => 'Organizational Structure'],
            'proyek' => ['id' => 'Proyek Kolaboratif', 'en' => 'Collaborative Projects'],
            'program' => ['id' => 'Program Strategis', 'en' => 'Strategic Programs'],
            'berita' => ['id' => 'Artikel & Berita', 'en' => 'Articles & News'],
            'mitra' => ['id' => 'Mitra Kerjasama', 'en' => 'Our Partners'],
        ];

        $translations = (array) $request->input('translations', []);
        if (empty($translations)) {
            $bahasas = Bahasa::all();
            $sec = $item->section;
            foreach ($bahasas as $b) {
                $translations[$b->kode] = [
                    'judul' => $defaultTitles[$sec][$b->kode] ?? ucfirst($sec),
                    'deskripsi' => null,
                ];
            }
        }

        $item->storeTranslations($translations);

        return redirect()->route($this->routeName.'.index')
            ->with('success', 'Section beranda berhasil ditambahkan');
    }
}
