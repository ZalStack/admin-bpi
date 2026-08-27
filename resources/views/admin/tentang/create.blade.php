@extends('layouts.app')

@section('title', 'Tambah Tentang')

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
                <span>Tambah</span>
            </nav>
            <h1 class="page-title">Tambah Data Tentang</h1>
            <p class="page-subtitle">Tambahkan section baru pada halaman tentang</p>
        </div>
        <a href="{{ route('admin.tentang.index') }}" class="btn-outline">Kembali</a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.tentang.store') }}" method="POST" enctype="multipart/form-data"
            x-data="{ lang: @js($bahasas->first()?->kode) }">
            @csrf

            <div class="input-group">
                <div>
                    <label for="section" class="form-label">Section *</label>
                    <select name="section" id="section" class="form-select" required>
                        <option value="" disabled {{ old('section') ? '' : 'selected' }}>-- Pilih Section Tentang --</option>
                        <option value="intro" {{ old('section') == 'intro' ? 'selected' : '' }}>📜 Pengantar / Profil BPI (intro)</option>
                        <option value="visi" {{ old('section') == 'visi' ? 'selected' : '' }}>🎯 Visi BPI (visi)</option>
                        <option value="misi" {{ old('section') == 'misi' ? 'selected' : '' }}>🚀 Misi BPI (misi)</option>
                    </select>
                    @error('section')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="urutan" class="form-label">Urutan</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 0) }}" class="form-input">
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" checked class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <x-trans-input field="judul" label="Judul" :kode="$bahasa->kode" :required="$bahasa->is_default" placeholder="Judul dalam bahasa {{ $bahasa->nama }}"/>
                        <x-trans-input field="subjudul" label="Subjudul" :kode="$bahasa->kode" placeholder="Subjudul dalam bahasa {{ $bahasa->nama }}"/>
                    </div>
                    <div class="mt-4">
                        <x-trans-textarea field="deskripsi" label="Deskripsi" :kode="$bahasa->kode" :required="$bahasa->is_default" rows="5" placeholder="Deskripsi dalam bahasa {{ $bahasa->nama }}"/>
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div>
                <label for="gambar" class="form-label">Gambar</label>
                <img id="preview-gambar" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                <input type="file" name="gambar" id="gambar" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar')">
                <p class="mt-1.5 text-xs text-gray-400">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                @error('gambar')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">Simpan</button>
                <a href="{{ route('admin.tentang.index') }}" class="btn-outline">Batal</a>
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
