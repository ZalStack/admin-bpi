<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Melindungi endpoint mutasi API (POST/PUT/PATCH/DELETE).
 * GET tetap publik untuk konsumsi frontend; kontak-form POST
 * juga tetap terbuka karena dipakai form kontak situs publik.
 */
class EnsureApiMutationAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isPublicSubmission($request)) {
            return $next($request);
        }

        // Pesan kontak bersifat privat: selain pengiriman (POST),
        // semua endpoint kontak-form wajib login.
        if ($request->is('api/admin/v1/kontak-form*') && ! Auth::check()) {
            return $this->deny();
        }

        if ($request->isMethodSafe()) {
            return $next($request);
        }

        if (! Auth::check()) {
            return $this->deny();
        }

        return $next($request);
    }

    protected function deny(): Response
    {
        return response()->json([
            'success' => false,
            'message' => 'Unauthenticated.',
        ], 401);
    }

    /**
     * Mutasi publik: form kontak situs dan ganti bahasa pengunjung
     * (hanya menulis locale ke session, tervalidasi terhadap bahasa aktif).
     */
    protected function isPublicSubmission(Request $request): bool
    {
        if ($request->isMethod('POST') && $request->is('api/admin/v1/kontak-form')) {
            return true;
        }

        return $request->is('api/admin/v1/bahasa/switch/*');
    }
}
