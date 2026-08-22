@extends('layouts.app')

@section('title', 'Edit Proyek')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.proyek.index') }}">Proyek</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit Proyek</h1>
            <p class="page-subtitle">Perbarui informasi proyek</p>
        </div>
        <a href="{{ route('admin.proyek.index') }}" class="btn-outline">Kembali</a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.proyek.update', $proyek->id) }}" method="POST" enctype="multipart/form-data"
            x-data="{ lang: @js($bahasas->first()?->kode) }">
            @csrf
            @method('PUT')

            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Tahun & Status
            </h3>

            <div class="input-group">
                <div>
                    <label for="tahun" class="form-label">Tahun *</label>
                    <input type="text" name="tahun" id="tahun" value="{{ old('tahun', $proyek->tahun) }}" class="form-input" placeholder="2024" required>
                    @error('tahun')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="draft" {{ old('status', $proyek->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $proyek->status) == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ old('status', $proyek->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="urutan" class="form-label">Urutan</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $proyek->urutan) }}" class="form-input">
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="divider"></div>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                @php($req = $bahasa->is_default)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Konten Bahasa {{ $bahasa->nama }}</h4>

                    <div class="input-group">
                        <x-trans-input field="judul" label="Judul" :kode="$bahasa->kode" :required="$req" placeholder="Judul dalam bahasa {{ $bahasa->nama }}" :item="$proyek"/>
                        <x-trans-input field="kategori" label="Kategori" :kode="$bahasa->kode" :required="$req" placeholder="{{ $req ? 'cth: Infrastruktur' : 'Category' }}" :item="$proyek"/>
                    </div>

                    <x-trans-textarea field="deskripsi_singkat" label="Deskripsi Singkat" :kode="$bahasa->kode" :required="$req" rows="3" placeholder="Deskripsi singkat dalam bahasa {{ $bahasa->nama }}" :item="$proyek"/>

                    <div class="mt-4">
                        <x-trans-textarea field="deskripsi" label="Deskripsi Lengkap" :kode="$bahasa->kode" :required="$req" rows="5" placeholder="Deskripsi lengkap dalam bahasa {{ $bahasa->nama }}" :item="$proyek"/>
                    </div>

                    <div class="mt-4">
                        <x-trans-input field="lokasi" label="Lokasi" :kode="$bahasa->kode" :required="$req" placeholder="{{ $req ? 'cth: Jakarta' : 'e.g: Jakarta' }}" :item="$proyek"/>
                    </div>

                    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
                        <x-trans-textarea field="tujuan" label="Tujuan" :kode="$bahasa->kode" :required="$req" rows="3" placeholder="Tujuan dalam bahasa {{ $bahasa->nama }}" :item="$proyek"/>
                        <x-trans-textarea field="dampak" label="Dampak" :kode="$bahasa->kode" :required="$req" rows="3" placeholder="Dampak dalam bahasa {{ $bahasa->nama }}" :item="$proyek"/>
                        <x-trans-textarea field="kegiatan_utama" label="Kegiatan Utama" :kode="$bahasa->kode" :required="$req" rows="3" placeholder="Kegiatan utama dalam bahasa {{ $bahasa->nama }}" :item="$proyek"/>
                    </div>

                    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                        <x-trans-textarea field="capaian" label="Capaian" :kode="$bahasa->kode" :required="$req" rows="3" placeholder="Capaian dalam bahasa {{ $bahasa->nama }}" :item="$proyek"/>
                        <x-trans-textarea field="timeline" label="Timeline" :kode="$bahasa->kode" :required="$req" rows="3" placeholder="Timeline dalam bahasa {{ $bahasa->nama }}" :item="$proyek"/>
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Gambar Utama
            </h3>

            <div>
                @if($proyek->gambar_utama)
                    <div class="mb-3">
                        <p class="mb-1.5 text-xs font-medium text-gray-500">Gambar saat ini:</p>
                        <img src="{{ asset('storage/proyek/'.$proyek->gambar_utama) }}" alt="proyek" class="h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                    </div>
                @endif
                <img id="preview-gambar-utama" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                <input type="file" name="gambar_utama" id="gambar_utama" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar-utama')">
                <p class="mt-1.5 text-xs text-gray-400">Kosongkan jika tidak ingin mengubah gambar.</p>
                @error('gambar_utama')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">Update</button>
                <a href="{{ route('admin.proyek.index') }}" class="btn-outline">Batal</a>
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
