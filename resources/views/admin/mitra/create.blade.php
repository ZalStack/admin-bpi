@extends('layouts.app')

@section('title', 'Add Partner')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.mitra.index') }}">Partners</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Add</span>
            </nav>
            <h1 class="page-title">Add Partner</h1>
            <p class="page-subtitle">Add new partner data with logo and category</p>
        </div>
        <a href="{{ route('admin.mitra.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
    </div>

    @php
        $initialLang = $bahasas->firstWhere('is_default', true)?->kode ?? $bahasas->first()?->kode;
    @endphp

    <div class="form-card">
        <form action="{{ route('admin.mitra.store') }}" method="POST" enctype="multipart/form-data"
            x-data="{ 
                lang: @js($initialLang),
                selectedCategory: '{{ old('selected_kategori', $kategoris->first()?->slug ?? 'strategis') }}'
            }">
            @csrf

            <div class="input-group">
                <div>
                    <label for="kategori_select" class="form-label">Partner Category <span class="text-red-500">*</span></label>
                    <select id="kategori_select" class="form-select" x-model="selectedCategory" required>
                        @foreach($kategoris as $cat)
                            <option value="{{ $cat->slug }}">{{ $cat->translateField('nama') ?: ucfirst($cat->slug) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="website" class="form-label">Website URL</label>
                    <input type="url" name="website" id="website" value="{{ old('website') }}" class="form-input" placeholder="https://contoh-mitra.com">
                    @error('website')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="urutan" class="form-label">Urutan</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 0) }}" class="form-input" min="0">
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Display Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1" checked class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Active</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Multi-bahasa Nama Mitra -->
            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <!-- Hidden input to pass selected category for each language payload -->
                    <input type="hidden" name="translations[{{ $bahasa->kode }}][kategori]" :value="selectedCategory">
                    
                    <x-trans-input 
                        field="nama" 
                        label="Partner Name" 
                        :kode="$bahasa->kode" 
                        :required="$bahasa->is_default" 
                        placeholder="Partner name in language {{ $bahasa->nama }}"
                    />
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <!-- Upload Logo Mitra -->
            <div>
                <label for="logo" class="form-label">Partner Logo <span class="text-red-500">*</span></label>
                <img id="preview-logo" src="" alt="Preview" class="hidden mb-3 h-28 w-44 rounded-xl object-contain ring-1 ring-gray-200 bg-white p-2">
                <input type="file" name="logo" id="logo" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-logo')" required>
                <p class="mt-1.5 text-xs text-gray-400">Format: PNG, JPG, WEBP, SVG. Max 2MB.</p>
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
                    Save Partner
                </button>
                <a href="{{ route('admin.mitra.index') }}" class="btn-outline">Cancel</a>
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
