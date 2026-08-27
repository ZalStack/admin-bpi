@extends('layouts.app')

@section('title', 'Edit Tentang')

@section('content')
@php
$icons = [
    // Perfilman & Media
    ['code' => 'fa-solid fa-clapperboard', 'name' => 'Papan Film / Clapperboard', 'category' => 'film', 'tags' => 'film movie clapperboard bioskop sinema syuting'],
    ['code' => 'fa-solid fa-video', 'name' => 'Kamera Video', 'category' => 'film', 'tags' => 'video camera rekaman syuting movie'],
    ['code' => 'fa-solid fa-film', 'name' => 'Rol Film', 'category' => 'film', 'tags' => 'film movie roll sinema bioskop'],
    ['code' => 'fa-solid fa-camera', 'name' => 'Kamera Foto', 'category' => 'film', 'tags' => 'kamera foto photo gambar picture'],
    ['code' => 'fa-solid fa-tv', 'name' => 'Televisi / Layar', 'category' => 'film', 'tags' => 'tv televisi layar screen monitor'],
    ['code' => 'fa-solid fa-play', 'name' => 'Tombol Play', 'category' => 'film', 'tags' => 'play putar video tonton'],
    ['code' => 'fa-solid fa-headphones', 'name' => 'Audio / Headphone', 'category' => 'film', 'tags' => 'audio suara headphone musik sound'],
    ['code' => 'fa-solid fa-photo-film', 'name' => 'Media Perfilman', 'category' => 'film', 'tags' => 'media film galeri foto'],

    // Inovasi & Ide Kreatif
    ['code' => 'fa-solid fa-lightbulb', 'name' => 'Lampu Ide & Inovasi', 'category' => 'inovasi', 'tags' => 'lampu ide inovasi kreatif pikiran solusi gagas'],
    ['code' => 'fa-solid fa-sparkles', 'name' => 'Kreativitas / Bintang', 'category' => 'inovasi', 'tags' => 'bintang kilau kreatif unggul prestasi inovasi'],
    ['code' => 'fa-solid fa-rocket', 'name' => 'Roket & Akselerasi', 'category' => 'inovasi', 'tags' => 'roket cepat akselerasi luncur terbang maju'],
    ['code' => 'fa-solid fa-star', 'name' => 'Bintang / Nilai Utama', 'category' => 'inovasi', 'tags' => 'bintang star favorit utama nilai rating'],
    ['code' => 'fa-solid fa-leaf', 'name' => 'Daun & Keberlanjutan', 'category' => 'inovasi', 'tags' => 'daun eco green hijau lingkungan lestari keberlanjutan sustainability'],
    ['code' => 'fa-solid fa-puzzle-piece', 'name' => 'Puzzle / Kolaborasi', 'category' => 'inovasi', 'tags' => 'puzzle bagian integrasi sinergi solusi'],

    // SDM & Komunitas
    ['code' => 'fa-solid fa-users', 'name' => 'Komunitas / Asosiasi', 'category' => 'sdm', 'tags' => 'orang orang-banyak users sdm komunitas asosiasi sineas kelompok masyarakat'],
    ['code' => 'fa-solid fa-user-group', 'name' => 'Grup / Tim Kerja', 'category' => 'sdm', 'tags' => 'grup tim kerja anggota organisasi squad'],
    ['code' => 'fa-solid fa-handshake', 'name' => 'Kemitraan & Kerjasama', 'category' => 'sdm', 'tags' => 'jabat tangan handshake mitra partner kerjasama kolaborasi sinergi'],
    ['code' => 'fa-solid fa-hand-holding-heart', 'name' => 'Apresiasi & Dukungan', 'category' => 'sdm', 'tags' => 'hati peduli kasih apresiasi sosial bantuan support'],
    ['code' => 'fa-solid fa-heart', 'name' => 'Passion & Semangat', 'category' => 'sdm', 'tags' => 'hati suka cinta passion minat'],

    // Pendidikan & Sertifikasi
    ['code' => 'fa-solid fa-graduation-cap', 'name' => 'Toga & Pendidikan SDM', 'category' => 'edukasi', 'tags' => 'toga wisuda sekolah kuliah pendidikan edukasi pelatihan sertifikasi sdm gelar'],
    ['code' => 'fa-solid fa-book-open', 'name' => 'Buku / Riset & Kajian', 'category' => 'edukasi', 'tags' => 'buku baca riset penelitian ilmu pengetahuan studi arsip'],
    ['code' => 'fa-solid fa-award', 'name' => 'Penghargaan & Festival', 'category' => 'edukasi', 'tags' => 'piala medali award juara apresiasi festival nominasi'],
    ['code' => 'fa-solid fa-certificate', 'name' => 'Sertifikasi Profesi', 'category' => 'edukasi', 'tags' => 'sertifikat izin lisensi standar kelayakan'],

    // Hukum & Regulasi
    ['code' => 'fa-solid fa-gavel', 'name' => 'Palu Sidang & Regulasi', 'category' => 'hukum', 'tags' => 'palu sidang hukum advokasi regulasi kebijakan undang-undang aturan'],
    ['code' => 'fa-solid fa-scale-balanced', 'name' => 'Timbangan Keadilan', 'category' => 'hukum', 'tags' => 'timbangan hukum adil regulasi hak kekayaan cipta'],
    ['code' => 'fa-solid fa-shield-halved', 'name' => 'Perlindungan & Hak Cipta', 'category' => 'hukum', 'tags' => 'tameng perisai lindung aman proteksi hak cipta security'],
    ['code' => 'fa-solid fa-file-lines', 'name' => 'Dokumen & Kebijakan', 'category' => 'hukum', 'tags' => 'dokumen surat kertas naskah kebijakan berkas'],

    // Bisnis, Finansial & Global
    ['code' => 'fa-solid fa-globe', 'name' => 'Pasar Global / Internasional', 'category' => 'global', 'tags' => 'dunia bola bumi global internasional luar negeri ekspor pasar'],
    ['code' => 'fa-solid fa-bullseye', 'name' => 'Target & Sasaran', 'category' => 'global', 'tags' => 'target panah sasaran capaian tujuan roadmap misi'],
    ['code' => 'fa-solid fa-chart-line', 'name' => 'Pertumbuhan Industri', 'category' => 'global', 'tags' => 'grafik naik tumbuh ekonomi bisnis tren perkembangan'],
    ['code' => 'fa-solid fa-building-columns', 'name' => 'Institusi / Kelembagaan', 'category' => 'global', 'tags' => 'gedung pilar bank lembaga kementerian bpi institusi pemerintah'],
    ['code' => 'fa-solid fa-money-bill-wave', 'name' => 'Pembiayaan & Investasi', 'category' => 'global', 'tags' => 'uang kas dana modal pembiayaan investasi bill funding'],
    ['code' => 'fa-solid fa-coins', 'name' => 'Koin / Finansial', 'category' => 'global', 'tags' => 'koin uang modal finasial dana'],
    ['code' => 'fa-solid fa-wallet', 'name' => 'Dompet / Anggaran', 'category' => 'global', 'tags' => 'dompet wallet anggaran budget kas'],
    ['code' => 'fa-solid fa-briefcase', 'name' => 'Bisnis & Profesionalisme', 'category' => 'global', 'tags' => 'tas koper kerja bisnis industri profesi komersial'],
];
@endphp

<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.tentang.index') }}">Tentang</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit Section Tentang</h1>
            <p class="page-subtitle">Atur konten dan konfigurasi untuk section <strong>{{ strtoupper($item->section) }}</strong></p>
        </div>
        <a href="{{ route('admin.tentang.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    @php
        $initialLang = $bahasas->firstWhere('is_default', true)?->kode ?? $bahasas->first()?->kode;
    @endphp

    <div class="form-card">
        <form action="{{ route('admin.tentang.update', $item->id) }}" method="POST" enctype="multipart/form-data"
            x-data="{ 
                lang: @js($initialLang),
                deletedPoin: [],
                newPoinIndex: 0,
                poinList: @js($item->poin->map(function($p) {
                    return [
                        'id' => $p->id,
                        'icon' => $p->icon,
                        'urutan' => $p->urutan,
                        'status' => (bool)$p->status,
                        'translations' => $p->translations->keyBy('bahasa')->map(function($t) {
                            return [
                                'judul' => $t->judul,
                                'deskripsi' => $t->deskripsi,
                            ];
                        })->toArray()
                    ];
                })),
                showIconPicker: false,
                activePoinForIcon: null,
                searchQuery: '',
                activeCategory: 'all',
                iconList: @js($icons),

                openIconModal(poin) {
                    this.activePoinForIcon = poin;
                    this.searchQuery = '';
                    this.activeCategory = 'all';
                    this.showIconPicker = true;
                },

                selectIcon(code) {
                    if (this.activePoinForIcon) {
                        this.activePoinForIcon.icon = code;
                    }
                    this.showIconPicker = false;
                },

                get filteredIcons() {
                    return this.iconList.filter(item => {
                        const matchCategory = this.activeCategory === 'all' || item.category === this.activeCategory;
                        const query = this.searchQuery.toLowerCase().trim();
                        const matchSearch = !query || 
                            item.name.toLowerCase().includes(query) || 
                            item.code.toLowerCase().includes(query) || 
                            item.tags.toLowerCase().includes(query);
                        return matchCategory && matchSearch;
                    });
                }
            }">
            @csrf
            @method('PUT')

            <input type="hidden" name="section" value="{{ $item->section }}">
            <input type="hidden" name="deleted_poin" :value="deletedPoin.join(',')">

            <!-- Section Info -->
            <div class="input-group">
                <div>
                    <label class="form-label">Section</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-200 bg-gray-100 px-3.5">
                        <span class="inline-flex items-center rounded-lg bg-[#97763A]/[0.15] px-2.5 py-1 text-xs font-bold text-[#97763A] uppercase">
                            {{ $item->section }}
                        </span>
                    </div>
                </div>

                <div>
                    <label for="urutan" class="form-label">Urutan Tampil (Posisi)</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $item->urutan) }}" class="form-input" min="1" required>
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status Tampil</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1" {{ old('status', $item->status) ? 'checked' : '' }} class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Tampilkan di Landing Page</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Language Tabs & Main Translatable Fields -->
            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    @if($item->section === 'intro')
                        <!-- Intro has both Judul (Badge) and Subjudul (Headline) -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <x-trans-input 
                                field="judul" 
                                label="Judul Section (Badge)" 
                                :kode="$bahasa->kode" 
                                :required="$bahasa->is_default" 
                                :item="$item" 
                                placeholder="cth: Tentang Kami"
                            />
                            <x-trans-input 
                                field="subjudul" 
                                label="Subjudul / Headline Utama" 
                                :kode="$bahasa->kode" 
                                :required="$bahasa->is_default" 
                                :item="$item" 
                                placeholder="cth: Membangun Masa Depan Sinema Nasional"
                            />
                        </div>
                        <div class="mt-2">
                            <x-trans-textarea 
                                field="deskripsi" 
                                label="Deskripsi Lengkap" 
                                :kode="$bahasa->kode" 
                                :required="$bahasa->is_default" 
                                rows="4" 
                                :item="$item" 
                                placeholder="Deskripsi pengenalan dalam bahasa {{ $bahasa->nama }}"
                            />
                        </div>
                    @elseif(in_array($item->section, ['visi', 'misi']))
                        <!-- Visi and Misi only have Judul (no subjudul) and Deskripsi -->
                        <div>
                            <x-trans-input 
                                field="judul" 
                                label="Judul Section" 
                                :kode="$bahasa->kode" 
                                :required="$bahasa->is_default" 
                                :item="$item" 
                                :placeholder="$item->section === 'visi' ? 'cth: Visi Kami' : 'cth: Misi Kami'"
                            />
                        </div>
                        <div class="mt-2">
                            <x-trans-textarea 
                                field="deskripsi" 
                                label="Deskripsi Pengantar" 
                                :kode="$bahasa->kode" 
                                :required="$bahasa->is_default" 
                                rows="3" 
                                :item="$item" 
                                placeholder="Deskripsi ringkas {{ $item->section }} dalam bahasa {{ $bahasa->nama }}"
                            />
                        </div>
                    @endif
                </x-lang-panel>
            @endforeach

            <!-- Image Upload for Section (Especially intro) -->
            @if(in_array($item->section, ['intro']))
                <div class="divider"></div>
                <div>
                    <label for="gambar" class="form-label">Foto / Gambar Section</label>
                    @if($item->gambar)
                        <div class="mb-3">
                            <p class="mb-1.5 text-xs font-medium text-gray-500">Gambar saat ini:</p>
                            <img src="{{ asset('storage/tentang/'.$item->gambar) }}" alt="tentang" class="h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200 shadow-sm">
                        </div>
                    @endif
                    <img id="preview-gambar" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200 shadow-sm">
                    <input type="file" name="gambar" id="gambar" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar')">
                    <p class="mt-1.5 text-xs text-gray-400">Pilih gambar baru jika ingin mengganti gambar (Format JPG, PNG, WEBP max 2MB).</p>
                    @error('gambar')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <!-- EMBEDDED POIN VISI / MISI -->
            @if(in_array($item->section, ['visi', 'misi']))
                <div class="divider"></div>

                <div class="rounded-2xl border border-[#132C5C]/15 bg-[#132C5C]/[0.02] p-5 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-[#132C5C] flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#97763A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                {{ $item->section === 'visi' ? 'Poin Pilar Visi (Pilar Utama)' : 'Poin Kartu Misi (Kartu Misi)' }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Kelola kartu pilar yang tampil di dalam seksi {{ strtoupper($item->section) }} pada landing page.
                            </p>
                        </div>
                        <button type="button" 
                            @click="
                                newPoinIndex++;
                                poinList.push({
                                    id: 'new_' + newPoinIndex,
                                    icon: 'fa-solid fa-star',
                                    urutan: poinList.length + 1,
                                    status: true,
                                    translations: {
                                        id: { judul: '', deskripsi: '' },
                                        en: { judul: '', deskripsi: '' }
                                    }
                                })
                            "
                            class="inline-flex items-center gap-1.5 rounded-xl bg-[#132C5C] px-3.5 py-2 text-xs font-bold text-white shadow-sm hover:bg-[#0E2043] transition-all cursor-pointer w-fit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Poin
                        </button>
                    </div>

                    <!-- Points Cards Grid -->
                    <div class="space-y-4">
                        <template x-for="(poin, pIdx) in poinList" :key="poin.id">
                            <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-5 shadow-sm transition-all hover:border-[#132C5C]/30">
                                <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                                    <div class="flex items-center gap-2.5">
                                        <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-[#97763A]/10 text-xs font-bold text-[#97763A]" x-text="pIdx + 1"></span>
                                        <span class="text-sm font-bold text-gray-800" x-text="poin.translations?.[lang]?.judul || 'Poin ' + (pIdx + 1)"></span>
                                    </div>
                                    <button type="button" 
                                        @click="
                                            if(confirm('Hapus poin ini?')) {
                                                if(!String(poin.id).startsWith('new_')) {
                                                    deletedPoin.push(poin.id);
                                                }
                                                poinList.splice(pIdx, 1);
                                            }
                                        "
                                        class="text-red-500 hover:text-red-700 text-xs font-semibold flex items-center gap-1 px-2 py-1 rounded hover:bg-red-50 transition cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4">
                                    <!-- Icon Picker Field -->
                                    <div>
                                        <label class="form-label text-xs">Icon Poin</label>
                                        <div class="flex items-center gap-2">
                                            <div class="flex h-[42px] w-[42px] shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-[#132C5C] shadow-sm">
                                                <template x-if="poin.icon">
                                                    <i :class="poin.icon" class="text-lg"></i>
                                                </template>
                                                <template x-if="!poin.icon">
                                                    <i class="fa-solid fa-icons text-lg text-gray-300"></i>
                                                </template>
                                            </div>
                                            <div class="relative flex-1">
                                                <input type="text" :name="'poin[' + poin.id + '][icon]'" x-model="poin.icon" class="form-input text-xs font-mono" placeholder="Pilih icon...">
                                            </div>
                                            <button type="button" @click="openIconModal(poin)" class="inline-flex h-[42px] items-center gap-1.5 rounded-xl bg-[#132C5C] px-3 text-xs font-bold text-white shadow-sm hover:bg-[#0E2043] transition-all cursor-pointer shrink-0">
                                                <i class="fa-solid fa-shapes text-xs text-[#E3DBAF]"></i>
                                                <span>Pilih</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label text-xs">Urutan</label>
                                        <input type="number" :name="'poin[' + poin.id + '][urutan]'" x-model="poin.urutan" class="form-input text-xs h-[42px]" min="1">
                                    </div>

                                    <div>
                                        <label class="form-label text-xs">Status Poin</label>
                                        <div class="flex h-[42px] items-center rounded-xl border border-gray-200 bg-gray-50 px-3">
                                            <label class="flex items-center gap-2 cursor-pointer text-xs">
                                                <input type="checkbox" :name="'poin[' + poin.id + '][status]'" value="1" :checked="poin.status" @change="poin.status = $event.target.checked" class="form-checkbox">
                                                <span class="font-medium text-gray-700">Aktif</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Translatable Fields for Point -->
                                <div class="space-y-3 pt-2">
                                    @foreach($bahasas as $b)
                                        <div x-show="lang === '{{ $b->kode }}'" class="space-y-3">
                                            <div>
                                                <label class="form-label text-xs">Judul Poin ({{ $b->nama }})</label>
                                                <input type="text" 
                                                    :name="'poin[' + poin.id + '][translations][{{ $b->kode }}][judul]'" 
                                                    :value="poin.translations?.['{{ $b->kode }}']?.judul || ''"
                                                    @input="
                                                        if(!poin.translations) poin.translations = {};
                                                        if(!poin.translations['{{ $b->kode }}']) poin.translations['{{ $b->kode }}'] = {};
                                                        poin.translations['{{ $b->kode }}'].judul = $event.target.value;
                                                    "
                                                    class="form-input text-xs" 
                                                    placeholder="Judul poin {{ $b->nama }}" 
                                                    {{ $b->is_default ? 'required' : '' }}>
                                            </div>
                                            <div>
                                                <label class="form-label text-xs">Deskripsi Poin ({{ $b->nama }})</label>
                                                <textarea 
                                                    :name="'poin[' + poin.id + '][translations][{{ $b->kode }}][deskripsi]'" 
                                                    :value="poin.translations?.['{{ $b->kode }}']?.deskripsi || ''"
                                                    @input="
                                                        if(!poin.translations) poin.translations = {};
                                                        if(!poin.translations['{{ $b->kode }}']) poin.translations['{{ $b->kode }}'] = {};
                                                        poin.translations['{{ $b->kode }}'].deskripsi = $event.target.value;
                                                    "
                                                    rows="2" 
                                                    class="form-textarea text-xs" 
                                                    placeholder="Deskripsi poin {{ $b->nama }}"></textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            @endif

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.tentang.index') }}" class="btn-outline">Batal</a>
            </div>

                <!-- MODAL VISUAL ICON PICKER -->
    <div x-show="showIconPicker"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4 backdrop-blur-sm"
         style="display: none;"
         @keydown.escape.window="showIconPicker = false">

        <div @click.away="showIconPicker = false"
             class="flex max-h-[85vh] w-full max-w-3xl flex-col rounded-3xl bg-white shadow-2xl overflow-hidden border border-gray-100 animate-in fade-in zoom-in duration-200">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#132C5C]/10 text-[#132C5C]">
                        <i class="fa-solid fa-icons text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Pilih Icon Secara Visual</h3>
                        <p class="text-xs text-gray-500">Klik icon di bawah untuk memasukkannya ke kartu poin</p>
                    </div>
                </div>
                <button type="button" @click="showIconPicker = false" class="rounded-xl p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors cursor-pointer">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Search & Filters -->
            <div class="p-6 pb-2 space-y-3 bg-white">
                <!-- Search Box -->
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" x-model="searchQuery"
                           placeholder="Cari icon... (contoh: film, kamera, orang, lampu, hukum, toga, dunia, target, roket, uang)"
                           class="w-full rounded-2xl border border-gray-200 bg-gray-50/70 py-2.5 pl-11 pr-4 text-xs font-medium text-gray-800 placeholder-gray-400 focus:border-[#132C5C] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#132C5C]/10 transition-all">
                    <button type="button" x-show="searchQuery" @click="searchQuery = ''" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 text-xs">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </button>
                </div>

                <!-- Category Tabs -->
                <div class="flex flex-wrap items-center gap-1.5 pt-1 text-xs">
                    <button type="button" @click="activeCategory = 'all'"
                        :class="activeCategory === 'all' ? 'bg-[#132C5C] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        Semua Icon
                    </button>
                    <button type="button" @click="activeCategory = 'film'"
                        :class="activeCategory === 'film' ? 'bg-[#132C5C] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        🎬 Perfilman
                    </button>
                    <button type="button" @click="activeCategory = 'inovasi'"
                        :class="activeCategory === 'inovasi' ? 'bg-[#132C5C] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        💡 Inovasi
                    </button>
                    <button type="button" @click="activeCategory = 'sdm'"
                        :class="activeCategory === 'sdm' ? 'bg-[#132C5C] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        👥 SDM & Mitra
                    </button>
                    <button type="button" @click="activeCategory = 'edukasi'"
                        :class="activeCategory === 'edukasi' ? 'bg-[#132C5C] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        🎓 Edukasi
                    </button>
                    <button type="button" @click="activeCategory = 'hukum'"
                        :class="activeCategory === 'hukum' ? 'bg-[#132C5C] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        ⚖️ Regulasi
                    </button>
                    <button type="button" @click="activeCategory = 'global'"
                        :class="activeCategory === 'global' ? 'bg-[#132C5C] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        🌐 Global & Bisnis
                    </button>
                </div>
            </div>

            <!-- Icons Grid Scrollable -->
            <div class="flex-1 overflow-y-auto p-6 pt-3">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2.5">
                    <template x-for="item in filteredIcons" :key="item.code">
                        <button type="button" @click="selectIcon(item.code)"
                            :class="activePoinForIcon?.icon === item.code ? 'border-[#132C5C] bg-[#132C5C]/5 ring-2 ring-[#132C5C]/20' : 'border-gray-200 hover:border-[#132C5C]/40 hover:bg-gray-50/80'"
                            class="group flex flex-col items-center justify-center p-3.5 rounded-2xl border text-center transition-all cursor-pointer">
                            <div :class="activePoinForIcon?.icon === item.code ? 'text-[#132C5C] scale-110' : 'text-gray-600 group-hover:text-[#132C5C] group-hover:scale-110'"
                                 class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100/80 transition-all mb-2">
                                <i :class="item.code" class="text-xl"></i>
                            </div>
                            <span class="text-xs font-semibold text-gray-800 leading-snug line-clamp-1" x-text="item.name"></span>
                            <span class="text-[10px] text-gray-400 font-mono mt-0.5" x-text="item.code.replace('fa-solid ', '')"></span>
                        </button>
                    </template>
                </div>

                <!-- Empty State -->
                <div x-show="filteredIcons.length === 0" class="py-12 text-center">
                    <i class="fa-solid fa-magnifying-glass text-3xl text-gray-300 mb-2"></i>
                    <p class="text-xs font-medium text-gray-500">Tidak ada icon yang cocok dengan pencarian Anda.</p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="border-t border-gray-100 px-6 py-3 bg-gray-50 flex items-center justify-between text-xs text-gray-500">
                <span>Icon terpilih: <strong class="text-gray-800 font-mono" x-text="activePoinForIcon?.icon || 'Belum dipilih'"></strong></span>
                <button type="button" @click="showIconPicker = false" class="rounded-xl px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200 transition-colors cursor-pointer">
                    Tutup
                </button>
            </div>
        </div>
    </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush