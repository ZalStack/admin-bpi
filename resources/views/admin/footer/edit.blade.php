@extends('layouts.app')

@section('title', 'Edit Footer')

@section('content')
<div class="max-w-3xl">
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
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit Footer</h1>
            <p class="page-subtitle">Perbarui konten footer website</p>
        </div>
        <a href="{{ route('admin.footer.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.footer.update', $footer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="input-group">
                <div>
                    <label for="section" class="form-label">Section *</label>
                    <input type="text" name="section" id="section" value="{{ old('section', $footer->section) }}" class="form-input" placeholder="cth: about, contact, social" required>
                    @error('section')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="judul_id" class="form-label">Judul (Indonesia) *</label>
                    <input type="text" name="judul_id" id="judul_id" value="{{ old('judul_id', $footer->judul_id) }}" class="form-input" placeholder="Judul dalam Bahasa Indonesia" required>
                    @error('judul_id')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="judul_en" class="form-label">Judul (English) *</label>
                    <input type="text" name="judul_en" id="judul_en" value="{{ old('judul_en', $footer->judul_en) }}" class="form-input" placeholder="Title in English" required>
                    @error('judul_en')
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

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="deskripsi_id" class="form-label">Deskripsi (Indonesia)</label>
                    <textarea name="deskripsi_id" id="deskripsi_id" rows="3" class="form-textarea" placeholder="Deskripsi dalam Bahasa Indonesia">{{ old('deskripsi_id', $footer->deskripsi_id) }}</textarea>
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
                    <label for="deskripsi_en" class="form-label">Deskripsi (English)</label>
                    <textarea name="deskripsi_en" id="deskripsi_en" rows="3" class="form-textarea" placeholder="Description in English">{{ old('deskripsi_en', $footer->deskripsi_en) }}</textarea>
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="link_nama_id" class="form-label">Link Nama (Indonesia)</label>
                    <input type="text" name="link_nama_id" id="link_nama_id" value="{{ old('link_nama_id', $footer->link_nama_id) }}" class="form-input" placeholder="Nama link dalam Bahasa Indonesia">
                    @error('link_nama_id')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="link_nama_en" class="form-label">Link Nama (English)</label>
                    <input type="text" name="link_nama_en" id="link_nama_en" value="{{ old('link_nama_en', $footer->link_nama_en) }}" class="form-input" placeholder="Link name in English">
                    @error('link_nama_en')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="link_url" class="form-label">Link URL</label>
                    <input type="text" name="link_url" id="link_url" value="{{ old('link_url', $footer->link_url) }}" class="form-input" placeholder="https://example.com atau /halaman">
                    @error('link_url')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="icon" class="form-label">Icon</label>
                    <input type="text" name="icon" id="icon" value="{{ old('icon', $footer->icon) }}" class="form-input" placeholder="fa-solid fa-home">
                    @error('icon')
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
                    <label for="urutan" class="form-label">Urutan</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $footer->urutan) }}" class="form-input" min="0">
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
                            <input type="checkbox" name="status" value="1" {{ $footer->status ? 'checked' : '' }} class="form-checkbox">
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
                <a href="{{ route('admin.footer.index') }}" class="btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
