<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontenHalaman;
use App\Traits\ApiResponseTrait;

class KontenHalamanApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * Teks statis satu halaman, dalam bentuk { kunci: { bahasa: nilai } }.
     * Contoh: { "struktur.judul": { "id": "Struktur Organisasi Kami", "en": "..." } }
     */
    public function getByHalaman(string $halaman)
    {
        $items = KontenHalaman::query()
            ->with('translations')
            ->where('halaman', $halaman)
            ->orderBy('urutan')
            ->get();

        $data = [];
        foreach ($items as $item) {
            $data[$item->kunci] = $item->translations
                ->mapWithKeys(fn ($t) => [$t->bahasa => $t->nilai])
                ->all();
        }

        return $this->successResponse((object) $data);
    }
}
