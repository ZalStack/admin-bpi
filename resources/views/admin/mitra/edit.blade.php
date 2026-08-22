@extends('layouts.app')

@section('title', 'Edit Mitra')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.mitra.index') }}">Mitra</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit Mitra</h1>
            <p class="page-subtitle">{{ $item->translateField('nama') }}</p>
        </div>
        <a href="{{ route('admin.mitra.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.mitra.update', $item->id) }}" method="POST" enctype="multipart/form-data"
            x-data="{ lang: @js($bahasas->first()?->kode) }">
            @csrf
            @method('PUT')

            <div class="input-group">
                <div>
                    <label for="website" class="form-label">Website</label>
                    <input type="text" name="website" id="website" value="{{ old('website', $item->website) }}" class="form-input" placeholder="https://...">
                    @error('website')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="urutan" class="form-label">Urutan</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $item->urutan) }}" class="form-input">
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" {{ old('status', $item->status) ? 'checked' : '' }} class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <x-trans-input field="nama" label="Nama" :kode="$bahasa->kode" :required="$bahasa->is_default" :item="$item" placeholder="Nama dalam bahasa {{ $bahasa->nama }}"/>
                    <div class="mt-4">
                        <x-trans-input field="kategori" label="Kategori" :kode="$bahasa->kode" :required="$bahasa->is_default" :item="$item" placeholder="Kategori dalam bahasa {{ $bahasa->nama }}"/>
                    </div>
                    <div class="mt-4">
                        <x-trans-textarea field="deskripsi" label="Deskripsi" :kode="$bahasa->kode" :required="$bahasa->is_default" rows="4" :item="$item" placeholder="Deskripsi dalam bahasa {{ $bahasa->nama }}"/>
                    </div>
                    <div class="mt-4">
                        <x-trans-textarea field="alamat" label="Alamat" :kode="$bahasa->kode" rows="2" :item="$item" placeholder="Alamat dalam bahasa {{ $bahasa->nama }}"/>
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div>
                <label for="logo" class="form-label">Logo</label>
                @if($item->logo)
                    <div class="mb-3">
                        <p class="mb-1.5 text-xs font-medium text-gray-500">Gambar saat ini:</p>
                        <img src="{{ asset('storage/mitra/'.$item->logo) }}" alt="logo" class="h-24 w-24 rounded-xl object-contain ring-1 ring-gray-200 bg-white">
                    </div>
                @endif
                <img id="preview-logo" src="" alt="Preview" class="hidden mb-3 h-32 w-32 rounded-xl object-contain ring-1 ring-gray-200 bg-white">
                <input type="file" name="logo" id="logo" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-logo')">
                <p class="mt-1.5 text-xs text-gray-400">Kosongkan jika tidak ingin mengubah gambar.</p>
                @error('logo')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Update
                </button>
                <a href="{{ route('admin.mitra.index') }}" class="btn-outline">Batal</a>
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
