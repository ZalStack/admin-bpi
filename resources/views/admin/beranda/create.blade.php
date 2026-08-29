@extends('layouts.app')

@section('title', 'Add Homepage')

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
                <span>Add</span>
            </nav>
            <h1 class="page-title">Tambah Section Beranda</h1>
            <p class="page-subtitle">Pilih section beranda serta atur urutan posisi dan status tampil</p>
        </div>
        <a href="{{ route('admin.beranda.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.beranda.store') }}" method="POST">
            @csrf

            <div class="input-group">
                <div>
                    <label for="section" class="form-label">Section <span class="text-rose-500">*</span></label>
                    <select name="section" id="section" class="form-select" required>
                        <option value="" disabled {{ old('section') ? '' : 'selected' }}>-- Pilih Section --</option>
                        <option value="tentang" {{ old('section') == 'tentang' ? 'selected' : '' }}>Tentang Kami (tentang)</option>
                        <option value="struktur" {{ old('section') == 'struktur' ? 'selected' : '' }}>Struktur Organisasi (struktur)</option>
                        <option value="proyek" {{ old('section') == 'proyek' ? 'selected' : '' }}>Proyek Kolaboratif (proyek)</option>
                        <option value="program" {{ old('section') == 'program' ? 'selected' : '' }}>Program Strategis (program)</option>
                        <option value="berita" {{ old('section') == 'berita' ? 'selected' : '' }}>Artikel & Berita (berita)</option>
                        <option value="mitra" {{ old('section') == 'mitra' ? 'selected' : '' }}>Mitra Kerjasama (mitra)</option>
                    </select>
                    @error('section')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="urutan" class="form-label">Urutan Posisi</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 1) }}" class="form-input" min="1">
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status Tampil</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }} class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Tampilkan di Beranda</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Save
                </button>
                <a href="{{ route('admin.beranda.index') }}" class="btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
