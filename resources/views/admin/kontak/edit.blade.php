@extends('layouts.app')

@section('title', 'Edit Kontak')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.kontak.index') }}">Kontak</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit Kontak</h1>
            <p class="page-subtitle">Perbarui informasi kontak perusahaan</p>
        </div>
        <a href="{{ route('admin.kontak.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.kontak.update', $kontak->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="input-group">
                <div>
                    <label for="judul_id" class="form-label">Judul (Indonesia) *</label>
                    <input type="text" name="judul_id" id="judul_id" value="{{ old('judul_id', $kontak->judul_id) }}" class="form-input" placeholder="Judul dalam Bahasa Indonesia" required>
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
                    <input type="text" name="judul_en" id="judul_en" value="{{ old('judul_en', $kontak->judul_en) }}" class="form-input" placeholder="Title in English" required>
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
                    <label for="deskripsi_id" class="form-label">Deskripsi (Indonesia) *</label>
                    <textarea name="deskripsi_id" id="deskripsi_id" rows="3" class="form-textarea" placeholder="Deskripsi dalam Bahasa Indonesia" required>{{ old('deskripsi_id', $kontak->deskripsi_id) }}</textarea>
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
                    <textarea name="deskripsi_en" id="deskripsi_en" rows="3" class="form-textarea" placeholder="Description in English" required>{{ old('deskripsi_en', $kontak->deskripsi_en) }}</textarea>
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
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $kontak->email) }}" class="form-input" placeholder="email@example.com">
                    @error('email')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $kontak->telepon) }}" class="form-input" placeholder="021-1234-5678">
                    @error('telepon')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="whatsapp" class="form-label">WhatsApp</label>
                    <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $kontak->whatsapp) }}" class="form-input" placeholder="0812-3456-7890">
                    @error('whatsapp')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="media_sosial" class="form-label">Media Sosial</label>
                    <input type="text" name="media_sosial" id="media_sosial" value="{{ old('media_sosial', $kontak->media_sosial) }}" class="form-input" placeholder="https://facebook.com/username">
                    @error('media_sosial')
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
                    <label for="alamat_id" class="form-label">Alamat (Indonesia)</label>
                    <textarea name="alamat_id" id="alamat_id" rows="2" class="form-textarea" placeholder="Alamat dalam Bahasa Indonesia">{{ old('alamat_id', $kontak->alamat_id) }}</textarea>
                    @error('alamat_id')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="alamat_en" class="form-label">Alamat (English)</label>
                    <textarea name="alamat_en" id="alamat_en" rows="2" class="form-textarea" placeholder="Address in English">{{ old('alamat_en', $kontak->alamat_en) }}</textarea>
                    @error('alamat_en')
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
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="number" step="0.0000001" name="latitude" id="latitude" value="{{ old('latitude', $kontak->latitude) }}" class="form-input" placeholder="-6.2000000">
                    @error('latitude')
                        <p class="form-error">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="number" step="0.0000001" name="longitude" id="longitude" value="{{ old('longitude', $kontak->longitude) }}" class="form-input" placeholder="106.8000000">
                    @error('longitude')
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

            <div>
                <label for="status" class="form-label">Status</label>
                <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="status" value="1" {{ $kontak->status ? 'checked' : '' }} class="form-checkbox">
                        <span class="text-sm font-medium text-gray-700">Aktif</span>
                    </label>
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
                <a href="{{ route('admin.kontak.index') }}" class="btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
