<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Bahasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class BahasaApiController extends BaseApiController
{
    protected $model = Bahasa::class;

    protected array $validationRules = [
        'kode' => 'required|string|max:5|alpha_dash',
        'nama' => 'required|string|max:50',
        'aktif' => 'nullable|boolean',
        'is_default' => 'nullable|boolean',
    ];

    /**
     * List semua bahasa terdaftar.
     */
    public function index()
    {
        $bahasas = Bahasa::query()
            ->orderByDesc('is_default')
            ->orderBy('nama')
            ->get();

        return $this->successResponse($bahasas);
    }

    /**
     * Tambah bahasa baru (contoh: jp). Setelah ini semua tabel konten
     * otomatis bisa menerima translations untuk kode tersebut.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $request->only(['kode', 'nama', 'aktif', 'is_default']);
        $data['aktif'] = $request->boolean('aktif', true);
        $data['is_default'] = $request->boolean('is_default', false);

        if ($data['is_default']) {
            Bahasa::query()->update(['is_default' => false]);
        } elseif (! Bahasa::query()->where('is_default', true)->exists()) {
            $data['is_default'] = true;
        }

        $bahasa = Bahasa::create($data);

        return $this->successResponse($bahasa, 'Language created successfully', 201);
    }

    public function show($kode)
    {
        $bahasa = Bahasa::find($kode);

        if (! $bahasa) {
            return $this->notFoundResponse('Language not found');
        }

        return $this->successResponse($bahasa);
    }

    /**
     * Update bahasa (nama, status aktif, atau jadikan default).
     * Kode tidak boleh diubah karena menjadi kunci relasi translations.
     */
    public function update(Request $request, $kode)
    {
        $bahasa = Bahasa::find($kode);

        if (! $bahasa) {
            return $this->notFoundResponse('Language not found');
        }

        $validator = validator($request->all(), [
            'nama' => 'sometimes|required|string|max:50',
            'aktif' => 'nullable|boolean',
            'is_default' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        if ($request->has('is_default') && $request->boolean('is_default')) {
            Bahasa::query()->update(['is_default' => false]);
            $bahasa->is_default = true;
        }

        $bahasa->fill($request->only(['nama', 'aktif']));

        if ($request->has('aktif')) {
            if (! $request->boolean('aktif') && $bahasa->is_default) {
                return $this->errorResponse('Default language cannot be deactivated', 422);
            }
            $bahasa->aktif = $request->boolean('aktif');
        }

        $bahasa->save();

        return $this->successResponse($bahasa, 'Language updated successfully');
    }

    /**
     * Hapus bahasa. Translations terkait ikut terhapus via FK cascade.
     * Bahasa default tidak boleh dihapus.
     */
    public function destroy($kode)
    {
        $bahasa = Bahasa::find($kode);

        if (! $bahasa) {
            return $this->notFoundResponse('Language not found');
        }

        if ($bahasa->is_default) {
            return $this->errorResponse('Default language cannot be deleted. Please set another language as default first.', 422);
        }

        $bahasa->delete();

        return $this->successResponse(null, 'Language deleted successfully');
    }

    public function toggleStatus($kode)
    {
        $bahasa = Bahasa::find($kode);

        if (! $bahasa) {
            return $this->notFoundResponse();
        }

        if ($bahasa->is_default && $bahasa->aktif) {
            return $this->errorResponse('Default language cannot be deactivated', 422);
        }

        $bahasa->aktif = ! $bahasa->aktif;
        $bahasa->save();

        return $this->successResponse([
            'kode' => $bahasa->kode,
            'aktif' => $bahasa->aktif,
        ], 'Status updated successfully');
    }

    /**
     * Pengaturan ringkas: bahasa default + daftar bahasa aktif.
     */
    public function getSettings()
    {
        return $this->successResponse([
            'default' => Bahasa::defaultKode(),
            'available' => Bahasa::activeLanguages()->map(fn ($b) => [
                'kode' => $b->kode,
                'nama' => $b->nama,
                'is_default' => $b->is_default,
            ]),
        ]);
    }

    /**
     * Daftar bahasa aktif (untuk form admin dan konsumsi publik).
     */
    public function getAvailableLanguages()
    {
        return $this->successResponse(
            Bahasa::activeLanguages()->map(fn ($b) => [
                'kode' => $b->kode,
                'nama' => $b->nama,
                'is_default' => $b->is_default,
            ])
        );
    }

    /**
     * Set bahasa default baru.
     */
    public function setDefault($kode)
    {
        $bahasa = Bahasa::find($kode);

        if (! $bahasa) {
            return $this->notFoundResponse('Language not found');
        }

        Bahasa::query()->update(['is_default' => false]);
        $bahasa->update(['is_default' => true, 'aktif' => true]);

        return $this->successResponse($bahasa, 'Default language updated successfully');
    }

    public function switchLanguage($locale)
    {
        $bahasa = Bahasa::query()
            ->where('kode', $locale)
            ->where('aktif', true)
            ->first();

        if (! $bahasa) {
            return $this->errorResponse('Invalid language', 400);
        }

        Session::put('locale', $bahasa->kode);
        App::setLocale($bahasa->kode);

        return $this->successResponse([
            'locale' => $bahasa->kode,
            'message' => 'Language switched successfully',
        ]);
    }
}
