@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
@php
$icons = [
    // Film & Media
    ['code' => 'fa-solid fa-clapperboard', 'name' => 'Film Board / Clapperboard', 'category' => 'film', 'tags' => 'film movie clapperboard cinema shooting'],
    ['code' => 'fa-solid fa-video', 'name' => 'Video Camera', 'category' => 'film', 'tags' => 'video camera recording shooting movie'],
    ['code' => 'fa-solid fa-film', 'name' => 'Film Roll', 'category' => 'film', 'tags' => 'film movie roll cinema'],
    ['code' => 'fa-solid fa-camera', 'name' => 'Photo Camera', 'category' => 'film', 'tags' => 'camera photo image picture'],
    ['code' => 'fa-solid fa-tv', 'name' => 'Television / Screen', 'category' => 'film', 'tags' => 'tv television screen monitor'],
    ['code' => 'fa-solid fa-play', 'name' => 'Play Button', 'category' => 'film', 'tags' => 'play video watch'],
    ['code' => 'fa-solid fa-headphones', 'name' => 'Audio / Headphone', 'category' => 'film', 'tags' => 'audio sound headphone music'],
    ['code' => 'fa-solid fa-photo-film', 'name' => 'Film Media', 'category' => 'film', 'tags' => 'media film gallery photo'],

    // Innovation & Creative Ideas
    ['code' => 'fa-solid fa-lightbulb', 'name' => 'Idea & Innovation Lamp', 'category' => 'inovasi', 'tags' => 'idea innovation creative solution'],
    ['code' => 'fa-solid fa-sparkles', 'name' => 'Creativity / Stars', 'category' => 'inovasi', 'tags' => 'stars sparkle creative achievement innovation'],
    ['code' => 'fa-solid fa-rocket', 'name' => 'Rocket & Acceleration', 'category' => 'inovasi', 'tags' => 'rocket fast acceleration launch fly progress'],
    ['code' => 'fa-solid fa-star', 'name' => 'Star / Core Value', 'category' => 'inovasi', 'tags' => 'star favorite main value rating'],
    ['code' => 'fa-solid fa-leaf', 'name' => 'Leaf & Sustainability', 'category' => 'inovasi', 'tags' => 'leaf eco green environment sustainability'],
    ['code' => 'fa-solid fa-puzzle-piece', 'name' => 'Puzzle / Collaboration', 'category' => 'inovasi', 'tags' => 'puzzle part integration synergy solution'],

    // HR & Community
    ['code' => 'fa-solid fa-users', 'name' => 'Community / Association', 'category' => 'sdm', 'tags' => 'people users community association filmmakers group'],
    ['code' => 'fa-solid fa-user-group', 'name' => 'Group / Team', 'category' => 'sdm', 'tags' => 'group team members organization squad'],
    ['code' => 'fa-solid fa-handshake', 'name' => 'Partnership & Cooperation', 'category' => 'sdm', 'tags' => 'handshake partner cooperation collaboration synergy'],
    ['code' => 'fa-solid fa-hand-holding-heart', 'name' => 'Appreciation & Support', 'category' => 'sdm', 'tags' => 'heart care appreciation social support'],
    ['code' => 'fa-solid fa-heart', 'name' => 'Passion & Spirit', 'category' => 'sdm', 'tags' => 'heart love passion interest'],

    // Education & Certification
    ['code' => 'fa-solid fa-graduation-cap', 'name' => 'Graduation & HR Education', 'category' => 'edukasi', 'tags' => 'graduation school college education training certification degree'],
    ['code' => 'fa-solid fa-book-open', 'name' => 'Book / Research & Study', 'category' => 'edukasi', 'tags' => 'book read research science study archive'],
    ['code' => 'fa-solid fa-award', 'name' => 'Award & Festival', 'category' => 'edukasi', 'tags' => 'trophy medal award winner appreciation festival nomination'],
    ['code' => 'fa-solid fa-certificate', 'name' => 'Professional Certification', 'category' => 'edukasi', 'tags' => 'certificate permit license standards'],

    // Law & Regulation
    ['code' => 'fa-solid fa-gavel', 'name' => 'Gavel & Regulation', 'category' => 'hukum', 'tags' => 'gavel trial law advocacy regulation policy law rules'],
    ['code' => 'fa-solid fa-scale-balanced', 'name' => 'Scale of Justice', 'category' => 'hukum', 'tags' => 'scale law fair regulation copyright'],
    ['code' => 'fa-solid fa-shield-halved', 'name' => 'Protection & Copyright', 'category' => 'hukum', 'tags' => 'shield protection security copyright'],
    ['code' => 'fa-solid fa-file-lines', 'name' => 'Document & Policy', 'category' => 'hukum', 'tags' => 'document letter paper manuscript policy file'],

    // Business, Finance & Global
    ['code' => 'fa-solid fa-globe', 'name' => 'Global / International Market', 'category' => 'global', 'tags' => 'world globe global international export market'],
    ['code' => 'fa-solid fa-bullseye', 'name' => 'Target & Goals', 'category' => 'global', 'tags' => 'target arrow goals achievement mission roadmap'],
    ['code' => 'fa-solid fa-chart-line', 'name' => 'Industry Growth', 'category' => 'global', 'tags' => 'chart graph growth economy business trend development'],
    ['code' => 'fa-solid fa-building-columns', 'name' => 'Institution / Organization', 'category' => 'global', 'tags' => 'building institution government ministry bpi'],
    ['code' => 'fa-solid fa-money-bill-wave', 'name' => 'Funding & Investment', 'category' => 'global', 'tags' => 'money cash fund capital funding investment bill'],
    ['code' => 'fa-solid fa-coins', 'name' => 'Coins / Finance', 'category' => 'global', 'tags' => 'coins money capital finance fund'],
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
                <a href="{{ route('admin.proyek.index') }}">Projects</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit Project</h1>
            <p class="page-subtitle">{{ $proyek->translateField('judul') }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.proyek.galeri.index', $proyek->id) }}" class="inline-flex items-center gap-2 rounded-xl border border-[#97763A]/40 bg-white px-4 py-2.5 text-xs font-bold text-[#97763A] shadow-sm hover:bg-[#97763A]/5 transition-all">
                <svg class="w-4 h-4 text-[#97763A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Manage Photo Gallery ({{ $proyek->galeri->count() }})
            </a>
            <a href="{{ route('admin.proyek.index') }}" class="btn-outline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </a>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.proyek.update', $proyek->id) }}" method="POST" enctype="multipart/form-data"
            x-data="{
                lang: @js($bahasas->first()?->kode),
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
                tujuan: {
                    @foreach($bahasas as $b)
                        @php
                            $tTrans = $proyek->translations->firstWhere('bahasa', $b->kode);
                            $tList = $tTrans?->tujuan?->map(fn($item) => ['icon' => $item->icon ?: 'fa-solid fa-handshake', 'deskripsi' => $item->deskripsi])->values()->all() ?? [];
                            if (empty($tList)) $tList = [['icon' => 'fa-solid fa-handshake', 'deskripsi' => '']];
                        @endphp
                        '{{ $b->kode }}': @js($tList),
                    @endforeach
                },
                dampak: {
                    @foreach($bahasas as $b)
                        @php
                            $dTrans = $proyek->translations->firstWhere('bahasa', $b->kode);
                            $dList = $dTrans?->dampak_capaian?->map(fn($item) => ['icon' => $item->icon ?: 'fa-solid fa-chart-line', 'total_capaian' => $item->total_capaian, 'deskripsi' => $item->deskripsi])->values()->all() ?? [];
                            if (empty($dList)) $dList = [['icon' => 'fa-solid fa-chart-line', 'total_capaian' => '', 'deskripsi' => '']];
                        @endphp
                        '{{ $b->kode }}': @js($dList),
                    @endforeach
                },
                kegiatan: {
                    @foreach($bahasas as $b)
                        @php
                            $kTrans = $proyek->translations->firstWhere('bahasa', $b->kode);
                            $kList = $kTrans?->kegiatan_utama?->map(fn($item) => ['icon' => $item->icon ?: 'fa-solid fa-calendar-check', 'deskripsi' => $item->deskripsi])->values()->all() ?? [];
                            if (empty($kList)) $kList = [['icon' => 'fa-solid fa-calendar-check', 'deskripsi' => '']];
                        @endphp
                        '{{ $b->kode }}': @js($kList),
                    @endforeach
                },
                linimasa: {
                    @foreach($bahasas as $b)
                        @php
                            $lTrans = $proyek->translations->firstWhere('bahasa', $b->kode);
                            $lList = $lTrans?->linimasa_proyek?->map(fn($item) => ['tahun' => $item->tahun, 'deskripsi' => $item->deskripsi])->values()->all() ?? [];
                            if (empty($lList)) $lList = [['tahun' => '', 'deskripsi' => '']];
                        @endphp
                        '{{ $b->kode }}': @js($lList),
                    @endforeach
                },
                addTujuan(k) { this.tujuan[k].push({ icon: 'fa-solid fa-handshake', deskripsi: '' }); },
                removeTujuan(k, i) { this.tujuan[k].splice(i, 1); },
                addDampak(k) { this.dampak[k].push({ icon: 'fa-solid fa-chart-line', total_capaian: '', deskripsi: '' }); },
                removeDampak(k, i) { this.dampak[k].splice(i, 1); },
                addKegiatan(k) { this.kegiatan[k].push({ icon: 'fa-solid fa-calendar-check', deskripsi: '' }); },
                removeKegiatan(k, i) { this.kegiatan[k].splice(i, 1); },
                addLinimasa(k) { this.linimasa[k].push({ tahun: '', deskripsi: '' }); },
                removeLinimasa(k, i) { this.linimasa[k].splice(i, 1); }
            }">
            @csrf
            @method('PUT')

            <!-- ================= INFORMASI DASAR ================= -->
            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                1. Year, Status & Main Image
            </h3>

            <div class="input-group">
                <div>
                    <label for="tahun" class="form-label">Year / Period <span class="text-rose-500">*</span></label>
                    <input type="text" name="tahun" id="tahun" value="{{ old('tahun', $proyek->tahun) }}" class="form-input" placeholder="e.g.: 2024 - Present" required>
                    @error('tahun')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Publication Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="published" {{ old('status', $proyek->status) == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', $proyek->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="archived" {{ old('status', $proyek->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="urutan" class="form-label">Display Order</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $proyek->urutan) }}" class="form-input" min="1">
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Gambar Utama -->
            <div class="mt-4">
                <label for="gambar_utama" class="form-label">Main Image / Project Cover</label>
                @if($proyek->gambar_utama)
                    <div class="mb-3" x-data="{ deleting: false }">
                        <p class="mb-1.5 text-xs font-medium text-gray-500">Current image:</p>
                        <div class="flex items-start gap-3">
                            <img id="current-gambar_utama" src="{{ asset('storage/proyek/'.$proyek->gambar_utama) }}" alt="proyek" class="h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                            <button type="button" @click="if(!confirm('Are you sure you want to delete this image?')) return; deleting=true; fetch('{{ route('admin.image.delete') }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'},body:JSON.stringify({model:'Proyek',id:{{ $proyek->id }},field:'gambar_utama'})}).then(r=>r.json()).then(d=>{if(d.success){document.getElementById('current-gambar_utama').style.display='none';this.style.display='none';}else{alert(d.message);deleting=false;}}).catch(()=>{alert('An error occurred.');deleting=false;})" class="shrink-0 mt-2 inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100 transition-colors" :disabled="deleting">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span x-text="deleting ? 'Deleting...' : 'Delete Image'"></span>
                            </button>
                        </div>
                    </div>
                @endif
                <img id="preview-gambar-utama" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                <input type="file" name="gambar_utama" id="gambar_utama" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar-utama')">
                <p class="mt-1.5 text-xs text-gray-400">Leave empty if you don't want to change the main image. Format: JPG, PNG, WEBP. Maximum 2MB.</p>
                @error('gambar_utama')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="divider"></div>

            <!-- ================= MITRA TERLIBAT ================= -->
            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                2. Partners / Collaborators
            </h3>

            <div class="rounded-2xl border border-gray-200 bg-gray-50/60 p-4">
                <p class="text-xs text-gray-500 mb-3">Check the partners that collaborate in this project:</p>
                @php
                    $selectedMitraIds = $proyek->mitra->pluck('id')->all();
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 max-h-60 overflow-y-auto pr-1">
                    @forelse($mitras as $m)
                        <label class="flex items-center gap-2.5 p-2 rounded-xl bg-white border border-gray-200 hover:border-[#97763A] cursor-pointer transition-colors {{ in_array($m->id, $selectedMitraIds) ? 'border-[#97763A] ring-1 ring-[#97763A]/20 bg-amber-50/30' : '' }}">
                            <input type="checkbox" name="mitra_ids[]" value="{{ $m->id }}" class="form-checkbox text-[#97763A]" {{ in_array($m->id, $selectedMitraIds) ? 'checked' : '' }}>
                            <div class="flex items-center gap-2 min-w-0">
                                @if($m->logo)
                                    <img src="{{ asset('storage/mitra/'.$m->logo) }}" alt="logo" class="h-6 w-6 object-contain rounded shrink-0">
                                @endif
                                <span class="text-xs font-semibold text-gray-800 truncate">{{ $m->translateField('nama') }}</span>
                            </div>
                        </label>
                    @empty
                        <p class="text-xs text-gray-400 italic">No partner data yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="divider"></div>

            <!-- ================= INFORMASI DETAIL MULTIBAHASA ================= -->
            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                </svg>
                3. Multilingual Content Details
            </h3>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                @php
                    $req = $bahasa->is_default;
                @endphp
                <x-lang-panel :kode="$bahasa->kode" class="space-y-6">
                    <!-- Judul -->
                    <div class="input-group">
                        <x-trans-input field="judul" label="Project Title" :kode="$bahasa->kode" :required="$req" :item="$proyek" placeholder="e.g.: BPI Film Market"/>
                    </div>

                    <!-- Deskripsi Singkat & Lengkap -->
                    <div>
                        <x-trans-textarea field="deskripsi_singkat" label="Short Description" :kode="$bahasa->kode" :required="$req" :item="$proyek" rows="2" placeholder="1-2 sentence summary for project card"/>
                    </div>

                    <div>
                        <x-rich-editor field="deskripsi" label="Full Project Description" :kode="$bahasa->kode" :required="$req" :item="$proyek" height="220px" placeholder="Detailed explanation of the project..."/>
                    </div>

                    <!-- Meta Informasi Proyek -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
                        <x-trans-input field="lokasi" label="Location" :kode="$bahasa->kode" :required="$req" :item="$proyek" placeholder="e.g.: Jakarta, Indonesia"/>
                        <x-trans-input field="ruang_lingkup" label="Scope" :kode="$bahasa->kode" :item="$proyek" placeholder="e.g.: National & International"/>
                        <x-trans-input field="status_proyek" label="Project Status" :kode="$bahasa->kode" :item="$proyek" placeholder="e.g.: Ongoing"/>
                        <x-trans-input field="icon" label="Icon Font Awesome" :kode="$bahasa->kode" :item="$proyek" placeholder="e.g.: fa-solid fa-film"/>
                    </div>

                    <div>
                        <x-trans-input field="timeline" label="Brief Timeline" :kode="$bahasa->kode" :required="$req" :item="$proyek" placeholder="e.g.: 2022 - Present"/>
                    </div>

                    <!-- SUB-SECTION A: TUJUAN PROYEK -->
                    <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-800">🎯 Project Objectives ({{ $bahasa->nama }})</h4>
                                <p class="text-xs text-gray-500">Strategic objective points of this project.</p>
                            </div>
                            <button type="button" @click="addTujuan('{{ $bahasa->kode }}')" class="btn-outline text-xs py-1.5 px-3">
                                + Add Objective
                            </button>
                        </div>
                        <div class="space-y-2.5">
                            <template x-for="(tItem, tIdx) in tujuan['{{ $bahasa->kode }}']" :key="tIdx">
                                <div class="flex items-center gap-2">
                                    <div class="flex h-[38px] w-[38px] shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-white text-[#132C5C] shadow-sm">
                                        <template x-if="tItem.icon"><i :class="tItem.icon" class="text-sm"></i></template>
                                        <template x-if="!tItem.icon"><i class="fa-solid fa-icons text-sm text-gray-300"></i></template>
                                    </div>
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][tujuan][${tIdx}][icon]`" x-model="tItem.icon" class="form-input w-36 text-xs py-2 bg-white shrink-0 font-mono" placeholder="Select icon...">
                                    <button type="button" @click="openIconModal(tItem)" class="inline-flex h-[38px] items-center gap-1 rounded-xl bg-[#132C5C] px-2.5 text-xs font-bold text-white shadow-sm hover:bg-[#0E2043] transition-all cursor-pointer shrink-0">
                                        <i class="fa-solid fa-shapes text-xs text-[#E3DBAF]"></i>
                                        <span>Select</span>
                                    </button>
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][tujuan][${tIdx}][deskripsi]`" x-model="tItem.deskripsi" class="form-input text-xs py-2 bg-white" placeholder="Objective description...">
                                    <button type="button" @click="removeTujuan('{{ $bahasa->kode }}', tIdx)" class="p-2 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- SUB-SECTION B: DAMPAK & CAPAIAN PROYEK -->
                    <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-800">📊 Impact & Achievements ({{ $bahasa->nama }})</h4>
                                <p class="text-xs text-gray-500">Project metrics and achievements statistics (e.g.: 1,250+ Participants).</p>
                            </div>
                            <button type="button" @click="addDampak('{{ $bahasa->kode }}')" class="btn-outline text-xs py-1.5 px-3">
                                + Add Achievement
                            </button>
                        </div>
                        <div class="space-y-2.5">
                            <template x-for="(dItem, dIdx) in dampak['{{ $bahasa->kode }}']" :key="dIdx">
                                <div class="flex items-center gap-2">
                                    <div class="flex h-[38px] w-[38px] shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-white text-[#132C5C] shadow-sm">
                                        <template x-if="dItem.icon"><i :class="dItem.icon" class="text-sm"></i></template>
                                        <template x-if="!dItem.icon"><i class="fa-solid fa-icons text-sm text-gray-300"></i></template>
                                    </div>
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][dampak_capaian][${dIdx}][icon]`" x-model="dItem.icon" class="form-input w-36 text-xs py-2 bg-white shrink-0 font-mono" placeholder="Select icon...">
                                    <button type="button" @click="openIconModal(dItem)" class="inline-flex h-[38px] items-center gap-1 rounded-xl bg-[#132C5C] px-2.5 text-xs font-bold text-white shadow-sm hover:bg-[#0E2043] transition-all cursor-pointer shrink-0">
                                        <i class="fa-solid fa-shapes text-xs text-[#E3DBAF]"></i>
                                        <span>Select</span>
                                    </button>
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][dampak_capaian][${dIdx}][total_capaian]`" x-model="dItem.total_capaian" class="form-input w-28 text-xs py-2 bg-white shrink-0 font-bold" placeholder="e.g.: 1,250+">
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][dampak_capaian][${dIdx}][deskripsi]`" x-model="dItem.deskripsi" class="form-input text-xs py-2 bg-white" placeholder="Achievement description...">
                                    <button type="button" @click="removeDampak('{{ $bahasa->kode }}', dIdx)" class="p-2 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- SUB-SECTION C: KEGIATAN UTAMA -->
                    <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-800">⚡ Main Activities ({{ $bahasa->nama }})</h4>
                                <p class="text-xs text-gray-500">Activities and program formats organized.</p>
                            </div>
                            <button type="button" @click="addKegiatan('{{ $bahasa->kode }}')" class="btn-outline text-xs py-1.5 px-3">
                                + Add Activity
                            </button>
                        </div>
                        <div class="space-y-2.5">
                            <template x-for="(kItem, kIdx) in kegiatan['{{ $bahasa->kode }}']" :key="kIdx">
                                <div class="flex items-center gap-2">
                                    <div class="flex h-[38px] w-[38px] shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-white text-[#132C5C] shadow-sm">
                                        <template x-if="kItem.icon"><i :class="kItem.icon" class="text-sm"></i></template>
                                        <template x-if="!kItem.icon"><i class="fa-solid fa-icons text-sm text-gray-300"></i></template>
                                    </div>
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][kegiatan_utama][${kIdx}][icon]`" x-model="kItem.icon" class="form-input w-36 text-xs py-2 bg-white shrink-0 font-mono" placeholder="Select icon...">
                                    <button type="button" @click="openIconModal(kItem)" class="inline-flex h-[38px] items-center gap-1 rounded-xl bg-[#132C5C] px-2.5 text-xs font-bold text-white shadow-sm hover:bg-[#0E2043] transition-all cursor-pointer shrink-0">
                                        <i class="fa-solid fa-shapes text-xs text-[#E3DBAF]"></i>
                                        <span>Select</span>
                                    </button>
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][kegiatan_utama][${kIdx}][deskripsi]`" x-model="kItem.deskripsi" class="form-input text-xs py-2 bg-white" placeholder="e.g.: Project Pitching Session">
                                    <button type="button" @click="removeKegiatan('{{ $bahasa->kode }}', kIdx)" class="p-2 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- SUB-SECTION D: LINIMASA PROYEK -->
                    <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-800">📅 Timeline / Project Stages ({{ $bahasa->nama }})</h4>
                                <p class="text-xs text-gray-500">Project development milestones from year to year.</p>
                            </div>
                            <button type="button" @click="addLinimasa('{{ $bahasa->kode }}')" class="btn-outline text-xs py-1.5 px-3">
                                + Add Timeline Entry
                            </button>
                        </div>
                        <div class="space-y-2.5">
                            <template x-for="(lItem, lIdx) in linimasa['{{ $bahasa->kode }}']" :key="lIdx">
                                <div class="flex items-center gap-2">
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][linimasa_proyek][${lIdx}][tahun]`" x-model="lItem.tahun" class="form-input w-36 text-xs py-2 bg-white shrink-0 font-bold" placeholder="e.g.: 2022">
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][linimasa_proyek][${lIdx}][deskripsi]`" x-model="lItem.deskripsi" class="form-input text-xs py-2 bg-white" placeholder="Timeline achievement description...">
                                    <button type="button" @click="removeLinimasa('{{ $bahasa->kode }}', lIdx)" class="p-2 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Update Project
                </button>
                <a href="{{ route('admin.proyek.index') }}" class="btn-outline">Cancel</a>
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
                           placeholder="Search icons... (e.g.: film, camera, people, lamp, law, graduation, globe, target, rocket, money)"
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
                <span>Selected icon: <strong class="text-gray-800 font-mono" x-text="activeItemForIcon?.icon || 'Not selected'"></strong></span>
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
