@extends('layouts.app')

@section('title', 'Edit Menu')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.menu.index') }}">Menu</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit Menu</h1>
            <p class="page-subtitle">{{ $item->translateField('nama') }}</p>
        </div>
        <a href="{{ route('admin.menu.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.menu.update', $item->id) }}" method="POST"
            x-data="{ 
                lang: @js($bahasas->first()?->kode),
                selectedPage: '{{ old('selected_page', '') }}',
                url: '{{ old('url', $item->url) }}',
                isCustom: false,
                init() {
                    const presets = ['/', '/stakeholders', '/program', '/proyek', '/mitra', '/berita', '/tentang', '/kontak'];
                    if (this.url && !presets.includes(this.url)) {
                        this.selectedPage = 'custom';
                        this.isCustom = true;
                    } else if (this.url) {
                        this.selectedPage = this.url;
                    }
                },
                onSelectPage() {
                    if (this.selectedPage === 'custom') {
                        this.isCustom = true;
                    } else {
                        this.isCustom = false;
                        this.url = this.selectedPage;
                    }
                }
            }">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="page_preset" class="form-label">Pilih Halaman Website *</label>
                    <select id="page_preset" x-model="selectedPage" @change="onSelectPage()" class="form-select">
                        <option value="" disabled>-- Pilih Halaman Website --</option>
                        <option value="/">🏠 Beranda ( / )</option>
                        <option value="/stakeholders">👥 Stakeholders ( /stakeholders )</option>
                        <option value="/program">📊 Program Strategis ( /program )</option>
                        <option value="/proyek">🎬 Proyek Kolaborasi ( /proyek )</option>
                        <option value="/mitra">🤝 Mitra ( /mitra )</option>
                        <option value="/berita">📰 Artikel & Berita ( /berita )</option>
                        <option value="/tentang">🏛️ Tentang Kami ( /tentang )</option>
                        <option value="/kontak">📞 Hubungi Kami ( /kontak )</option>
                        <option value="custom">🔗 Link Kustom / URL Eksternal...</option>
                    </select>
                </div>

                <div>
                    <label for="url" class="form-label">Data URL Link *</label>
                    <input type="text" name="url" id="url" x-model="url" :readonly="!isCustom && selectedPage !== 'custom'" class="form-input" :class="{'bg-gray-100 cursor-not-allowed text-gray-600': !isCustom && selectedPage !== 'custom', 'bg-white': isCustom}" placeholder="/halaman-kustom atau https://..." required>
                    @error('url')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-400" x-show="!isCustom && selectedPage !== 'custom'">✅ URL otomatis terisi dan terkunci sesuai halaman website.</p>
                    <p class="mt-1 text-xs text-amber-600 font-medium" x-show="isCustom || selectedPage === 'custom'">⚠️ Masukkan relative path (misal: /halaman-baru) atau link web luar (misal: https://...).</p>
                </div>
            </div>

            <div class="input-group mt-4">
                <div>
                    <label for="urutan" class="form-label">Urutan Tampil</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $item->urutan) }}" class="form-input" min="0">
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" {{ $item->status ? 'checked' : '' }} class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <x-trans-input field="nama" label="Nama Menu" :kode="$bahasa->kode" :required="$bahasa->is_default" :item="$item" placeholder="Nama dalam bahasa {{ $bahasa->nama }}"/>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Update
                </button>
                <a href="{{ route('admin.menu.index') }}" class="btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
