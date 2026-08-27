@extends('layouts.app')

@section('title', 'Edit Program')

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
                <a href="{{ route('admin.program.index') }}">Program</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit Program Pilar</h1>
            <p class="page-subtitle">{{ $item->translateField('judul') }}</p>
        </div>
        <a href="{{ route('admin.program.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.program.update', $item->id) }}" method="POST" enctype="multipart/form-data"
            x-data="{
                lang: @js($bahasas->first()?->kode),
                deletedPoin: [],
                showIconPicker: false,
                activeItemForIcon: null,
                searchQuery: '',
                activeCategory: 'all',
                iconList: @js($icons),

                openIconModal(item) {
                    this.activeItemForIcon = item;
                    this.searchQuery = '';
                    this.activeCategory = 'all';
                    this.showIconPicker = true;
                },

                selectIcon(code) {
                    if (this.activeItemForIcon) {
                        this.activeItemForIcon.icon = code;
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
                },

                poinList: @js($item->poin->map(function($p) use ($bahasas) {
                    $transMap = [];
                    foreach($bahasas as $b) {
                        $t = $p->translations->firstWhere('bahasa', $b->kode);
                        $transMap[$b->kode] = [
                            'judul' => $t?->judul ?? '',
                            'deskripsi' => $t?->deskripsi ?? ''
                        ];
                    }
                    return [
                        'id' => $p->id,
                        'icon' => $p->icon,
                        'urutan' => $p->urutan,
                        'status' => (bool)$p->status,
                        'translations' => $transMap
                    ];
                })),
                addPoin() {
                    const newId = 'new_' + Date.now();
                    const translations = {};
                    @foreach($bahasas as $b)
                        translations['{{ $b->kode }}'] = { judul: '', deskripsi: '' };
                    @endforeach
                    this.poinList.push({
                        id: newId,
                        icon: 'fa-solid fa-check',
                        urutan: this.poinList.length + 1,
                        status: true,
                        translations: translations
                    });
                },
                removePoin(index, id) {
                    if (!String(id).startsWith('new_')) {
                        this.deletedPoin.push(id);
                    }
                    this.poinList.splice(index, 1);
                }
            }">
            @csrf
            @method('PUT')

            <input type="hidden" name="deleted_poin" :value="deletedPoin.join(',')">

            <!-- Program Info Grid -->
            <div class="input-group">
                <div>
                    <x-icon-picker name="icon" :value="old('icon', $item->icon)" label="Icon Pilar Program" />
                </div>

                <div>
                    <label for="urutan" class="form-label">Urutan</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $item->urutan) }}" class="form-input" min="1">
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1" {{ old('status', $item->status) ? 'checked' : '' }} class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Language Tabs & Main Program Translation -->
            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <x-trans-input field="judul" label="Judul Pilar Program" :kode="$bahasa->kode" :required="$bahasa->is_default" :item="$item" placeholder="cth: Pembiayaan dan Investasi"/>
                    <x-trans-textarea field="deskripsi" label="Deskripsi Pengantar" :kode="$bahasa->kode" :required="$bahasa->is_default" :item="$item" rows="3" placeholder="Deskripsi ringkas mengenai pilar program ini..."/>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <!-- SUB-POIN REPEATER -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">Daftar Sub-Poin Program</h3>
                        <p class="text-xs text-gray-500">Kelola poin-poin kegiatan dan fokus aksi dalam pilar ini.</p>
                    </div>
                    <button type="button" @click="addPoin()" class="btn-outline text-xs py-1.5 px-3 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Sub-Poin
                    </button>
                </div>

                <div class="space-y-4">
                    <template x-for="(poin, pIdx) in poinList" :key="poin.id">
                        <div class="p-4 sm:p-5 rounded-2xl border border-gray-200 bg-gray-50/80 space-y-4 relative">
                            <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                                <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#97763A]">
                                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-[#97763A] text-white text-[10px]" x-text="pIdx + 1"></span>
                                    Sub-Poin #<span x-text="pIdx + 1"></span>
                                </span>
                                <button type="button" @click="removePoin(pIdx, poin.id)" class="text-xs text-rose-600 hover:text-rose-800 font-semibold flex items-center gap-1 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus Poin
                                </button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div>
                                    <label class="form-label text-xs">Icon Sub-Poin</label>
                                    <div class="flex items-center gap-2">
                                        <div class="flex h-[38px] w-[38px] shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-white text-[#132C5C] shadow-sm">
                                            <template x-if="poin.icon">
                                                <i :class="poin.icon" class="text-base"></i>
                                            </template>
                                            <template x-if="!poin.icon">
                                                <i class="fa-solid fa-icons text-base text-gray-300"></i>
                                            </template>
                                        </div>
                                        <input type="text" :name="`poin[${poin.id}][icon]`" x-model="poin.icon" class="form-input text-xs py-2 bg-white flex-1 font-mono" placeholder="Pilih icon...">
                                        <button type="button" @click="openIconModal(poin)" class="inline-flex h-[38px] items-center gap-1 rounded-xl bg-[#132C5C] px-2.5 text-xs font-bold text-white shadow-sm hover:bg-[#0E2043] transition-all cursor-pointer shrink-0">
                                            <i class="fa-solid fa-shapes text-xs text-[#E3DBAF]"></i>
                                            <span>Pilih</span>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label text-xs">Urutan</label>
                                    <input type="number" :name="`poin[${poin.id}][urutan]`" x-model="poin.urutan" class="form-input text-xs py-2 bg-white h-[38px]" min="1">
                                </div>
                                <div class="flex items-end">
                                    <div class="flex h-[38px] items-center rounded-xl border border-gray-200 bg-white px-3 w-full">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" :name="`poin[${poin.id}][status]`" value="1" x-model="poin.status" class="form-checkbox">
                                            <span class="text-xs font-medium text-gray-700">Aktif</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Poin Language Fields -->
                            @foreach ($bahasas as $bahasa)
                                <div x-show="lang === '{{ $bahasa->kode }}'" class="space-y-2 pt-2 border-t border-gray-200/60">
                                    <div>
                                        <label class="form-label text-xs">Judul Sub-Poin ({{ $bahasa->nama }}) <span class="text-rose-500">*</span></label>
                                        <input type="text" :name="`poin[${poin.id}][translations][{{ $bahasa->kode }}][judul]`" x-model="poin.translations['{{ $bahasa->kode }}'].judul" class="form-input text-xs py-2 bg-white" placeholder="cth: Penguatan Skema Insentif" required>
                                    </div>
                                    <div>
                                        <label class="form-label text-xs">Deskripsi Singkat ({{ $bahasa->nama }})</label>
                                        <input type="text" :name="`poin[${poin.id}][translations][{{ $bahasa->kode }}][deskripsi]`" x-model="poin.translations['{{ $bahasa->kode }}'].deskripsi" class="form-input text-xs py-2 bg-white" placeholder="cth: Fasilitasi insentif fiskal dan non-fiskal perfilman">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </template>
                </div>
            </div>

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Update Program
                </button>
                <a href="{{ route('admin.program.index') }}" class="btn-outline">Batal</a>
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
                        <p class="text-xs text-gray-500">Klik icon di bawah untuk memasukkannya ke formulir</p>
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
                            :class="activeItemForIcon?.icon === item.code ? 'border-[#132C5C] bg-[#132C5C]/5 ring-2 ring-[#132C5C]/20' : 'border-gray-200 hover:border-[#132C5C]/40 hover:bg-gray-50/80'"
                            class="group flex flex-col items-center justify-center p-3.5 rounded-2xl border text-center transition-all cursor-pointer">
                            <div :class="activeItemForIcon?.icon === item.code ? 'text-[#132C5C] scale-110' : 'text-gray-600 group-hover:text-[#132C5C] group-hover:scale-110'"
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
                <span>Icon terpilih: <strong class="text-gray-800 font-mono" x-text="activeItemForIcon?.icon || 'Belum dipilih'"></strong></span>
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