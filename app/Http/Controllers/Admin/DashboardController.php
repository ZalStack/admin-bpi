<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bahasa;
use App\Models\BannerHalaman;
use App\Models\Beranda;
use App\Models\Program;
use App\Models\Proyek;
use App\Models\Stakeholder;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $totalBanner = BannerHalaman::count();
        $totalBeranda = Beranda::count();
        $totalBahasa = Bahasa::where('aktif', true)->count();
        $totalStakeholder = Stakeholder::count();
        $totalProgram = Program::count();
        $totalProyek = Proyek::count();

        $recentBanners = BannerHalaman::orderBy('created_at', 'desc')->limit(5)->get();
        $recentBerandas = Beranda::orderBy('created_at', 'desc')->limit(5)->get();
        $recentProyeks = Proyek::with('translations')->orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalBanner',
            'totalBeranda',
            'totalBahasa',
            'totalStakeholder',
            'totalProgram',
            'totalProyek',
            'recentBanners',
            'recentBerandas',
            'recentProyeks'
        ));
    }
}
