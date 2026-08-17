<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\BannerHalaman;
use App\Models\Beranda;
use App\Models\PengaturanBahasa;
use App\Models\Stakeholder;
use App\Models\Program;
use App\Models\Proyek;
use App\Models\Berita;
use App\Models\Mitra;
use App\Models\KontakForm;

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
            'total_bahasa' => PengaturanBahasa::count(),
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
            'recent_banners' => BannerHalaman::orderBy('created_at', 'desc')->limit(5)->get(),
            'recent_berandas' => Beranda::orderBy('created_at', 'desc')->limit(5)->get(),
            'recent_proyeks' => Proyek::orderBy('created_at', 'desc')->limit(5)->get(),
            'recent_beritas' => Berita::orderBy('created_at', 'desc')->limit(5)->get(),
            'recent_pesan' => KontakForm::orderBy('created_at', 'desc')->limit(5)->get(),
        ];

        return $this->successResponse($data);
    }
}
