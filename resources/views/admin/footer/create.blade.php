@extends('layouts.app')

@section('title', 'Add Footer')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.footer.index') }}">Footer</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Add</span>
            </nav>
            <h1 class="page-title">Add Footer</h1>
            <p class="page-subtitle">Add footer content for the website</p>
        </div>
        <a href="{{ route('admin.footer.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.footer.store') }}" method="POST"
            x-data="{ lang: @js($bahasas->first()?->kode) }">
            @csrf

            <div class="input-group">
                <div>
                    <label for="section" class="form-label">Section *</label>
                    <input type="text" name="section" id="section" value="{{ old('section') }}" class="form-input" placeholder="e.g.: about, information, network" required>
                    @error('section')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="link_url" class="form-label">Link URL</label>
                    <input type="text" name="link_url" id="link_url" value="{{ old('link_url') }}" class="form-input" placeholder="https://example.com or /page">
                    @error('link_url')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="icon" class="form-label">Icon (Font Awesome class)</label>
                    <input type="text" name="icon" id="icon" value="{{ old('icon') }}" class="form-input" placeholder="fa-solid fa-link">
                    @error('icon')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="urutan" class="form-label">Order</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 0) }}" class="form-input" min="0">
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
                    <x-trans-input field="judul" label="Title" :kode="$bahasa->kode" :required="$bahasa->is_default" placeholder="Title in language {{ $bahasa->nama }}"/>
                    <div class="mt-4">
                        <x-trans-textarea field="deskripsi" label="Description" :kode="$bahasa->kode" rows="3" placeholder="Description in language {{ $bahasa->nama }}"/>
                    </div>
                    <x-trans-input field="link_nama" label="Link Name" :kode="$bahasa->kode" placeholder="Link name in language {{ $bahasa->nama }}"/>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Save
                </button>
                <a href="{{ route('admin.footer.index') }}" class="btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
