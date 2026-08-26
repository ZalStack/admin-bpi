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
use Illuminate\Support\Facades\Cache;

class DashboardApiController extends BaseApiController
{
    /**
     * Get dashboard statistics with caching (60 seconds TTL).
     */
    public function stats()
    {
        $data = Cache::remember('dashboard_stats', 60, function () {
            return [
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
        });

        return $this->successResponse($data);
    }

    /**
     * Get recent activities with caching (120 seconds TTL).
     */
    public function recent()
    {
        $data = Cache::remember('dashboard_recent', 120, function () {
            return [
                'recent_banners' => BannerHalaman::with('translations')->orderBy('created_at', 'desc')->limit(5)->get(),
                'recent_berandas' => Beranda::with('translations')->orderBy('created_at', 'desc')->limit(5)->get(),
                'recent_proyeks' => Proyek::with('translations')->orderBy('created_at', 'desc')->limit(5)->get(),
                'recent_beritas' => Berita::with('translations')->orderBy('created_at', 'desc')->limit(5)->get(),
                'recent_pesan' => KontakForm::orderBy('created_at', 'desc')->limit(5)->get(),
            ];
        });

        return $this->successResponse($data);
    }
}
