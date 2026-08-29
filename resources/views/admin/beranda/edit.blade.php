@extends('layouts.app')

@section('title', 'Edit Homepage')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.beranda.index') }}">Homepage</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit Homepage Section</h1>
            <p class="page-subtitle">Set display title, position order, and active status for section <strong>{{ ucfirst($item->section) }}</strong></p>
        </div>
        <a href="{{ route('admin.beranda.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.beranda.update', $item->id) }}" method="POST"
            x-data="{ lang: @js($bahasas->first()?->kode) }">
            @csrf
            @method('PUT')

            <input type="hidden" name="section" value="{{ $item->section }}">

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
                    <label for="urutan" class="form-label">Display Order (Position)</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $item->urutan) }}" class="form-input" min="1" required>
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Display Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1" {{ old('status', $item->status) ? 'checked' : '' }} class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Show on Landing Page</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <x-trans-input field="judul" label="Section Title" :kode="$bahasa->kode" :required="$bahasa->is_default" :item="$item" placeholder="Section title in language {{ $bahasa->nama }}"/>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Save Changes
                </button>
                <a href="{{ route('admin.beranda.index') }}" class="btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
