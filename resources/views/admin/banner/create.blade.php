@extends('layouts.app')

@section('title', 'Add Banner')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.banner.index') }}">Banner</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Add</span>
            </nav>
            <h1 class="page-title">Add Banner</h1>
            <p class="page-subtitle">Add a new banner for the page</p>
        </div>
        <a href="{{ route('admin.banner.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data"
            x-data="{ lang: @js($bahasas->first()?->kode) }">
            @csrf

            <div class="input-group">
                <div>
                    <label for="halaman" class="form-label">Page *</label>
                    <select name="halaman" id="halaman" class="form-select" required>
                        <option value="" disabled {{ old('halaman') ? '' : 'selected' }}>-- Select Website Page --</option>
                        <option value="home" {{ old('halaman') == 'home' ? 'selected' : '' }}>🏠 Homepage (home)</option>
                        <option value="stakeholders" {{ old('halaman') == 'stakeholders' ? 'selected' : '' }}>👥 Stakeholders (stakeholders)</option>
                        <option value="program" {{ old('halaman') == 'program' ? 'selected' : '' }}>📊 Strategic Programs (program)</option>
                        <option value="proyek" {{ old('halaman') == 'proyek' ? 'selected' : '' }}>🎬 Collaboration Projects (proyek)</option>
                        <option value="mitra" {{ old('halaman') == 'mitra' ? 'selected' : '' }}>🤝 Partners (mitra)</option>
                        <option value="berita" {{ old('halaman') == 'berita' ? 'selected' : '' }}>📰 Articles & News (berita)</option>
                        <option value="tentang" {{ old('halaman') == 'tentang' ? 'selected' : '' }}>🏛️ About Us (tentang)</option>
                        <option value="kontak" {{ old('halaman') == 'kontak' ? 'selected' : '' }}>📞 Contact Us (kontak)</option>
                    </select>
                    @error('halaman')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" checked class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Active</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <x-trans-input field="judul" label="Title" :kode="$bahasa->kode" :required="$bahasa->is_default" placeholder="Title in language {{ $bahasa->nama }}"/>
                    <div class="mt-4">
                        <x-trans-textarea field="deskripsi" label="Description" :kode="$bahasa->kode" :required="$bahasa->is_default" placeholder="Description in language {{ $bahasa->nama }}"/>
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div>
                <label for="gambar" class="form-label">Image</label>
                <img id="preview-gambar" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                <input type="file" name="gambar" id="gambar" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar')">
                <p class="mt-1.5 text-xs text-gray-400">Format: JPG, PNG, WEBP. Max 2MB.</p>
                @error('gambar')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">Save</button>
                <a href="{{ route('admin.banner.index') }}" class="btn-outline">Cancel</a>
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
