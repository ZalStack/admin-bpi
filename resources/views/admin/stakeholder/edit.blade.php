@extends('layouts.app')

@section('title', 'Edit Stakeholder')

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
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit Stakeholder</h1>
            <p class="page-subtitle">Perbarui data stakeholder organisasi</p>
        </div>
        <a href="{{ route('admin.stakeholder.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.stakeholder.update', $stakeholder->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="input-group">
                <div>
                    <label for="nama_id" class="form-label">Nama (Indonesia) *</label>
                    <input type="text" name="nama_id" id="nama_id" value="{{ old('nama_id', $stakeholder->nama_id) }}" class="form-input" placeholder="Nama dalam Bahasa Indonesia" required>
                    @error('nama_id')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="nama_en" class="form-label">Nama (English) *</label>
                    <input type="text" name="nama_en" id="nama_en" value="{{ old('nama_en', $stakeholder->nama_en) }}" class="form-input" placeholder="Name in English" required>
                    @error('nama_en')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="mt-4 grid grid-cols-1 gap-4">
                <div>
                    <label for="deskripsi_id" class="form-label">Deskripsi (Indonesia) *</label>
                    <textarea name="deskripsi_id" id="deskripsi_id" rows="4" class="form-textarea" placeholder="Deskripsi dalam Bahasa Indonesia" required>{{ old('deskripsi_id', $stakeholder->deskripsi_id) }}</textarea>
                    @error('deskripsi_id')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="deskripsi_en" class="form-label">Deskripsi (English) *</label>
                    <textarea name="deskripsi_en" id="deskripsi_en" rows="4" class="form-textarea" placeholder="Description in English" required>{{ old('deskripsi_en', $stakeholder->deskripsi_en) }}</textarea>
                    @error('deskripsi_en')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="divider"></div>

            <div class="input-group">
                <div>
                    <label for="icon" class="form-label">Icon</label>
                    <input type="text" name="icon" id="icon" value="{{ old('icon', $stakeholder->icon) }}" class="form-input" placeholder="fa-solid fa-user">
                    @error('icon')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="gambar" class="form-label">Gambar</label>
                    @if($stakeholder->gambar)
                        <div class="mb-3">
                            <p class="mb-1.5 text-xs font-medium text-gray-500">Gambar saat ini:</p>
                            <img src="{{ asset('storage/stakeholder/'.$stakeholder->gambar) }}" alt="stakeholder" class="h-32 w-full max-w-sm rounded-xl object-cover ring-1 ring-gray-200">
                        </div>
                    @endif
                    <img id="preview-gambar" src="" alt="Preview" class="hidden mb-3 h-32 w-full max-w-sm rounded-xl object-cover ring-1 ring-gray-200">
                    <input type="file" name="gambar" id="gambar" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar')">
                    <p class="mt-1.5 text-xs text-gray-400">Kosongkan jika tidak ingin mengubah gambar.</p>
                    @error('gambar')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="urutan" class="form-label">Urutan</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $stakeholder->urutan) }}" class="form-input">
                    @error('urutan')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" {{ $stakeholder->status ? 'checked' : '' }} class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Aktif</span>
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
                    Update
                </button>
                <a href="{{ route('admin.stakeholder.index') }}" class="btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
