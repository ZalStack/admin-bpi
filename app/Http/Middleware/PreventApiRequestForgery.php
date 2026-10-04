<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;

/**
 * Proteksi CSRF untuk mutasi API yang diautentikasi lewat session.
 * Dijalankan setelah EnsureApiMutationAuth, sehingga request tanpa
 * login tetap mendapat 401. Request same-origin (CMS) lolos lewat
 * header Sec-Fetch-Site; klien lain wajib mengirim X-CSRF-TOKEN
 * atau X-XSRF-TOKEN.
 */
class PreventApiRequestForgery extends PreventRequestForgery
{
    /**
     * Mutasi publik yang dipakai situs frontend (lihat EnsureApiMutationAuth).
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/admin/v1/kontak-form',
        'api/admin/v1/bahasa/switch/*',
    ];

    /**
     * Jangan tempelkan cookie XSRF-TOKEN ke setiap response API publik.
     *
     * @var bool
     */
    protected $addHttpCookie = false;
}
