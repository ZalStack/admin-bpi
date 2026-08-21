@extends('layouts.app')

@section('title', 'Dokumentasi API')

@php
    $methodStyles = [
        'GET' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
        'POST' => 'bg-blue-50 text-blue-700 ring-blue-200',
        'PUT' => 'bg-amber-50 text-amber-700 ring-amber-200',
        'PATCH' => 'bg-violet-50 text-violet-700 ring-violet-200',
        'DELETE' => 'bg-rose-50 text-rose-700 ring-rose-200',
    ];
@endphp

@section('content')
<div x-data="apiDocs()" class="space-y-6">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <p class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#520A18]">API Documentation</span>
            </p>
            <h1 class="page-title font-poppins">Dokumentasi API</h1>
            <p class="page-subtitle">Referensi lengkap REST API Admin Panel BPI — endpoint, method, format request &amp; response.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2 shrink-0">
            <span class="count-chip">v1</span>
            <span class="count-chip">{{ $modules->sum(fn ($m) => count($m['endpoints'])) }} Endpoint</span>
            <span class="count-chip">{{ $modules->count() }} Modul</span>
        </div>
    </div>

    <!-- Base URL Card -->
    <div class="card p-5 md:p-6 relative overflow-hidden">
        <div class="absolute inset-x-0 top-0 h-0.5 bg-gradient-to-r from-[#520A18] via-[#97763A] to-[#132C5C] opacity-80"></div>
        <div class="flex flex-col md:flex-row md:items-center gap-4 justify-between">
            <div class="min-w-0">
                <p class="text-xs font-bold uppercase tracking-[0.12em] text-gray-400 mb-1.5">Base URL</p>
                <code id="base-url" class="block w-full truncate rounded-xl bg-gradient-to-r from-[#132C5C] to-[#16336D] px-4 py-3 text-sm md:text-base font-mono text-[#E3DBAF] shadow-inner select-all">
                    {{ url('api/admin/v1') }}/
                </code>
            </div>
            <button @click="copyText($refs.baseUrl, $event)" x-ref="baseUrl"
                    class="btn-secondary shrink-0 self-start md:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                Copy Base URL
            </button>
        </div>

        <!-- Quick info -->
        <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            @foreach([
                ['label' => 'Format Data', 'value' => 'JSON', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>'],
                ['label' => 'Content-Type', 'value' => 'application/json', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>'],
                ['label' => 'Autentikasi', 'value' => 'Session (Web Guard)', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>'],
                ['label' => 'Upload File', 'value' => 'multipart/form-data', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>'],
            ] as $info)
                <div class="flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50/60 p-3.5">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#132C5C]/[0.07] text-[#132C5C]">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $info['icon'] !!}</svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[0.68rem] uppercase tracking-wide text-gray-400 font-semibold">{{ $info['label'] }}</p>
                        <p class="text-sm font-semibold text-gray-700 truncate font-mono">{{ $info['value'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="card p-4 sticky top-[4.5rem] z-30 backdrop-blur-md bg-white/95">
        <div class="flex flex-col lg:flex-row lg:items-center gap-3">
            <!-- Search -->
            <div class="relative flex-1 min-w-0">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" x-model="search" placeholder="Cari endpoint... (misal: banner, berita, toggle)"
                       class="form-input pl-10">
            </div>
            <!-- Method filter -->
            <div class="flex flex-wrap items-center gap-1.5">
                <template x-for="m in methods" :key="m">
                    <button @click="toggleMethod(m)"
                            class="rounded-full px-3 py-1.5 text-xs font-bold tracking-wide transition-all ring-1"
                            :class="activeMethods.includes(m)
                                ? methodClass(m) + ' opacity-100 scale-100'
                                : 'bg-white text-gray-300 ring-gray-200 hover:text-gray-500'"
                            x-text="m"></button>
                </template>
                <button x-show="activeMethods.length > 0 || search !== ''" @click="resetFilters()"
                        class="ml-1 rounded-full p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors"
                        title="Reset filter">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Endpoints per module -->
    <div class="space-y-5">
        <template x-for="(module, mi) in filteredModules" :key="module.prefix">
            <div class="card overflow-hidden">
                <!-- Module header (collapsible) -->
                <button @click="toggleModule(module.prefix)"
                        class="flex w-full items-center justify-between gap-3 px-5 py-4 text-left transition-colors hover:bg-gray-50/70">
                    <div class="flex items-center gap-3 min-w-0">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl font-bold text-sm text-white shadow-md"
                              :style="{ background: `linear-gradient(135deg, ${module.color}, ${module.color}CC)` }"
                              x-text="String(mi + 1).padStart(2, '0')"></span>
                        <div class="min-w-0">
                            <h2 class="truncate text-[0.95rem] font-bold text-gray-800 font-poppins" x-text="'/' + module.prefix"></h2>
                            <p class="truncate text-xs text-gray-400" x-text="module.name"></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <span class="count-chip hidden sm:inline-flex" x-text="module.endpoints.length + ' endpoint'"></span>
                        <svg class="h-4.5 w-4.5 text-gray-400 transition-transform duration-200"
                             :class="{ 'rotate-180': openModules.includes(module.prefix) }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </button>

                <!-- Endpoint list -->
                <div x-show="openModules.includes(module.prefix)" x-collapse x-cloak>
                    <ul class="divide-y divide-gray-100 border-t border-gray-100">
                        <template x-for="ep in module.endpoints" :key="ep.method + ep.path">
                            <li class="group flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 px-5 py-3.5 transition-colors hover:bg-[#132C5C]/[0.03]">
                                <span class="inline-flex shrink-0 items-center justify-center rounded-lg px-2.5 py-1 text-[0.7rem] font-extrabold tracking-wider ring-1 ring-inset w-fit font-mono"
                                      :class="methodClass(ep.method)" x-text="ep.method"></span>
                                <div class="min-w-0 flex-1 order-3 sm:order-2">
                                    <p class="truncate font-mono text-[0.83rem] font-medium text-gray-800">
                                        /admin/v1/<span class="font-semibold" x-text="ep.path"></span>
                                    </p>
                                    <p class="mt-0.5 text-xs text-gray-400 leading-relaxed" x-text="ep.desc"></p>
                                </div>
                                <button class="order-2 sm:order-3 shrink-0 self-end sm:self-center icon-btn-view"
                                        :class="copiedPath === ep.path ? 'text-emerald-600' : ''"
                                        @click="copyText('/admin/v1/' + ep.path, $event, ep.path)" title="Copy path">
                                    <svg x-show="copiedPath !== ep.path" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                                    <svg x-show="copiedPath === ep.path" x-cloak class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </button>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </template>

        <!-- Empty state -->
        <div x-show="filteredModules.length === 0" x-cloak class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="empty-title">Endpoint tidak ditemukan</p>
            <p class="empty-desc">Coba kata kunci lain atau reset filter pencarian.</p>
        </div>
    </div>

    <!-- Response Format -->
    <div>
        <h2 class="section-label font-poppins">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Format Response
        </h2>
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 md:gap-5">

            <!-- Success -->
            <div class="card overflow-hidden">
                <div class="flex items-center justify-between gap-3 border-b border-emerald-100 bg-emerald-50/60 px-5 py-3.5">
                    <div class="flex items-center gap-2.5">
                        <span class="badge-active">200 OK</span>
                        <p class="text-sm font-semibold text-emerald-800">Success Response</p>
                    </div>
                    <button @click="copyJson($refs.jsonSuccess, $event)" class="icon-btn-view text-emerald-700" title="Copy JSON">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                    </button>
                </div>
                <pre x-ref="jsonSuccess" class="overflow-x-auto bg-gradient-to-br from-gray-900 to-[#132C5C] p-5 text-[0.78rem] leading-relaxed font-mono text-gray-200"><code>{
  "status": "success",
  "message": "Data retrieved successfully",
  "data": [
    {
      "id": 1,
      "judul_id": "Judul Konten",
      "judul_en": "Content Title",
      "status": true,
      "created_at": "2026-08-21T10:00:00.000000Z"
    }
  ]
}</code></pre>
            </div>

            <!-- Created -->
            <div class="card overflow-hidden">
                <div class="flex items-center justify-between gap-3 border-b border-blue-100 bg-blue-50/60 px-5 py-3.5">
                    <div class="flex items-center gap-2.5">
                        <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700 ring-1 ring-inset ring-blue-200">201 Created</span>
                        <p class="text-sm font-semibold text-blue-800">Resource Dibuat</p>
                    </div>
                    <button @click="copyJson($refs.jsonCreated, $event)" class="icon-btn-view text-blue-700" title="Copy JSON">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                    </button>
                </div>
                <pre x-ref="jsonCreated" class="overflow-x-auto bg-gradient-to-br from-gray-900 to-[#132C5C] p-5 text-[0.78rem] leading-relaxed font-mono text-gray-200"><code>{
  "status": "success",
  "message": "Resource created successfully",
  "data": {
    "id": 12,
    "judul_id": "Konten Baru",
    "status": true
  }
}</code></pre>
            </div>

            <!-- Validation Error -->
            <div class="card overflow-hidden">
                <div class="flex items-center justify-between gap-3 border-b border-amber-100 bg-amber-50/60 px-5 py-3.5">
                    <div class="flex items-center gap-2.5">
                        <span class="badge-draft">422 Unprocessable</span>
                        <p class="text-sm font-semibold text-amber-800">Validasi Gagal</p>
                    </div>
                    <button @click="copyJson($refs.jsonValidation, $event)" class="icon-btn-view text-amber-700" title="Copy JSON">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                    </button>
                </div>
                <pre x-ref="jsonValidation" class="overflow-x-auto bg-gradient-to-br from-gray-900 to-[#132C5C] p-5 text-[0.78rem] leading-relaxed font-mono text-gray-200"><code>{
  "status": "error",
  "message": "Validation error",
  "errors": {
    "judul_id": ["The judul id field is required."],
    "gambar": ["The gambar must be an image."]
  }
}</code></pre>
            </div>

            <!-- Not Found -->
            <div class="card overflow-hidden">
                <div class="flex items-center justify-between gap-3 border-b border-rose-100 bg-rose-50/60 px-5 py-3.5">
                    <div class="flex items-center gap-2.5">
                        <span class="badge-inactive">404 Not Found</span>
                        <p class="text-sm font-semibold text-rose-800">Data Tidak Ditemukan</p>
                    </div>
                    <button @click="copyJson($refs.jsonNotFound, $event)" class="icon-btn-view text-rose-700" title="Copy JSON">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                    </button>
                </div>
                <pre x-ref="jsonNotFound" class="overflow-x-auto bg-gradient-to-br from-gray-900 to-[#132C5C] p-5 text-[0.78rem] leading-relaxed font-mono text-gray-200"><code>{
  "status": "error",
  "message": "Resource not found"
}</code></pre>
            </div>
        </div>
    </div>

    <!-- Status Codes -->
    <div class="card p-5 md:p-6">
        <h2 class="section-label font-poppins">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Kode Status HTTP
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3">
            @foreach([
                ['code' => '200', 'title' => 'OK', 'desc' => 'Request berhasil diproses', 'style' => 'text-emerald-700 bg-emerald-50 ring-emerald-200'],
                ['code' => '201', 'title' => 'Created', 'desc' => 'Resource berhasil dibuat', 'style' => 'text-blue-700 bg-blue-50 ring-blue-200'],
                ['code' => '400', 'title' => 'Bad Request', 'desc' => 'Request tidak valid', 'style' => 'text-amber-700 bg-amber-50 ring-amber-200'],
                ['code' => '401', 'title' => 'Unauthorized', 'desc' => 'Belum terautentikasi (login dulu)', 'style' => 'text-orange-700 bg-orange-50 ring-orange-200'],
                ['code' => '404', 'title' => 'Not Found', 'desc' => 'Data/endpoint tidak ditemukan', 'style' => 'text-rose-700 bg-rose-50 ring-rose-200'],
                ['code' => '422', 'title' => 'Unprocessable Entity', 'desc' => 'Validasi input gagal', 'style' => 'text-violet-700 bg-violet-50 ring-violet-200'],
            ] as $status)
                <div class="flex items-start gap-3 rounded-xl border border-gray-100 bg-gray-50/60 p-3.5">
                    <span class="inline-flex shrink-0 items-center rounded-lg px-2 py-1 text-xs font-extrabold ring-1 ring-inset font-mono {{ $status['style'] }}">{{ $status['code'] }}</span>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-700">{{ $status['title'] }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $status['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Contoh Request -->
    <div class="card overflow-hidden">
        <div class="flex items-center justify-between gap-3 border-b border-gray-100 bg-gradient-to-r from-[#132C5C]/[0.04] to-transparent px-5 py-4">
            <h2 class="section-label font-poppins mb-0">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Contoh Request
            </h2>
            <button @click="copyJson($refs.curlExample)" class="btn-outline !py-1.5 !px-3 text-xs">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                Copy
            </button>
        </div>
        <pre x-ref="curlExample" class="overflow-x-auto bg-gradient-to-br from-gray-900 to-[#132C5C] p-5 text-[0.78rem] leading-relaxed font-mono text-gray-200"><code># GET - Ambil semua banner
curl -X GET "{{ url('api/admin/v1') }}/banner" \
  -H "Accept: application/json"

# POST - Buat banner baru
curl -X POST "{{ url('api/admin/v1') }}/banner" \
  -H "Accept: application/json" \
  -H "Content-Type: multipart/form-data" \
  -F "halaman=beranda" \
  -F "judul_id=Judul Banner" \
  -F "judul_en=Banner Title" \
  -F "deskripsi_id=Deskripsi singkat" \
  -F "deskripsi_en=Short description" \
  -F "gambar=@/path/to/image.jpg" \
  -F "status=true"</code></pre>
    </div>

    <!-- Toast copy -->
    <div x-show="toast" x-cloak x-transition.opacity
         class="fixed bottom-6 right-6 z-50 flex items-center gap-2.5 rounded-xl bg-gray-900 px-4 py-3 text-sm font-medium text-white shadow-2xl">
        <svg class="h-4.5 w-4.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span x-text="toastMessage"></span>
    </div>
</div>
@endsection

@push('scripts')
@php
    $modulesJson = json_encode(array_map(function ($m) {
        return [
            'name' => $m['name'],
            'prefix' => $m['prefix'],
            'color' => $m['color'],
            'endpoints' => array_map(function ($e) {
                return [
                    'method' => $e['method'],
                    'path' => '/admin/v1/' . $e['path'],
                    'desc' => $e['desc'],
                ];
            }, $m['endpoints']),
        ];
    }, $modules->all()));
@endphp
<script>
    function apiDocs() {
        const allModules = {{ $modulesJson }};

        return {
            modules: allModules,
            openModules: allModules.map(m => m.prefix),
            search: '',
            activeMethods: [],
            methods: ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'],
            copiedPath: null,
            toast: false,
            toastMessage: '',

            get filteredModules() {
                return this.modules
                    .map(module => {
                        const q = this.search.toLowerCase().trim();
                        const matchModule = !q || module.name.toLowerCase().includes(q) || module.prefix.toLowerCase().includes(q);
                        let endpoints = module.endpoints.filter(ep => this.activeMethods.length === 0 || this.activeMethods.includes(ep.method));
                        if (q && !matchModule) {
                            endpoints = endpoints.filter(ep =>
                                ep.path.toLowerCase().includes(q) ||
                                ep.desc.toLowerCase().includes(q) ||
                                ep.method.toLowerCase() === q
                            );
                        }
                        return { ...module, endpoints };
                    })
                    .filter(module => module.endpoints.length > 0);
            },

            toggleModule(prefix) {
                const i = this.openModules.indexOf(prefix);
                i === -1 ? this.openModules.push(prefix) : this.openModules.splice(i, 1);
            },

            toggleMethod(method) {
                const i = this.activeMethods.indexOf(method);
                i === -1 ? this.activeMethods.push(method) : this.activeMethods.splice(i, 1);
            },

            resetFilters() {
                this.search = '';
                this.activeMethods = [];
            },

            methodClass(method) {
                const styles = {
                    GET: 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                    POST: 'bg-blue-50 text-blue-700 ring-blue-200',
                    PUT: 'bg-amber-50 text-amber-700 ring-amber-200',
                    PATCH: 'bg-violet-50 text-violet-700 ring-violet-200',
                    DELETE: 'bg-rose-50 text-rose-700 ring-rose-200',
                };
                return styles[method] || 'bg-gray-50 text-gray-700 ring-gray-200';
            },

            showToast(msg) {
                this.toastMessage = msg;
                this.toast = true;
                clearTimeout(this._t);
                this._t = setTimeout(() => this.toast = false, 2200);
            },

            async copyText(text, event, key = null) {
                try { await navigator.clipboard.writeText(text); } catch (e) {}
                if (key !== null) {
                    this.copiedPath = key;
                    clearTimeout(this._cp);
                    this._cp = setTimeout(() => this.copiedPath = null, 1600);
                }
                if (event && event.currentTarget && typeof event.currentTarget.blur === 'function') event.currentTarget.blur();
                this.showToast('Berhasil dicopy ke clipboard');
            },

            async copyJson(refEl, event) {
                if (!refEl) return;
                await navigator.clipboard.writeText(refEl.innerText);
                if (event && event.currentTarget && typeof event.currentTarget.blur === 'function') event.currentTarget.blur();
                this.showToast('JSON berhasil dicopy');
            },
        };
    }
</script>
@endpush
