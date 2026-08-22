<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Bahasa;
use App\Models\BannerHalaman;
use App\Models\Beranda;
use App\Models\Berita;
use App\Models\KontakForm;
use App\Models\Mitra;
use App\Models\Program;
use App\Models\Proyek;
use App\Models\Stakeholder;

class DashboardApiController extends BaseApiController
{
    /**
     * Get dashboard statistics
     */
    public function stats()
    {
        $data = [
            'total_banner' => BannerHalaman::count(),
            'total_beranda' => Beranda::count(),
            'total_bahasa' => Bahasa::where('aktif', true)->count(),
            'total_stakeholder' => Stakeholder::count(),
            'total_program' => Program::count(),
            'total_proyek' => Proyek::count(),
            'total_berita' => Berita::count(),
            'total_mitra' => Mitra::count(),
            'total_pesan_kontak' => KontakForm::count(),
        ];

        return $this->successResponse($data);
    }

    /**
     * Get recent activities
     */
    public function recent()
    {
        $data = [
            'recent_banners' => BannerHalaman::with('translations')->orderBy('created_at', 'desc')->limit(5)->get(),
            'recent_berandas' => Beranda::with('translations')->orderBy('created_at', 'desc')->limit(5)->get(),
            'recent_proyeks' => Proyek::with('translations')->orderBy('created_at', 'desc')->limit(5)->get(),
            'recent_beritas' => Berita::with('translations')->orderBy('created_at', 'desc')->limit(5)->get(),
            'recent_pesan' => KontakForm::orderBy('created_at', 'desc')->limit(5)->get(),
        ];

        return $this->successResponse($data);
    }
}
