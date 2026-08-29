@extends('layouts.app')

@section('title', 'Add Stakeholder')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.stakeholder.index') }}">Stakeholder</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Add</span>
            </nav>
            <h1 class="page-title">Add Stakeholder</h1>
            <p class="page-subtitle">Add new organization stakeholder</p>
        </div>
        <a href="{{ route('admin.stakeholder.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.stakeholder.store') }}" method="POST" enctype="multipart/form-data"
            x-data="{ lang: @js($bahasas->first()?->kode) }">
            @csrf

            <div class="input-group">
                <div>
                    <x-icon-picker name="icon" :value="old('icon')" label="Icon Stakeholder" />
                </div>

                <div>
                    <label for="urutan" class="form-label">Order</label>
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
                            <span class="text-sm font-medium text-gray-700">Active</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <x-trans-input field="nama" label="Name" :kode="$bahasa->kode" :required="$bahasa->is_default" placeholder="Name in {{ $bahasa->nama }}"/>
                    <div class="mt-4">
                        <x-trans-textarea field="deskripsi" label="Description" :kode="$bahasa->kode" :required="$bahasa->is_default" rows="4" placeholder="Description in {{ $bahasa->nama }}"/>
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div>
                <label for="gambar" class="form-label">Logo / Association Image <span class="text-xs font-normal text-gray-400">(Main Display Priority)</span></label>
                <img id="preview-gambar" src="" alt="Preview" class="hidden mb-3 h-36 w-auto max-w-xs rounded-xl object-contain bg-white p-2 border border-gray-200">
                <input type="file" name="gambar" id="gambar" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar')">
                <p class="mt-1.5 text-xs text-gray-400">Format: JPG, PNG, WEBP, SVG. Maximum 2MB. If uploaded, the image will appear as the main logo on the landing page.</p>
                @error('gambar')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Save
                </button>
                <a href="{{ route('admin.stakeholder.index') }}" class="btn-outline">Cancel</a>
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
