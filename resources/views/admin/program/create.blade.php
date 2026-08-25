@extends('layouts.app')

@section('title', 'Tambah Program')

@section('content')
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
                <span>Tambah</span>
            </nav>
            <h1 class="page-title">Tambah Program Pilar</h1>
            <p class="page-subtitle">Tambahkan pilar program strategis baru beserta sub-poin programnya</p>
        </div>
        <a href="{{ route('admin.program.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.program.store') }}" method="POST" enctype="multipart/form-data"
            x-data="{
                lang: @js($bahasas->first()?->kode),
                poinList: [],
                addPoin() {
                    const newId = 'new_' + Date.now();
                    const translations = {};
                    @foreach($bahasas as $b)
                        translations['{{ $b->kode }}'] = { judul: '', deskripsi: '' };
                    @endforeach
                    this.poinList.push({
                        id: newId,
                        icon: '',
                        urutan: this.poinList.length + 1,
                        status: true,
                        translations: translations
                    });
                },
                removePoin(index) {
                    this.poinList.splice(index, 1);
                }
            }">
            @csrf

            <!-- Program Info Grid -->
            <div class="input-group">
                <div>
                    <label for="icon" class="form-label">Icon Font Awesome <span class="text-xs text-gray-400 font-normal">(cth: fa-solid fa-coins)</span></label>
                    <input type="text" name="icon" id="icon" value="{{ old('icon') }}" class="form-input" placeholder="fa-solid fa-coins">
                    <p class="mt-1 text-xs text-gray-400">Contoh: <code>fa-solid fa-coins</code>, <code>fa-solid fa-globe</code>, <code>fa-solid fa-graduation-cap</code>, <code>fa-solid fa-building</code>.</p>
                    @error('icon')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="urutan" class="form-label">Urutan</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 1) }}" class="form-input" min="1">
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1" checked class="form-checkbox">
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
                    <x-trans-input field="judul" label="Judul Program" :kode="$bahasa->kode" :required="$bahasa->is_default" placeholder="cth: Pembiayaan & Investasi"/>
                    <div class="mt-2">
                        <x-trans-textarea field="deskripsi" label="Deskripsi Program" :kode="$bahasa->kode" :required="$bahasa->is_default" rows="4" placeholder="Deskripsi pilar program dalam bahasa {{ $bahasa->nama }}"/>
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <!-- Optional Image Upload -->
            <div>
                <label for="gambar" class="form-label">Gambar / Thumbnail Program <span class="text-xs text-gray-400 font-normal">(Opsional)</span></label>
                <img id="preview-gambar" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                <input type="file" name="gambar" id="gambar" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar')">
                <p class="mt-1.5 text-xs text-gray-400">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                @error('gambar')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="divider"></div>

            <!-- ========================================================================= -->
            <!-- SUB-POIN PROGRAM REPEATER                                                 -->
            <!-- ========================================================================= -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Sub-Poin Inisiatif Program</h3>
                        <p class="text-xs text-gray-500">Tambahkan poin-poin capaian / program kerja turunan untuk pilar program ini.</p>
                    </div>
                    <button type="button" @click="addPoin()" class="btn-outline text-xs py-2 px-3.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Poin Program
                    </button>
                </div>

                <template x-if="poinList.length === 0">
                    <div class="p-6 text-center rounded-2xl border border-dashed border-gray-300 bg-gray-50/50">
                        <p class="text-xs text-gray-500 mb-2">Belum ada sub-poin yang ditambahkan.</p>
                        <button type="button" @click="addPoin()" class="text-xs font-bold text-[#68001C] hover:underline">
                            + Tambah Sub-Poin Pertama
                        </button>
                    </div>
                </template>

                <div class="space-y-4">
                    <template x-for="(poin, pIdx) in poinList" :key="poin.id">
                        <div class="p-4 sm:p-5 rounded-2xl border border-gray-200 bg-gray-50/80 space-y-4 relative">
                            <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                                <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#97763A]">
                                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-[#97763A] text-white text-[10px]" x-text="pIdx + 1"></span>
                                    Sub-Poin #<span x-text="pIdx + 1"></span>
                                </span>
                                <button type="button" @click="removePoin(pIdx)" class="text-xs text-rose-600 hover:text-rose-800 font-semibold flex items-center gap-1 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus Poin
                                </button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div>
                                    <label class="form-label text-xs">Icon Sub-Poin (Font Awesome)</label>
                                    <input type="text" :name="`poin[${poin.id}][icon]`" x-model="poin.icon" class="form-input text-xs py-2" placeholder="fa-solid fa-check">
                                </div>
                                <div>
                                    <label class="form-label text-xs">Urutan</label>
                                    <input type="number" :name="`poin[${poin.id}][urutan]`" x-model="poin.urutan" class="form-input text-xs py-2" min="1">
                                </div>
                                <div class="flex items-end">
                                    <label class="flex items-center gap-2 cursor-pointer pb-2">
                                        <input type="checkbox" :name="`poin[${poin.id}][status]`" value="1" x-model="poin.status" class="form-checkbox">
                                        <span class="text-xs font-medium text-gray-700">Aktif</span>
                                    </label>
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
                    Simpan Program
                </button>
                <a href="{{ route('admin.program.index') }}" class="btn-outline">Batal</a>
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
