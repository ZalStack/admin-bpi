<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\Mitra;
use App\Models\Proyek;
use App\Models\ProyekTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProyekController extends AdminBaseController
{
    protected string $model = Proyek::class;

    protected string $viewPrefix = 'admin.proyek';

    protected string $routeName = 'admin.proyek';

    protected string $label = 'Project';

    protected array $validationRules = [
        'tahun' => 'required|string|max:20',
        'status' => 'nullable|string|in:draft,published,archived',
        'urutan' => 'nullable|integer',
        'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
        'deskripsi_singkat' => 'required|string',
        'deskripsi' => 'required|string',
        'lokasi' => 'required|string|max:255',
        'icon' => 'nullable|string|max:100',
        'ruang_lingkup' => 'nullable|string|max:255',
        'status_proyek' => 'nullable|string|max:100',
        'timeline' => 'required|string',
    ];

    protected ?string $imageField = 'gambar_utama';

    protected ?string $imagePath = 'proyek';

    public function create()
    {
        $mitras = Mitra::query()->with('translations')->where('status', true)->orderBy('urutan', 'asc')->get();

        return view($this->viewPrefix.'.create', $this->viewData([
            'mitras' => $mitras,
        ]));
    }

    public function edit($id)
    {
        $item = Proyek::query()->with([
            'translations' => fn ($q) => $q->orderBy('id', 'asc'),
            'translations.tujuan' => fn ($q) => $q->orderBy('urutan', 'asc'),
            'translations.dampak_capaian' => fn ($q) => $q->orderBy('urutan', 'asc'),
            'translations.kegiatan_utama' => fn ($q) => $q->orderBy('urutan', 'asc'),
            'translations.linimasa_proyek' => fn ($q) => $q->orderBy('urutan', 'asc'),
            'mitra',
            'galeri',
        ])->findOrFail($id);

        $mitras = Mitra::query()->with('translations')->where('status', true)->orderBy('urutan', 'asc')->get();

        return view($this->viewPrefix.'.edit', $this->viewData([
            'proyek' => $item,
            'mitras' => $mitras,
        ]));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->buildValidationRules(false));

        $item = $this->model::create(array_merge(
            $this->neutralData($validated, $request),
            $this->extraData($request, true),
            $this->uploadedImage($request)
        ));

        // Sync Mitra
        $item->mitra()->sync($request->input('mitra_ids', []));

        // Save Translations & Sub-items
        if ($request->has('translations')) {
            $this->saveProjectTranslations($item, (array) $request->input('translations', []));
        }

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' added successfully');
    }

    public function update(Request $request, $id)
    {
        $item = $this->model::query()->findOrFail($id);

        $validated = $request->validate($this->buildValidationRules(true));

        $item->update(array_merge(
            $this->neutralData($validated, $request),
            $this->extraData($request, false),
            $this->uploadedImage($request, $item)
        ));

        // Sync Mitra
        $item->mitra()->sync($request->input('mitra_ids', []));

        // Save Translations & Sub-items
        if ($request->has('translations')) {
            $this->saveProjectTranslations($item, (array) $request->input('translations', []));
        }

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' updated successfully');
    }

    protected function saveProjectTranslations(Proyek $proyek, array $translations): void
    {
        foreach ($translations as $kode => $transData) {
            $trans = $proyek->translations()->updateOrCreate(
                ['bahasa' => $kode],
                [
                    'judul' => $transData['judul'] ?? '',
                    'kategori' => $transData['kategori'] ?? '',
                    'deskripsi_singkat' => $transData['deskripsi_singkat'] ?? '',
                    'deskripsi' => $transData['deskripsi'] ?? '',
                    'lokasi' => $transData['lokasi'] ?? '',
                    'icon' => !empty($transData['icon']) ? $transData['icon'] : 'fa-solid fa-film',
                    'ruang_lingkup' => $transData['ruang_lingkup'] ?? '',
                    'status_proyek' => $transData['status_proyek'] ?? '',
                    'timeline' => $transData['timeline'] ?? '',
                ]
            );

            // Save Sub-sections
            $this->saveTranslationSubItems($trans, $transData);
        }
    }

    protected function saveTranslationSubItems(ProyekTranslation $trans, array $data): void
    {
        // 1. Tujuan
        if (isset($data['tujuan']) && is_array($data['tujuan'])) {
            $trans->tujuan()->delete();
            $urutan = 1;
            foreach ($data['tujuan'] as $item) {
                if (!empty($item['deskripsi'])) {
                    $trans->tujuan()->create([
                        'icon' => !empty($item['icon']) ? $item['icon'] : 'fa-solid fa-handshake',
                        'deskripsi' => $item['deskripsi'],
                        'urutan' => $urutan++,
                        'status' => true,
                    ]);
                }
            }
        }

        // 2. Dampak Capaian
        if (isset($data['dampak_capaian']) && is_array($data['dampak_capaian'])) {
            $trans->dampak_capaian()->delete();
            $urutan = 1;
            foreach ($data['dampak_capaian'] as $item) {
                if (!empty($item['deskripsi']) || !empty($item['total_capaian'])) {
                    $trans->dampak_capaian()->create([
                        'icon' => !empty($item['icon']) ? $item['icon'] : 'fa-solid fa-handshake',
                        'total_capaian' => $item['total_capaian'] ?? '',
                        'deskripsi' => $item['deskripsi'] ?? '',
                        'urutan' => $urutan++,
                        'status' => true,
                    ]);
                }
            }
        }

        // 3. Kegiatan Utama
        if (isset($data['kegiatan_utama']) && is_array($data['kegiatan_utama'])) {
            $trans->kegiatan_utama()->delete();
            $urutan = 1;
            foreach ($data['kegiatan_utama'] as $item) {
                if (!empty($item['deskripsi'])) {
                    $trans->kegiatan_utama()->create([
                        'icon' => !empty($item['icon']) ? $item['icon'] : 'fa-solid fa-handshake',
                        'deskripsi' => $item['deskripsi'],
                        'urutan' => $urutan++,
                        'status' => true,
                    ]);
                }
            }
        }

        // 4. Linimasa Proyek
        if (isset($data['linimasa_proyek']) && is_array($data['linimasa_proyek'])) {
            $trans->linimasa_proyek()->delete();
            $urutan = 1;
            foreach ($data['linimasa_proyek'] as $item) {
                if (!empty($item['deskripsi']) || !empty($item['tahun'])) {
                    $trans->linimasa_proyek()->create([
                        'tahun' => $item['tahun'] ?? '',
                        'deskripsi' => $item['deskripsi'] ?? '',
                        'urutan' => $urutan++,
                        'status' => true,
                    ]);
                }
            }
        }
    }

    public function toggleStatus($id)
    {
        $proyek = Proyek::findOrFail($id);
        $proyek->status = $proyek->status === 'published' ? 'draft' : 'published';
        $proyek->save();

        return response()->json(['success' => true]);
    }

    protected function extraData(Request $request, bool $creating): array
    {
        if (! $creating) {
            return [];
        }

        $defaultKode = Bahasa::defaultKode();

        return ['slug' => Str::slug($request->input("translations.$defaultKode.judul", '')).'-'.time()];
    }

    protected function beforeDelete(Model $item): array
    {
        return $item->galeri
            ->filter(fn ($galeri) => $galeri->gambar !== null)
            ->map(fn ($galeri) => 'proyek/galeri/'.$galeri->gambar)
            ->all();
    }
}

