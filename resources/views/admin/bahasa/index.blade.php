@extends('layouts.app')

@section('title', 'Pengaturan Bahasa')

@section('content')
<div class="max-w-2xl">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Pengaturan Bahasa</span>
            </nav>
            <h1 class="page-title">Pengaturan Bahasa</h1>
            <p class="page-subtitle">Atur bahasa default dan bahasa yang tersedia pada website</p>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.bahasa.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="bahasa_default" class="form-label">Bahasa Default *</label>
                <select name="bahasa_default" id="bahasa_default" class="form-select">
                    <option value="id" {{ $pengaturan && $pengaturan->bahasa_default == 'id' ? 'selected' : '' }}>Indonesia</option>
                    <option value="en" {{ $pengaturan && $pengaturan->bahasa_default == 'en' ? 'selected' : '' }}>English</option>
                </select>
                @error('bahasa_default')
                    <p class="form-error">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="form-label">Bahasa Tersedia</label>
                <div class="space-y-3 rounded-xl border border-gray-200 bg-gray-50/60 p-4">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" name="bahasa_tersedia_id" value="id" {{ $pengaturan && strpos($pengaturan->bahasa_tersedia, 'id') !== false ? 'checked' : '' }} class="form-checkbox">
                        <span class="text-sm text-gray-700 font-medium group-hover:text-gray-900">Indonesia</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" name="bahasa_tersedia_en" value="en" {{ $pengaturan && strpos($pengaturan->bahasa_tersedia, 'en') !== false ? 'checked' : '' }} class="form-checkbox">
                        <span class="text-sm text-gray-700 font-medium group-hover:text-gray-900">English</span>
                    </label>
                </div>
                <input type="hidden" name="bahasa_tersedia" id="bahasa_tersedia" value="{{ $pengaturan ? $pengaturan->bahasa_tersedia : 'id,en' }}">
                @error('bahasa_tersedia')
                    <p class="form-error">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" name="status" value="1" {{ $pengaturan && $pengaturan->status ? 'checked' : '' }} class="form-checkbox">
                    <span class="text-sm text-gray-700 font-medium group-hover:text-gray-900">Aktifkan Multibahasa</span>
                </label>
            </div>

            <div class="divider"></div>

            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                Simpan Pengaturan
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('input[name="bahasa_tersedia_id"], input[name="bahasa_tersedia_en"]').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const idChecked = document.querySelector('input[name="bahasa_tersedia_id"]')?.checked;
        const enChecked = document.querySelector('input[name="bahasa_tersedia_en"]')?.checked;
        const hiddenInput = document.getElementById('bahasa_tersedia');
        const languages = [];
        if (idChecked) languages.push('id');
        if (enChecked) languages.push('en');
        hiddenInput.value = languages.join(',');
    });
});
</script>
@endpush
@endsection
