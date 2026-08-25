@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Welcome Banner -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#520A18] via-[#821E38] to-[#132C5C] p-6 md:p-8 text-white shadow-[0_16px_40px_-16px_rgba(82,10,24,0.6)]">
        <div class="absolute -top-10 -right-10 h-48 w-48 rounded-full bg-[#E3DBAF]/10"></div>
        <div class="absolute -bottom-16 right-24 h-40 w-40 rounded-full bg-[#EBA9B0]/10"></div>
        <div class="absolute top-4 right-32 h-24 w-24 rounded-full bg-[#CAB988]/10"></div>
        <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-[#E3DBAF]/50 to-transparent"></div>
        <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <p class="text-sm font-medium tracking-wide text-[#E3DBAF]">Admin Panel BPI</p>
                <h1 class="mt-1 text-2xl md:text-3xl font-bold font-poppins tracking-tight">Selamat datang kembali, {{ Auth::user()->name }}!</h1>
                <p class="mt-2 text-sm text-white/75 font-poppins max-w-2xl">
                    Kelola konten website Badan Pengelolaan Indonesia dengan mudah dan cepat.
                </p>
            </div>
            <div class="flex flex-wrap gap-3 shrink-0">
                <a href="{{ route('admin.banner.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-white/10 ring-1 ring-inset ring-white/20 px-4 py-2.5 text-sm font-semibold backdrop-blur-sm transition-all hover:bg-white/20 hover:-translate-y-0.5">
                    <svg class="w-4.5 h-4.5 text-[#E3DBAF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Konten
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">
        @php
            $stats = [
                ['label' => 'Total Banner', 'value' => $totalBanner ?? 0, 'color' => '#520A18', 'accent' => 'from-[#520A18] to-[#68001C]', 'iconColor' => '#E3DBAF', 'route' => 'admin.banner.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>'],
                ['label' => 'Total Beranda', 'value' => $totalBeranda ?? 0, 'color' => '#132C5C', 'accent' => 'from-[#132C5C] to-[#2B4E94]', 'iconColor' => '#CAB988', 'route' => 'admin.beranda.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                ['label' => 'Total Stakeholder', 'value' => $totalStakeholder ?? 0, 'color' => '#A85C66', 'accent' => 'from-[#A85C66] to-[#CC707C]', 'iconColor' => '#FFFFFF', 'route' => 'admin.stakeholder.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>'],
                ['label' => 'Total Program', 'value' => $totalProgram ?? 0, 'color' => '#97763A', 'accent' => 'from-[#97763A] to-[#B09861]', 'iconColor' => '#FFFFFF', 'route' => 'admin.program.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>'],
                ['label' => 'Total Proyek', 'value' => $totalProyek ?? 0, 'color' => '#2B4E94', 'accent' => 'from-[#2B4E94] to-[#5876B0]', 'iconColor' => '#FFFFFF', 'route' => 'admin.proyek.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>'],
                ['label' => 'Pengaturan Bahasa', 'value' => $totalBahasa ?? 0, 'color' => '#8C4254', 'accent' => 'from-[#E58C97] to-[#EBA9B0]', 'iconColor' => '#520A18', 'route' => 'admin.bahasa.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>'],
            ];
        @endphp

        @foreach($stats as $stat)
            <div class="card card-hover group relative overflow-hidden p-5 md:p-6">
                <div class="absolute inset-x-0 top-0 h-0.5 bg-gradient-to-r {{ $stat['accent'] }} opacity-70"></div>
                <div class="flex items-center justify-between gap-3">
                    <div class="min-w-0">
                        <p class="stat-label font-poppins">{{ $stat['label'] }}</p>
                        <p class="stat-value font-poppins mt-1" style="color: {{ $stat['color'] }}">{{ $stat['value'] }}</p>
                    </div>
                    <div class="flex-shrink-0 bg-gradient-to-br {{ $stat['accent'] }} p-3 rounded-xl group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 shadow-md">
                        <svg class="w-6 h-6" style="color: {{ $stat['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $stat['icon'] !!}</svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-3">
                    <a href="{{ route($stat['route']) }}" class="link-arrow font-poppins">Lihat Semua</a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-5">
        @php
            $recentCards = [
                ['title' => 'Banner Terbaru', 'color' => '#520A18', 'route' => 'admin.banner.index', 'empty' => 'Belum ada banner', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>'],
            ];
        @endphp
        <!-- Recent Banners -->
        <div class="card card-hover p-5 md:p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-[0.95rem] font-bold text-[#520A18] font-poppins flex items-center gap-2.5">
                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-[#520A18]/[0.07] text-[#520A18]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </span>
                    Banner Terbaru
                </h2>
                <a href="{{ route('admin.banner.index') }}" class="link-arrow font-poppins">Lihat Semua</a>
            </div>
            @if($recentBanners && $recentBanners->count() > 0)
                <div class="space-y-2.5 max-h-80 overflow-y-auto pr-1">
                    @foreach($recentBanners as $banner)
                        <div class="flex items-center justify-between gap-3 rounded-xl border border-gray-100 bg-gray-50/60 p-3 transition-colors hover:bg-[#520A18]/[0.04]">
                            <div class="min-w-0 flex-1">
                                <p class="font-medium text-gray-800 font-poppins text-sm truncate">{{ Str::limit($banner->translateField('judul'), 25) }}</p>
                                <p class="text-xs text-gray-500 font-poppins truncate mt-0.5">{{ $banner->halaman }}</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="{{ $banner->status ? 'badge-active' : 'badge-inactive' }}">{{ $banner->status ? 'Active' : 'Inactive' }}</span>
                                <span class="text-xs text-gray-400 font-poppins">{{ $banner->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-500 font-poppins text-sm">Belum ada banner</p>
                </div>
            @endif
        </div>

        <!-- Recent Berandas -->
        <div class="card card-hover p-5 md:p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-[0.95rem] font-bold text-[#132C5C] font-poppins flex items-center gap-2.5">
                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-[#132C5C]/[0.07] text-[#132C5C]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </span>
                    Beranda Terbaru
                </h2>
                <a href="{{ route('admin.beranda.index') }}" class="link-arrow font-poppins">Lihat Semua</a>
            </div>
            @if($recentBerandas && $recentBerandas->count() > 0)
                <div class="space-y-2.5 max-h-80 overflow-y-auto pr-1">
                    @foreach($recentBerandas as $beranda)
                        <div class="flex items-center justify-between gap-3 rounded-xl border border-gray-100 bg-gray-50/60 p-3 transition-colors hover:bg-[#132C5C]/[0.04]">
                            <div class="min-w-0 flex-1">
                                <p class="font-medium text-gray-800 font-poppins text-sm truncate">{{ Str::limit($beranda->translateField('judul'), 25) }}</p>
                                <p class="text-xs text-gray-500 font-poppins truncate mt-0.5">Section: {{ $beranda->section }}</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="text-xs text-gray-400 font-poppins">#{{ $beranda->urutan }}</span>
                                <span class="{{ $beranda->status ? 'badge-active' : 'badge-inactive' }}">{{ $beranda->status ? 'Active' : 'Inactive' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-gray-500 font-poppins text-sm">Belum ada data beranda</p>
                </div>
            @endif
        </div>

        <!-- Recent Proyeks -->
        <div class="card card-hover p-5 md:p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-[0.95rem] font-bold text-[#2B4E94] font-poppins flex items-center gap-2.5">
                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-[#2B4E94]/[0.07] text-[#2B4E94]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </span>
                    Proyek Terbaru
                </h2>
                <a href="{{ route('admin.proyek.index') }}" class="link-arrow font-poppins">Lihat Semua</a>
            </div>
            @if($recentProyeks && $recentProyeks->count() > 0)
                <div class="space-y-2.5 max-h-80 overflow-y-auto pr-1">
                    @foreach($recentProyeks as $proyek)
                        <div class="flex items-center justify-between gap-3 rounded-xl border border-gray-100 bg-gray-50/60 p-3 transition-colors hover:bg-[#2B4E94]/[0.04]">
                            <div class="min-w-0 flex-1">
                                <p class="font-medium text-gray-800 font-poppins text-sm truncate">{{ Str::limit($proyek->translateField('judul'), 25) }}</p>
                                <p class="text-xs text-gray-500 font-poppins truncate mt-0.5">{{ $proyek->translateField('kategori') }}</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="{{ $proyek->status == 'published' ? 'badge-published' : 'badge-draft' }}">{{ $proyek->status == 'published' ? 'Published' : 'Draft' }}</span>
                                <span class="text-xs text-gray-400 font-poppins">{{ $proyek->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <p class="text-gray-500 font-poppins text-sm">Belum ada proyek</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div>
        <h2 class="section-label font-poppins mb-4">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Aksi Cepat
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">
            <a href="{{ route('admin.banner.create') }}" class="group relative overflow-hidden bg-gradient-to-r from-[#520A18] to-[#68001C] text-white p-5 rounded-2xl shadow-[0_8px_24px_-10px_rgba(82,10,24,0.6)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_16px_40px_-12px_rgba(82,10,24,0.7)] font-poppins">
                <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/40 to-transparent"></div>
                <div class="flex items-center justify-between">
                    <span class="font-medium">Tambah Banner</span>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 ring-1 ring-inset ring-white/15 group-hover:bg-white/20 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-[#E3DBAF] mt-2 opacity-80">Tambahkan banner baru</p>
            </a>

            <a href="{{ route('admin.beranda.create') }}" class="group relative overflow-hidden bg-gradient-to-r from-[#132C5C] to-[#2B4E94] text-white p-5 rounded-2xl shadow-[0_8px_24px_-10px_rgba(19,44,92,0.6)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_16px_40px_-12px_rgba(19,44,92,0.7)] font-poppins">
                <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/40 to-transparent"></div>
                <div class="flex items-center justify-between">
                    <span class="font-medium">Tambah Beranda</span>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 ring-1 ring-inset ring-white/15 group-hover:bg-white/20 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-[#CAB988] mt-2 opacity-80">Tambahkan data beranda</p>
            </a>

            <a href="{{ route('admin.proyek.create') }}" class="group relative overflow-hidden bg-gradient-to-r from-[#97763A] to-[#B09861] text-white p-5 rounded-2xl shadow-[0_8px_24px_-10px_rgba(151,118,58,0.6)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_16px_40px_-12px_rgba(151,118,58,0.7)] font-poppins">
                <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/40 to-transparent"></div>
                <div class="flex items-center justify-between">
                    <span class="font-medium">Tambah Proyek</span>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 ring-1 ring-inset ring-white/15 group-hover:bg-white/20 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-[#E3DBAF] mt-2 opacity-80">Tambahkan proyek baru</p>
            </a>

            <a href="{{ route('admin.bahasa.index') }}" class="group relative overflow-hidden bg-gradient-to-r from-[#A85C66] to-[#CC707C] text-white p-5 rounded-2xl shadow-[0_8px_24px_-10px_rgba(168,92,102,0.6)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_16px_40px_-12px_rgba(168,92,102,0.7)] font-poppins">
                <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/40 to-transparent"></div>
                <div class="flex items-center justify-between">
                    <span class="font-medium">Atur Bahasa</span>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 ring-1 ring-inset ring-white/15 group-hover:bg-white/20 group-hover:rotate-12 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-[#EBA9B0] mt-2 opacity-80">Ubah pengaturan bahasa</p>
            </a>
        </div>
    </div>

    <!-- System Info -->
    <div class="card p-5 md:p-6">
        <h2 class="section-label font-poppins mb-5">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Informasi Sistem
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50/50 p-3.5">
                <div class="bg-[#E3DBAF]/60 p-2.5 rounded-xl">
                    <svg class="w-5 h-5 text-[#520A18]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8h8V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-500 font-poppins">Laravel Version</p>
                    <p class="text-sm font-semibold text-gray-700 font-poppins">{{ app()->version() }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50/50 p-3.5">
                <div class="bg-[#CAB988]/60 p-2.5 rounded-xl">
                    <svg class="w-5 h-5 text-[#132C5C]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-500 font-poppins">PHP Version</p>
                    <p class="text-sm font-semibold text-gray-700 font-poppins">{{ phpversion() }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50/50 p-3.5">
                <div class="bg-[#EBA9B0]/60 p-2.5 rounded-xl">
                    <svg class="w-5 h-5 text-[#520A18]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm4 4a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1H9a1 1 0 01-1-1V8z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-500 font-poppins">Database</p>
                    <p class="text-sm font-semibold text-gray-700 font-poppins">{{ config('database.default') }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50/50 p-3.5">
                <div class="bg-[#E58C97]/60 p-2.5 rounded-xl">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12zm-1-8a1 1 0 112 0v4a1 1 0 11-2 0V8z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-500 font-poppins">Current Time</p>
                    <p class="text-sm font-semibold text-gray-700 font-poppins">{{ now()->format('H:i:s') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
