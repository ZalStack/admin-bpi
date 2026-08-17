<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\BannerHalaman;

class BannerApiController extends BaseApiController
{
    protected $model = BannerHalaman::class;
    protected $imageField = 'gambar';
    protected $imagePath = 'banners';

    protected $validationRules = [
        'halaman' => 'required|string|max:50',
        'judul_id' => 'required|string|max:255',
        'judul_en' => 'required|string|max:255',
        'deskripsi_id' => 'required|string',
        'deskripsi_en' => 'required|string',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status' => 'boolean'
    ];

    protected $updateValidationRules = [
        'halaman' => 'required|string|max:50',
        'judul_id' => 'required|string|max:255',
        'judul_en' => 'required|string|max:255',
        'deskripsi_id' => 'required|string',
        'deskripsi_en' => 'required|string',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status' => 'boolean'
    ];
}
