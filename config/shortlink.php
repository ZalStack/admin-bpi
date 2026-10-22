<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Base URL Shortlink
    |--------------------------------------------------------------------------
    |
    | Domain landing page publik (frontend Next.js) yang melayani redirect
    | {base_url}/{kode}. Shortlink & QR Code hanya dikelola di CMS; landing page
    | me-resolve kode lewat GET /api/admin/v1/shortlink/resolve/{kode}.
    |
    | Saat domain landing pindah (mis. ke https://bpi.or.id), cukup ubah env ini.
    | QR yang sudah dicetak tetap meng-encode domain lama, jadi domain lama
    | harus tetap me-redirect path-nya ke domain baru.
    |
    */

    'base_url' => rtrim((string) env('SHORTLINK_BASE_URL', 'http://localhost:3000'), '/'),

    // Panjang kode acak saat kode dikosongkan.
    'kode_length' => 6,

    /*
    |--------------------------------------------------------------------------
    | Kode Terlarang
    |--------------------------------------------------------------------------
    |
    | Path satu segmen yang sudah dipakai landing page (rute halaman, redirect
    | di next.config.ts, folder di public/). Rute & redirect tersebut diproses
    | Next.js lebih dulu, sehingga shortlink dengan kode yang sama tidak akan
    | pernah tercapai. WAJIB diperbarui setiap landing menambah halaman baru.
    |
    */

    'reserved' => [
        // Halaman landing (app/*)
        'about', 'contact', 'news', 'project', 'stakeholders',
        'privacy-policy', 'terms-conditions',
        // Redirect lama (next.config.ts)
        'mitra', 'program', 'tentang', 'proyek', 'berita', 'kontak',
        'kebijakan-privasi', 'syarat-ketentuan', 'terms-and-conditions',
        // Folder/asset publik & path sistem
        'struktur', 'api', 'admin', 'static', 'public', 'assets', 'images',
        'storage', 'sitemap', 'robots', 'favicon', 'login', 'dashboard',
    ],

];
