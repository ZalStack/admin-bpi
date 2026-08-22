<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bahasa;
use App\Traits\ApiResponseTrait;
use App\Traits\CrudOperationsTrait;
use App\Traits\HasTranslations;
use Closure;
use Illuminate\Http\Request;

class BaseApiController extends Controller
{
    use ApiResponseTrait, CrudOperationsTrait;

    protected $model;

    protected $modelName;

    /**
     * Validasi field netral (tidak tergantung bahasa).
     */
    protected array $validationRules = [];

    protected array $updateValidationRules = [];

    /**
     * Validasi field terjemahan.
     * Otomatis diterapkan ke setiap bahasa yang dikirim:
     * translations.{bahasa}.{field}.
     * Field dengan rule 'required' wajib diisi pada bahasa default saat create.
     */
    protected array $translatableRules = [];

    protected array $withRelations = [];

    protected ?string $imageField = null;

    protected ?string $imagePath = null;

    protected array $searchFields = [];

    protected array $orderBy = ['created_at' => 'desc'];

    public function __construct()
    {
        if ($this->usesTranslations()) {
            $this->withRelations[] = 'translations';
        }
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
            : ($forUpdate
                ? array_map(fn (string $rule) => $this->optionalizedRule($rule), $this->validationRules)
                : $this->validationRules);

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

    /**
     * Setiap key bahasa pada payload harus terdaftar di tabel bahasa.
     * Menambah bahasa baru cukup insert data, tanpa ubah validasi.
     */
    protected function registeredBahasaRule(): Closure
    {
        return function (string $attribute, mixed $value, Closure $fail) {
            foreach (array_keys((array) $value) as $kode) {
                if (! Bahasa::query()->where('kode', $kode)->exists()) {
                    $fail("Bahasa '{$kode}' tidak terdaftar pada tabel bahasa.");
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
     * Index - Get all resources
     */
    public function index()
    {
        return $this->getAll($this->model, $this->withRelations, $this->orderBy);
    }

    /**
     * Show - Get single resource
     */
    public function show($id)
    {
        return $this->getById($this->model, $id, $this->withRelations);
    }

    /**
     * Store - Create resource beserta translations-nya.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->buildValidationRules(false));

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $this->neutralData($request);

        if ($this->imageField && $request->hasFile($this->imageField)) {
            $data[$this->imageField] = $this->uploadFile(
                $request->file($this->imageField),
                $this->imagePath
            );
        }

        $resource = $this->model::create($data);

        if ($this->usesTranslations()) {
            $resource->storeTranslations((array) $request->input('translations', []));
            $resource->load('translations');
        }

        return $this->successResponse($resource, ucfirst(class_basename($resource)).' created successfully', 201);
    }

    /**
     * Update - Update resource dan sinkronisasi translations.
     * Translations bersifat upsert per bahasa; bahasa lain tidak ikut dikirim tidak akan dihapus.
     */
    public function update(Request $request, $id)
    {
        $resource = $this->model::find($id);

        if (! $resource) {
            return $this->notFoundResponse();
        }

        $validator = validator($request->all(), $this->buildValidationRules(true));

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $this->neutralData($request);

        if ($this->imageField && $request->hasFile($this->imageField)) {
            $oldFile = $resource->{$this->imageField};
            $data[$this->imageField] = $this->uploadFile(
                $request->file($this->imageField),
                $this->imagePath,
                $oldFile
            );
        }

        $resource->update($data);

        if ($this->usesTranslations() && $request->has('translations')) {
            $resource->storeTranslations((array) $request->input('translations', []));
        }

        return $this->successResponse($resource->fresh($this->withRelations), ucfirst(class_basename($resource)).' updated successfully');
    }

    /**
     * Destroy - Delete resource (translations ikut terhapus via FK cascade).
     */
    public function destroy($id)
    {
        $resource = $this->model::find($id);

        if (! $resource) {
            return $this->notFoundResponse();
        }

        if ($this->imageField && $resource->{$this->imageField}) {
            $this->deleteFile($this->imagePath, $resource->{$this->imageField});
        }

        return $this->deleteResource($this->model, $id);
    }

    /**
     * Toggle status boolean.
     */
    public function toggleStatus($id)
    {
        $resource = $this->model::find($id);

        if (! $resource) {
            return $this->notFoundResponse();
        }

        $resource->status = ! $resource->status;
        $resource->save();

        return $this->successResponse([
            'id' => $resource->id,
            'status' => $resource->status,
        ], 'Status updated successfully');
    }

    /**
     * Ambil hanya field netral dari request (buang translations & file).
     */
    protected function neutralData(Request $request): array
    {
        $exclude = ['translations'];

        if ($this->imageField) {
            $exclude[] = $this->imageField;
        }

        return $request->except($exclude);
    }

    /**
     * Get semua resource aktif diurutkan berdasarkan urutan.
     */
    public function getActive()
    {
        $resources = $this->model::query()
            ->when(! empty($this->withRelations), fn ($q) => $q->with($this->withRelations))
            ->where('status', true)
            ->orderBy('urutan', 'asc')
            ->get();

        return $this->successResponse($resources);
    }

    /**
     * Update urutan banyak sekaligus: { urutan: [{id, urutan}, ...] }.
     */
    public function updateUrutan(Request $request)
    {
        $table = (new $this->model)->getTable();

        $validator = validator($request->all(), [
            'urutan' => 'required|array',
            'urutan.*.id' => "required|exists:{$table},id",
            'urutan.*.urutan' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        foreach ($request->input('urutan') as $item) {
            $this->model::query()->where('id', $item['id'])->update(['urutan' => $item['urutan']]);
        }

        return $this->successResponse(null, 'Urutan updated successfully');
    }
}
