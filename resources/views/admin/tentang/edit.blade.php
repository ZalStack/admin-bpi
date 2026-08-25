@extends('layouts.app')

@section('title', 'Edit Tentang')

@section('content')
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

    @if($item->section === 'struktur')
        <!-- Informative Alert Box for Struktur Organisasi -->
        <div class="mb-6 rounded-2xl border border-blue-200/80 bg-gradient-to-r from-blue-50/90 via-sky-50/70 to-indigo-50/60 p-5 sm:p-6 shadow-sm backdrop-blur">
            <div class="flex items-start gap-4">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-[#132C5C] to-[#2B4E94] text-[#E3DBAF] shadow-md shadow-[#132C5C]/20">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-base font-bold text-[#132C5C]">Kelola Anggota & Bagan Struktur Organisasi</h3>
                    <p class="mt-1.5 text-xs sm:text-sm text-slate-700 leading-relaxed">
                        Di form ini Anda hanya mengatur <strong>Judul Section</strong>, <strong>Urutan Tampil</strong>, dan <strong>Status Aktif</strong> seksi Struktur pada halaman Tentang. 
                        Untuk mengelola daftar pengurus, foto anggota, jabatan, dan sosial media pengurus BPI, silakan buka menu <strong>Modul Struktur Organisasi</strong>.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('admin.struktur.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-[#132C5C] px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-[#0E2043] transition-all hover:scale-[1.02] cursor-pointer">
                            <svg class="w-4 h-4 text-[#E3DBAF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            <span>Buka Panel Modul Struktur Organisasi</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
                            return ['judul' => $t->judul, 'deskripsi' => $t->deskripsi];
                        })->toArray()
                    ];
                }))
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
                    @elseif($item->section === 'struktur')
                        <!-- Struktur only has Judul Section (no subjudul, no deskripsi) -->
                        <div>
                            <x-trans-input 
                                field="judul" 
                                label="Judul Section" 
                                :kode="$bahasa->kode" 
                                :required="$bahasa->is_default" 
                                :item="$item" 
                                placeholder="cth: Struktur Organisasi"
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
                                {{ $item->section === 'visi' ? 'Poin Pilar Visi (4 Pilar Utama)' : 'Poin Kartu Misi (4 Kartu Misi)' }}
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
                                    <div>
                                        <label class="form-label text-xs">Icon (FontAwesome / Lucide)</label>
                                        <input type="text" :name="'poin[' + poin.id + '][icon]'" x-model="poin.icon" class="form-input text-xs" placeholder="cth: fa-solid fa-graduation-cap">
                                    </div>
                                    <div>
                                        <label class="form-label text-xs">Urutan</label>
                                        <input type="number" :name="'poin[' + poin.id + '][urutan]'" x-model="poin.urutan" class="form-input text-xs" min="1">
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
