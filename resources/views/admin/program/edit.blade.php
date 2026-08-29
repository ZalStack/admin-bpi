@extends('layouts.app')

@section('title', 'Edit Program')

@section('content')
@php
$icons = [
    // Film & Media
    ['code' => 'fa-solid fa-clapperboard', 'name' => 'Clapperboard', 'category' => 'film', 'tags' => 'film movie clapperboard cinema shooting'],
    ['code' => 'fa-solid fa-video', 'name' => 'Video Camera', 'category' => 'film', 'tags' => 'video camera recording shooting movie'],
    ['code' => 'fa-solid fa-film', 'name' => 'Film Roll', 'category' => 'film', 'tags' => 'film movie roll cinema'],
    ['code' => 'fa-solid fa-camera', 'name' => 'Photo Camera', 'category' => 'film', 'tags' => 'camera photo image picture'],
    ['code' => 'fa-solid fa-tv', 'name' => 'Television / Screen', 'category' => 'film', 'tags' => 'tv television screen monitor'],
    ['code' => 'fa-solid fa-play', 'name' => 'Play Button', 'category' => 'film', 'tags' => 'play video watch'],
    ['code' => 'fa-solid fa-headphones', 'name' => 'Audio / Headphone', 'category' => 'film', 'tags' => 'audio sound headphone music'],
    ['code' => 'fa-solid fa-photo-film', 'name' => 'Film Media', 'category' => 'film', 'tags' => 'media film photo gallery'],

    // Innovation & Creative Ideas
    ['code' => 'fa-solid fa-lightbulb', 'name' => 'Idea & Innovation Lamp', 'category' => 'inovasi', 'tags' => 'idea innovation creative thinking solution'],
    ['code' => 'fa-solid fa-sparkles', 'name' => 'Creativity / Stars', 'category' => 'inovasi', 'tags' => 'stars sparkle creative excellence achievement innovation'],
    ['code' => 'fa-solid fa-rocket', 'name' => 'Rocket & Acceleration', 'category' => 'inovasi', 'tags' => 'rocket fast acceleration launch fly forward'],
    ['code' => 'fa-solid fa-star', 'name' => 'Star / Key Values', 'category' => 'inovasi', 'tags' => 'star favorite main value rating'],
    ['code' => 'fa-solid fa-leaf', 'name' => 'Leaf & Sustainability', 'category' => 'inovasi', 'tags' => 'leaf eco green environment sustainable sustainability'],
    ['code' => 'fa-solid fa-puzzle-piece', 'name' => 'Puzzle / Collaboration', 'category' => 'inovasi', 'tags' => 'puzzle part integration synergy solution'],

    // HR & Community
    ['code' => 'fa-solid fa-users', 'name' => 'Community / Association', 'category' => 'sdm', 'tags' => 'people users hr community association filmmakers group'],
    ['code' => 'fa-solid fa-user-group', 'name' => 'Group / Work Team', 'category' => 'sdm', 'tags' => 'group team members organization squad'],
    ['code' => 'fa-solid fa-handshake', 'name' => 'Partnership & Cooperation', 'category' => 'sdm', 'tags' => 'handshake partner cooperation collaboration synergy'],
    ['code' => 'fa-solid fa-hand-holding-heart', 'name' => 'Appreciation & Support', 'category' => 'sdm', 'tags' => 'heart care appreciation social help support'],
    ['code' => 'fa-solid fa-heart', 'name' => 'Passion & Enthusiasm', 'category' => 'sdm', 'tags' => 'heart love passion interest'],

    // Education & Certification
    ['code' => 'fa-solid fa-graduation-cap', 'name' => 'Graduation & HR Education', 'category' => 'edukasi', 'tags' => 'graduation school college education training certification hr degree'],
    ['code' => 'fa-solid fa-book-open', 'name' => 'Book / Research & Study', 'category' => 'edukasi', 'tags' => 'book read research knowledge study archive'],
    ['code' => 'fa-solid fa-award', 'name' => 'Award & Festival', 'category' => 'edukasi', 'tags' => 'trophy medal award winner appreciation festival nomination'],
    ['code' => 'fa-solid fa-certificate', 'name' => 'Professional Certification', 'category' => 'edukasi', 'tags' => 'certificate license permit standard eligibility'],

    // Law & Regulation
    ['code' => 'fa-solid fa-gavel', 'name' => 'Gavel & Regulation', 'category' => 'hukum', 'tags' => 'gavel hearing law advocacy regulation policy legislation rules'],
    ['code' => 'fa-solid fa-scale-balanced', 'name' => 'Scale of Justice', 'category' => 'hukum', 'tags' => 'scale law fair regulation rights copyright'],
    ['code' => 'fa-solid fa-shield-halved', 'name' => 'Protection & Copyright', 'category' => 'hukum', 'tags' => 'shield protection safe security copyright'],
    ['code' => 'fa-solid fa-file-lines', 'name' => 'Document & Policy', 'category' => 'hukum', 'tags' => 'document letter paper manuscript policy file'],

    // Business, Finance & Global
    ['code' => 'fa-solid fa-globe', 'name' => 'Global / International Market', 'category' => 'global', 'tags' => 'world globe global international abroad export market'],
    ['code' => 'fa-solid fa-bullseye', 'name' => 'Target & Goals', 'category' => 'global', 'tags' => 'target arrow goals achievement roadmap mission'],
    ['code' => 'fa-solid fa-chart-line', 'name' => 'Industry Growth', 'category' => 'global', 'tags' => 'chart growth economy business trend development'],
    ['code' => 'fa-solid fa-building-columns', 'name' => 'Institution / Organization', 'category' => 'global', 'tags' => 'building pillar bank institution ministry bpi government'],
    ['code' => 'fa-solid fa-money-bill-wave', 'name' => 'Financing & Investment', 'category' => 'global', 'tags' => 'money cash fund capital financing investment bill funding'],
    ['code' => 'fa-solid fa-coins', 'name' => 'Coins / Finance', 'category' => 'global', 'tags' => 'coins money capital finance fund'],
    ['code' => 'fa-solid fa-wallet', 'name' => 'Wallet / Budget', 'category' => 'global', 'tags' => 'wallet budget cash'],
    ['code' => 'fa-solid fa-briefcase', 'name' => 'Business & Professionalism', 'category' => 'global', 'tags' => 'bag work business industry profession commercial'],
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
            <h1 class="page-title">Edit Program Pillar</h1>
            <p class="page-subtitle">{{ $item->translateField('judul') }}</p>
        </div>
        <a href="{{ route('admin.program.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
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
                        translations['{{ $b->kode }}'] = { judul: '' };
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
                    <x-icon-picker name="icon" :value="old('icon', $item->icon)" label="Program Pillar Icon" />
                </div>

                <div>
                    <label for="urutan" class="form-label">Order</label>
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
                            <span class="text-sm font-medium text-gray-700">Active</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Language Tabs & Main Program Translation -->
            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <x-trans-input field="judul" label="Program Pillar Title" :kode="$bahasa->kode" :required="$bahasa->is_default" :item="$item" placeholder="e.g.: Financing and Investment"/>
                    <x-trans-textarea field="deskripsi" label="Introduction Description" :kode="$bahasa->kode" :required="$bahasa->is_default" :item="$item" rows="3" placeholder="Brief description of this program pillar..."/>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <!-- Optional Image Upload -->
            <div>
                <label for="gambar" class="form-label">Image / Thumbnail <span class="text-xs text-gray-400 font-normal">(Optional)</span></label>
                @if($item->gambar)
                    <div class="mb-3" x-data="{ deleting: false }">
                        <p class="mb-1.5 text-xs font-medium text-gray-500">Current image:</p>
                        <div class="flex items-start gap-3">
                            <img id="current-gambar" src="{{ asset('storage/program/'.$item->gambar) }}" alt="program" class="h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                            <button type="button" @click="if(!confirm('Are you sure you want to delete this image?')) return; deleting=true; fetch('{{ route('admin.image.delete') }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'},body:JSON.stringify({model:'Program',id:{{ $item->id }},field:'gambar'})}).then(r=>r.json()).then(d=>{if(d.success){document.getElementById('current-gambar').style.display='none';this.style.display='none';}else{alert(d.message);deleting=false;}}).catch(()=>{alert('An error occurred.');deleting=false;})" class="shrink-0 mt-2 inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100 transition-colors" :disabled="deleting">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span x-text="deleting ? 'Deleting...' : 'Delete Image'"></span>
                            </button>
                        </div>
                    </div>
                @endif
                <img id="preview-gambar" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                <input type="file" name="gambar" id="gambar" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar')">
                <p class="mt-1.5 text-xs text-gray-400">Leave empty if you don't want to change the image. Format: JPG, PNG, WEBP. Max 2MB.</p>
                @error('gambar')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="divider"></div>

            <!-- SUB-POIN REPEATER -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">Sub-Program Points List</h3>
                        <p class="text-xs text-gray-500">Manage activity points and focus areas within this pillar.</p>
                    </div>
                    <button type="button" @click="addPoin()" class="btn-outline text-xs py-1.5 px-3 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add Sub-Point
                    </button>
                </div>

                <div class="space-y-4">
                    <template x-for="(poin, pIdx) in poinList" :key="poin.id">
                        <div class="p-4 sm:p-5 rounded-2xl border border-gray-200 bg-gray-50/80 space-y-4 relative">
                            <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                                <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#97763A]">
                                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-[#97763A] text-white text-[10px]" x-text="pIdx + 1"></span>
                                     Sub-Point #<span x-text="pIdx + 1"></span>
                                </span>
                                <button type="button" @click="removePoin(pIdx, poin.id)" class="text-xs text-rose-600 hover:text-rose-800 font-semibold flex items-center gap-1 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                     Delete Point
                                </button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div>
                                    <label class="form-label text-xs">Sub-Point Icon</label>
                                    <div class="flex items-center gap-2">
                                        <div class="flex h-[38px] w-[38px] shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-white text-[#132C5C] shadow-sm">
                                            <template x-if="poin.icon">
                                                <i :class="poin.icon" class="text-base"></i>
                                            </template>
                                            <template x-if="!poin.icon">
                                                <i class="fa-solid fa-icons text-base text-gray-300"></i>
                                            </template>
                                        </div>
                                        <input type="text" :name="`poin[${poin.id}][icon]`" x-model="poin.icon" class="form-input text-xs py-2 bg-white flex-1 font-mono" placeholder="Select icon...">
                                        <button type="button" @click="openIconModal(poin)" class="inline-flex h-[38px] items-center gap-1 rounded-xl bg-[#132C5C] px-2.5 text-xs font-bold text-white shadow-sm hover:bg-[#0E2043] transition-all cursor-pointer shrink-0">
                                            <i class="fa-solid fa-shapes text-xs text-[#E3DBAF]"></i>
                                             <span>Select</span>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label text-xs">Order</label>
                                    <input type="number" :name="`poin[${poin.id}][urutan]`" x-model="poin.urutan" class="form-input text-xs py-2 bg-white h-[38px]" min="1">
                                </div>
                                <div class="flex items-end">
                                    <div class="flex h-[38px] items-center rounded-xl border border-gray-200 bg-white px-3 w-full">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" :name="`poin[${poin.id}][status]`" value="1" x-model="poin.status" class="form-checkbox">
                                            <span class="text-xs font-medium text-gray-700">Active</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Poin Language Fields -->
                            @foreach ($bahasas as $bahasa)
                                <div x-show="lang === '{{ $bahasa->kode }}'" class="space-y-2 pt-2 border-t border-gray-200/60">
                                    <div>
                                        <label class="form-label text-xs">Sub-Point Title ({{ $bahasa->nama }}) <span class="text-rose-500">*</span></label>
                                        <input type="text" :name="`poin[${poin.id}][translations][{{ $bahasa->kode }}][judul]`" x-model="poin.translations['{{ $bahasa->kode }}'].judul" class="form-input text-xs py-2 bg-white" placeholder="e.g.: Strengthening Incentive Scheme" required>
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
                <a href="{{ route('admin.program.index') }}" class="btn-outline">Cancel</a>
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
                        <p class="text-xs text-gray-500">Click an icon below to insert it into the form</p>
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
                           placeholder="Search icons... (e.g.: film, camera, people, lamp, law, graduation, world, target, rocket, money)"
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
                        🎬 Film
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
                    <p class="text-xs font-medium text-gray-500">No icons match your search.</p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="border-t border-gray-100 px-6 py-3 bg-gray-50 flex items-center justify-between text-xs text-gray-500">
                <span>Selected icon: <strong class="text-gray-800 font-mono" x-text="activeItemForIcon?.icon || 'None selected'"></strong></span>
                <button type="button" @click="showIconPicker = false" class="rounded-xl px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200 transition-colors cursor-pointer">
                    Close
                </button>
            </div>
        </div>
    </div>
        </form>
    </div>
</div>
@endsection
