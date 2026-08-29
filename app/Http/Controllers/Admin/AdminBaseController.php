<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bahasa;
use App\Traits\HasTranslations;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

abstract class AdminBaseController extends Controller
{
    protected string $model;

    /** Prefix view, cth: 'admin.beranda'. */
    protected string $viewPrefix;

    /** Prefix nama route resource, cth: 'admin.beranda'. */
    protected string $routeName;

    protected string $label;

    /**
     * Validasi field netral (tidak tergantung bahasa).
     */
    protected array $validationRules = [];

    protected array $updateValidationRules = [];

    /**
     * Validasi field terjemahan.
     * Diterapkan otomatis ke translations.{kode}.{field} untuk semua bahasa
     * yang dikirim. Field 'required' wajib diisi pada bahasa default saat create.
     * Menambah bahasa baru cukup insert ke tabel bahasa tanpa ubah kode ini.
     */
    protected array $translatableRules = [];

    protected ?string $imageField = null;

    protected ?string $imagePath = null;

    protected string $indexOrderColumn = 'urutan';

    protected string $indexOrderDirection = 'asc';

    public function __construct()
    {
        //
    }

    public function index()
    {
        $instance = new $this->model;
        $orderCol = $this->indexOrderColumn;
        if (! \Illuminate\Support\Facades\Schema::hasColumn($instance->getTable(), $orderCol)) {
            $orderCol = $instance->getKeyName() ?? 'id';
        }

        $items = $this->model::query()
            ->orderBy($orderCol, $this->indexOrderDirection)
            ->get();

        return view($this->viewPrefix.'.index', $this->viewData(['items' => $items]));
    }

    public function create()
    {
        return view($this->viewPrefix.'.create', $this->viewData());
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->buildValidationRules(false));

        $item = $this->model::create(array_merge(
            $this->neutralData($validated, $request),
            $this->extraData($request, true),
            $this->uploadedImage($request)
        ));

        if ($this->usesTranslations()) {
            $item->storeTranslations((array) $request->input('translations', []));
        }

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' added successfully');
    }

    public function edit($id)
    {
        $item = $this->model::query()->findOrFail($id);

        return view($this->viewPrefix.'.edit', $this->viewData(['item' => $item]));
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

        if ($this->usesTranslations() && $request->has('translations')) {
            $item->storeTranslations((array) $request->input('translations', []));
        }

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' updated successfully');
    }

    public function destroy($id)
    {
        $item = $this->model::query()->findOrFail($id);

        if ($this->imageField && $item->{$this->imageField}) {
            Storage::disk('public')->delete($this->imagePath.'/'.$item->{$this->imageField});
        }

        foreach ($this->beforeDelete($item) as $file) {
            Storage::disk('public')->delete($file);
        }

        $item->delete();

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' deleted successfully');
    }

    public function toggleStatus($id)
    {
        $item = $this->model::query()->findOrFail($id);
        $item->status = ! $item->status;
        $item->save();

        return response()->json(['success' => true]);
    }

    protected function usesTranslations(): bool
    {
        if (empty($this->model)) {
            return false;
        }

        return in_array(HasTranslations::class, class_uses_recursive($this->model));
    }

    /**
     * Gabungkan validasi field netral + validasi per-bahasa.
     */
    protected function buildValidationRules(bool $forUpdate): array
    {
        $rules = $forUpdate && $this->updateValidationRules !== []
            ? $this->updateValidationRules
            : $this->validationRules;

        if (! $this->usesTranslations()) {
            return $this->withImageRule($rules);
        }

        $rules['translations'] = $forUpdate
            ? ['nullable', 'array', $this->registeredBahasaRule()]
            : ['required', 'array', 'min:1', $this->registeredBahasaRule()];

        foreach ($this->translatableRules as $field => $rule) {
            $rules["translations.*.$field"] = $this->optionalizedRule($rule);
        }

        if (! $forUpdate) {
            $defaultKode = Bahasa::defaultKode();

            foreach ($this->translatableRules as $field => $rule) {
                if (str_contains($rule, 'required')) {
                    $rules["translations.$defaultKode.$field"] = $rule;
                }
            }
        }

        return $this->withImageRule($rules);
    }

    /**
     * Fallback keamanan: field gambar selalu divalidasi tipe & ukuran,
     * meski subclass lupa mendefinisikan rule-nya.
     */
    protected function withImageRule(array $rules): array
    {
        if ($this->imageField && empty($rules[$this->imageField])) {
            $rules[$this->imageField] = 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048';
        }

        return $rules;
    }

    protected function registeredBahasaRule(): Closure
    {
        return function (string $attribute, mixed $value, Closure $fail) {
            foreach (array_keys((array) $value) as $kode) {
                if (! Bahasa::query()->where('kode', $kode)->exists()) {
                    $fail("Language '{$kode}' is not registered in the languages table.");
                }
            }
        };
    }

    protected function optionalizedRule(string $rule): string
    {
        $parts = array_filter(
            explode('|', $rule),
            fn (string $part) => $part !== '' && ! str_starts_with($part, 'required')
        );

        return $parts === [] ? 'nullable' : implode('|', $parts);
    }

    /**
     * Buang translations & file dari payload field netral.
     */
    protected function neutralData(array $validated, ?Request $request = null): array
    {
        unset($validated['translations']);

        if ($this->imageField) {
            unset($validated[$this->imageField]);
        }

        if ($request && (array_key_exists('status', $this->validationRules) || array_key_exists('status', $this->updateValidationRules))) {
            $rule = (string) ($this->validationRules['status'] ?? $this->updateValidationRules['status'] ?? '');
            if (str_contains($rule, 'boolean')) {
                $validated['status'] = $request->boolean('status');
            }
        }

        return $validated;
    }

    /**
     * Upload gambar (jika ada) dan hapus file lama saat update.
     * Nama file dibangkitkan acak (hashName); ekstensi dari nama file
     * klien tidak dipercaya.
     */
    protected function uploadedImage(Request $request, ?Model $item = null): array
    {
        if (! $this->imageField || ! $request->hasFile($this->imageField)) {
            return [];
        }

        $path = $request->file($this->imageField)->store($this->imagePath, 'public');

        if ($item && $item->{$this->imageField}) {
            Storage::disk('public')->delete($this->imagePath.'/'.$item->{$this->imageField});
        }

        return [$this->imageField => basename($path)];
    }

    /**
     * Hook: field netral tambahan, cth slug otomatis.
     */
    protected function extraData(Request $request, bool $creating): array
    {
        return [];
    }

    /**
     * Hook: daftar path file tambahan yang ikut dihapus saat delete, cth file galeri.
     */
    protected function beforeDelete(Model $item): array
    {
        return [];
    }

    /**
     * AJAX: Hapus gambar dari record tanpa menghapus record itu sendiri.
     */
    public function deleteImage(Request $request)
    {
        $request->validate([
            'model' => 'required|string',
            'id' => 'required|integer',
            'field' => 'required|string',
        ]);

        $modelClass = 'App\\Models\\' . $request->input('model');
        if (! class_exists($modelClass)) {
            return response()->json(['success' => false, 'message' => 'Model not found.'], 404);
        }

        $item = $modelClass::find($request->input('id'));
        if (! $item) {
            return response()->json(['success' => false, 'message' => 'Data not found.'], 404);
        }

        $field = $request->input('field');
        $filename = $item->{$field} ?? null;

        if (! $filename) {
            return response()->json(['success' => false, 'message' => 'No image to delete.'], 404);
        }

        $imagePathMap = [
            'BannerHalaman' => 'banners',
            'Berita' => 'berita',
            'BeritaGaleri' => 'berita/galeri',
            'Mitra' => 'mitra',
            'MitraIntro' => 'mitra',
            'Program' => 'program',
            'ProgramRoadmap' => 'program',
            'Proyek' => 'proyek',
            'ProyekGaleri' => 'proyek/galeri',
            'Stakeholder' => 'stakeholder',
            'StrukturOrganisasi' => 'struktur',
            'Tentang' => 'tentang',
            'Beranda' => 'beranda',
        ];

        $modelBasename = class_basename($modelClass);
        $imagePath = $imagePathMap[$modelBasename] ?? null;

        if ($imagePath) {
            Storage::disk('public')->delete($imagePath . '/' . $filename);
        }

        $item->{$field} = null;
        $item->save();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }

    /**
     * Data bawaan untuk semua view: daftar bahasa aktif.
     */
    protected function viewData(array $merge = []): array
    {
        return array_merge(['bahasas' => Bahasa::activeLanguages()], $merge);
    }
}
