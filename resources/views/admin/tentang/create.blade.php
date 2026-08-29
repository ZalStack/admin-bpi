@extends('layouts.app')

@section('title', 'Add About')

@section('content')
@php
$icons = [
    // Filmmaking & Media
    ['code' => 'fa-solid fa-clapperboard', 'name' => 'Film Board / Clapperboard', 'category' => 'film', 'tags' => 'film movie clapperboard cinema shoot'],
    ['code' => 'fa-solid fa-video', 'name' => 'Video Camera', 'category' => 'film', 'tags' => 'video camera recording shoot movie'],
    ['code' => 'fa-solid fa-film', 'name' => 'Film Roll', 'category' => 'film', 'tags' => 'film movie roll cinema'],
    ['code' => 'fa-solid fa-camera', 'name' => 'Photo Camera', 'category' => 'film', 'tags' => 'camera photo image picture'],
    ['code' => 'fa-solid fa-tv', 'name' => 'Television / Screen', 'category' => 'film', 'tags' => 'tv television screen monitor'],
    ['code' => 'fa-solid fa-play', 'name' => 'Play Button', 'category' => 'film', 'tags' => 'play video watch'],
    ['code' => 'fa-solid fa-headphones', 'name' => 'Audio / Headphone', 'category' => 'film', 'tags' => 'audio sound headphone music'],
    ['code' => 'fa-solid fa-photo-film', 'name' => 'Filmmaking Media', 'category' => 'film', 'tags' => 'media film photo gallery'],

    // Innovation & Creative Ideas
    ['code' => 'fa-solid fa-lightbulb', 'name' => 'Idea & Innovation Light', 'category' => 'inovasi', 'tags' => 'idea innovation creative solution'],
    ['code' => 'fa-solid fa-sparkles', 'name' => 'Creativity / Star', 'category' => 'inovasi', 'tags' => 'star sparkle creative excellence achievement innovation'],
    ['code' => 'fa-solid fa-rocket', 'name' => 'Rocket & Acceleration', 'category' => 'inovasi', 'tags' => 'rocket fast acceleration launch fly forward'],
    ['code' => 'fa-solid fa-star', 'name' => 'Star / Core Value', 'category' => 'inovasi', 'tags' => 'star favorite core value rating'],
    ['code' => 'fa-solid fa-leaf', 'name' => 'Leaf & Sustainability', 'category' => 'inovasi', 'tags' => 'leaf eco green environment sustainability'],
    ['code' => 'fa-solid fa-puzzle-piece', 'name' => 'Puzzle / Collaboration', 'category' => 'inovasi', 'tags' => 'puzzle part integration synergy solution'],

    // HR & Community
    ['code' => 'fa-solid fa-users', 'name' => 'Community / Association', 'category' => 'sdm', 'tags' => 'people users community association group'],
    ['code' => 'fa-solid fa-user-group', 'name' => 'Group / Team', 'category' => 'sdm', 'tags' => 'group team member organization squad'],
    ['code' => 'fa-solid fa-handshake', 'name' => 'Partnership & Cooperation', 'category' => 'sdm', 'tags' => 'handshake partner cooperation collaboration synergy'],
    ['code' => 'fa-solid fa-hand-holding-heart', 'name' => 'Appreciation & Support', 'category' => 'sdm', 'tags' => 'heart care appreciation social support'],
    ['code' => 'fa-solid fa-heart', 'name' => 'Passion & Spirit', 'category' => 'sdm', 'tags' => 'heart love passion interest'],

    // Education & Certification
    ['code' => 'fa-solid fa-graduation-cap', 'name' => 'Toga & HR Education', 'category' => 'edukasi', 'tags' => 'toga graduation school university education training certification degree'],
    ['code' => 'fa-solid fa-book-open', 'name' => 'Book / Research & Study', 'category' => 'edukasi', 'tags' => 'book reading research knowledge study archive'],
    ['code' => 'fa-solid fa-award', 'name' => 'Award & Festival', 'category' => 'edukasi', 'tags' => 'trophy medal award appreciation festival nomination'],
    ['code' => 'fa-solid fa-certificate', 'name' => 'Professional Certification', 'category' => 'edukasi', 'tags' => 'certificate license standard qualification'],

    // Law & Regulation
    ['code' => 'fa-solid fa-gavel', 'name' => 'Court Gavel & Regulation', 'category' => 'hukum', 'tags' => 'gavel court law advocacy regulation policy law rules'],
    ['code' => 'fa-solid fa-scale-balanced', 'name' => 'Scales of Justice', 'category' => 'hukum', 'tags' => 'scales law justice regulation copyright'],
    ['code' => 'fa-solid fa-shield-halved', 'name' => 'Protection & Copyright', 'category' => 'hukum', 'tags' => 'shield protect security copyright'],
    ['code' => 'fa-solid fa-file-lines', 'name' => 'Document & Policy', 'category' => 'hukum', 'tags' => 'document paper policy file'],

    // Business, Finance & Global
    ['code' => 'fa-solid fa-globe', 'name' => 'Global / International Market', 'category' => 'global', 'tags' => 'world globe international export market'],
    ['code' => 'fa-solid fa-bullseye', 'name' => 'Target & Goals', 'category' => 'global', 'tags' => 'target goal achievement roadmap mission'],
    ['code' => 'fa-solid fa-chart-line', 'name' => 'Industry Growth', 'category' => 'global', 'tags' => 'graph growth economy business trend development'],
    ['code' => 'fa-solid fa-building-columns', 'name' => 'Institution / Organization', 'category' => 'global', 'tags' => 'building pillar bank institution ministry government'],
    ['code' => 'fa-solid fa-money-bill-wave', 'name' => 'Financing & Investment', 'category' => 'global', 'tags' => 'money cash fund capital financing investment bill funding'],
    ['code' => 'fa-solid fa-coins', 'name' => 'Coins / Finance', 'category' => 'global', 'tags' => 'coin money capital finance fund'],
    ['code' => 'fa-solid fa-wallet', 'name' => 'Wallet / Budget', 'category' => 'global', 'tags' => 'wallet budget cash'],
    ['code' => 'fa-solid fa-briefcase', 'name' => 'Business & Professionalism', 'category' => 'global', 'tags' => 'briefcase work business industry profession commercial'],
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
                <a href="{{ route('admin.tentang.index') }}">About</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Add</span>
            </nav>
            <h1 class="page-title">Add About Data</h1>
            <p class="page-subtitle">Add a new section on the about page</p>
        </div>
        <a href="{{ route('admin.tentang.index') }}" class="btn-outline">Back</a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.tentang.store') }}" method="POST" enctype="multipart/form-data"
            x-data="{ 
                lang: @js($bahasas->first()?->kode),
                section: '{{ old('section', '') }}',
                newPoinIndex: 0,
                poinList: [],
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

            <div class="input-group">
                <div>
                    <label for="section" class="form-label">Section *</label>
                    <select name="section" id="section" x-model="section" class="form-select" required>
                        <option value="" disabled {{ old('section') ? '' : 'selected' }}>-- Select About Section --</option>
                        <option value="intro" {{ old('section') == 'intro' ? 'selected' : '' }}>📜 Introduction / BPI Profile (intro)</option>
                        <option value="visi" {{ old('section') == 'visi' ? 'selected' : '' }}>🎯 BPI Vision (visi)</option>
                        <option value="misi" {{ old('section') == 'misi' ? 'selected' : '' }}>🚀 BPI Mission (misi)</option>
                    </select>
                    @error('section')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="urutan" class="form-label">Display Order (Position)</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 1) }}" class="form-input" min="1" required>
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Display Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" checked class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Show on Landing Page</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
            <!-- Dynamic Input Fields based on Section -->
                    <template x-if="section === 'intro' || section === ''">
                        <div>
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <x-trans-input field="judul" label="Section Title (Badge)" :kode="$bahasa->kode" :required="$bahasa->is_default" placeholder="e.g.: About Us"/>
                                <x-trans-input field="subjudul" label="Subtitle / Main Headline" :kode="$bahasa->kode" placeholder="e.g.: Building the Future of National Cinema"/>
                            </div>
                            <div class="mt-4">
                                <x-trans-textarea field="deskripsi" label="Full Description" :kode="$bahasa->kode" :required="$bahasa->is_default" rows="4" placeholder="Introduction description in language {{ $bahasa->nama }}"/>
                            </div>
                        </div>
                    </template>

                    <template x-if="section === 'visi' || section === 'misi'">
                        <div>
                            <div>
                                <x-trans-input field="judul" label="Section Title" :kode="$bahasa->kode" :required="$bahasa->is_default" placeholder="e.g.: Our Vision / Our Mission"/>
                            </div>
                            <div class="mt-4">
                                <x-trans-textarea field="deskripsi" label="Vision / Mission Narrative Description" :kode="$bahasa->kode" :required="$bahasa->is_default" rows="4" placeholder="Narrative description in language {{ $bahasa->nama }}"/>
                            </div>
                        </div>
                    </template>
                </x-lang-panel>
            @endforeach

            <!-- Main Section Photo (Intro only) -->
            <div x-show="section === 'intro' || section === ''" class="transition-all">
                <div class="divider"></div>
                <div>
                    <label for="gambar" class="form-label">Main Section Photo / Image</label>
                    <img id="preview-gambar" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200 shadow-sm">
                    <input type="file" name="gambar" id="gambar" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar')">
                    <p class="mt-1.5 text-xs text-gray-400">Format: JPG, PNG, WEBP. Max 2MB.</p>
                    @error('gambar')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- EMBEDDED VISION / MISSION POINTS -->
            <div x-show="section === 'visi' || section === 'misi'" class="transition-all">
                <div class="divider"></div>

                <div class="rounded-2xl border border-[#132C5C]/15 bg-[#132C5C]/[0.02] p-5 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-[#132C5C] flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#97763A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                <span x-text="section === 'visi' ? 'Vision Pillar Points (Main Pillar)' : 'Mission Card Points (Mission Card)'"></span>
                            </h3>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Manage pillar cards / mission cards displayed in the section on the landing page.
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
Add Point
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
                                        @click="poinList.splice(pIdx, 1)"
                                        class="text-red-500 hover:text-red-700 text-xs font-semibold flex items-center gap-1 px-2 py-1 rounded hover:bg-red-50 transition cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4">
                                    <!-- Icon Picker Field -->
                                    <div>
                                        <label class="form-label text-xs">Point Icon</label>
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
                                                <input type="text" :name="'poin[' + poin.id + '][icon]'" x-model="poin.icon" class="form-input text-xs font-mono" placeholder="Select icon...">
                                            </div>
                                            <button type="button" @click="openIconModal(poin)" class="inline-flex h-[42px] items-center gap-1.5 rounded-xl bg-[#132C5C] px-3 text-xs font-bold text-white shadow-sm hover:bg-[#0E2043] transition-all cursor-pointer shrink-0">
                                                <i class="fa-solid fa-shapes text-xs text-[#E3DBAF]"></i>
                                                <span>Select</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label text-xs">Order</label>
                                        <input type="number" :name="'poin[' + poin.id + '][urutan]'" x-model="poin.urutan" class="form-input text-xs h-[42px]" min="1">
                                    </div>

                                    <div>
                                        <label class="form-label text-xs">Point Status</label>
                                        <div class="flex h-[42px] items-center rounded-xl border border-gray-200 bg-gray-50 px-3">
                                            <label class="flex items-center gap-2 cursor-pointer text-xs">
                                                <input type="checkbox" :name="'poin[' + poin.id + '][status]'" value="1" :checked="poin.status" @change="poin.status = $event.target.checked" class="form-checkbox">
                                                <span class="font-medium text-gray-700">Active</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Translatable Fields for Point -->
                                <div class="space-y-3 pt-2">
                                    @foreach($bahasas as $b)
                                        <div x-show="lang === '{{ $b->kode }}'" class="space-y-3">
                                            <div>
                                                <label class="form-label text-xs">Point Title ({{ $b->nama }})</label>
                                                <input type="text" 
                                                    :name="'poin[' + poin.id + '][translations][{{ $b->kode }}][judul]'" 
                                                    :value="poin.translations?.['{{ $b->kode }}']?.judul || ''"
                                                    @input="
                                                        if(!poin.translations) poin.translations = {};
                                                        if(!poin.translations['{{ $b->kode }}']) poin.translations['{{ $b->kode }}'] = {};
                                                        poin.translations['{{ $b->kode }}'].judul = $event.target.value;
                                                    "
                                                    class="form-input text-xs" 
                                                    placeholder="Point title {{ $b->nama }}" 
                                                    {{ $b->is_default ? 'required' : '' }}>
                                            </div>
                                            <div>
                                                <label class="form-label text-xs">Point Description ({{ $b->nama }})</label>
                                                <textarea 
                                                    :name="'poin[' + poin.id + '][translations][{{ $b->kode }}][deskripsi]'" 
                                                    :value="poin.translations?.['{{ $b->kode }}']?.deskripsi || ''"
                                                    @input="
                                                        if(!poin.translations) poin.translations = {};
                                                        if(!poin.translations['{{ $b->kode }}']) poin.translations['{{ $b->kode }}'] = {};
                                                        poin.translations['{{ $b->kode }}'].deskripsi = $event.target.value;
                                                    "
                                                    rows="2" 
                                                    class="form-input text-xs" 
                                                    placeholder="Brief point description {{ $b->nama }}"></textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </template>

                        <div x-show="poinList.length === 0" class="text-center py-6 border-2 border-dashed border-gray-200 rounded-xl bg-white">
                            <svg class="mx-auto h-8 w-8 text-gray-300 mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <p class="text-xs text-gray-500 font-medium">No points added yet.</p>
                            <p class="text-[11px] text-gray-400">Click the "Add Point" button above to add a pillar / card.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">Save</button>
                <a href="{{ route('admin.tentang.index') }}" class="btn-outline">Cancel</a>
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
                        <h3 class="text-base font-bold text-gray-900">Select Icon Visually</h3>
                        <p class="text-xs text-gray-500">Click an icon below to insert it into the point card</p>
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
                           placeholder="Search icons... (e.g.: film, camera, people, light, law, toga, globe, target, rocket, money)"
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
                        All Icons
                    </button>
                    <button type="button" @click="activeCategory = 'film'"
                        :class="activeCategory === 'film' ? 'bg-[#132C5C] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        🎬 Filmmaking
                    </button>
                    <button type="button" @click="activeCategory = 'inovasi'"
                        :class="activeCategory === 'inovasi' ? 'bg-[#132C5C] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        💡 Innovation
                    </button>
                    <button type="button" @click="activeCategory = 'sdm'"
                        :class="activeCategory === 'sdm' ? 'bg-[#132C5C] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        👥 HR & Partners
                    </button>
                    <button type="button" @click="activeCategory = 'edukasi'"
                        :class="activeCategory === 'edukasi' ? 'bg-[#132C5C] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        🎓 Education
                    </button>
                    <button type="button" @click="activeCategory = 'hukum'"
                        :class="activeCategory === 'hukum' ? 'bg-[#132C5C] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        ⚖️ Regulation
                    </button>
                    <button type="button" @click="activeCategory = 'global'"
                        :class="activeCategory === 'global' ? 'bg-[#132C5C] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        🌐 Global & Business
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
                    <p class="text-xs font-medium text-gray-500">No icons match your search.</p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="border-t border-gray-100 px-6 py-3 bg-gray-50 flex items-center justify-between text-xs text-gray-500">
                <span>Selected icon: <strong class="text-gray-800 font-mono" x-text="activePoinForIcon?.icon || 'Not yet selected'"></strong></span>
                <button type="button" @click="showIconPicker = false" class="rounded-xl px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200 transition-colors cursor-pointer">
                    Close
                </button>
            </div>
        </div>
    </div>
        </form>
    </div>
</div>

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
@endsection