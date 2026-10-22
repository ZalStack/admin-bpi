<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shortlink;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Satu-satunya endpoint shortlink di API: dipakai landing page untuk
 * me-resolve {base_url}/{kode}. Sengaja tidak ada endpoint list/detail,
 * karena GET di API ini publik dan daftar URL tujuan bersifat internal.
 */
class ShortlinkApiController extends Controller
{
    use ApiResponseTrait;

    public function resolve(string $kode): JsonResponse
    {
        $shortlink = Shortlink::query()
            ->where('kode', Shortlink::normalizeKode($kode))
            ->where('status', true)
            ->first(['id', 'url_tujuan']);

        if (! $shortlink) {
            return $this->notFoundResponse('Shortlink not found');
        }

        // Query builder: increment atomik tanpa menyentuh updated_at.
        DB::table('shortlink')->where('id', $shortlink->id)->increment('jumlah_klik', 1, [
            'terakhir_diklik_at' => now(),
        ]);

        return $this->successResponse(['url' => $shortlink->url_tujuan]);
    }
}
