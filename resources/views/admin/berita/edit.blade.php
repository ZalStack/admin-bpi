@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.berita.index') }}">Berita</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit Berita</h1>
            <p class="page-subtitle">Perbarui artikel berita, konten multibahasa, tags, dan galeri</p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('admin.berita.galeri.index', $item->id) }}" class="btn-gold text-xs py-2 px-3.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Kelola Galeri ({{ $item->galeri->count() }})
            </a>
            <a href="{{ route('admin.berita.index') }}" class="btn-outline">Kembali</a>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.berita.update', $item->id) }}" method="POST" enctype="multipart/form-data"
            x-data="{ lang: @js($bahasas->first()?->kode) }">
            @csrf
            @method('PUT')

            <!-- ================= INFORMASI UMUM ================= -->
            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                1. Informasi Umum
            </h3>

            <div class="input-group">
                <div>
                    <label for="penulis" class="form-label">Penulis <span class="text-rose-500">*</span></label>
                    <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $item->penulis) }}" class="form-input" placeholder="Nama penulis" required>
                    @error('penulis')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_publikasi" class="form-label">Tanggal Publikasi <span class="text-rose-500">*</span></label>
                    <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" value="{{ old('tanggal_publikasi', $item->tanggal_publikasi?->format('Y-m-d')) }}" class="form-input" required>
                    @error('tanggal_publikasi')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status Publikasi</label>
                    <select name="status" id="status" class="form-select">
                        <option value="published" {{ old('status', $item->status) == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', $item->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="archived" {{ old('status', $item->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Gambar Utama -->
            <div class="mt-4">
                <label for="gambar_utama" class="form-label">Gambar Utama / Cover Berita</label>
                @if($item->gambar_utama)
                    <div class="mb-3">
                        <p class="mb-1.5 text-xs font-medium text-gray-500">Gambar saat ini:</p>
                        <img src="{{ asset('storage/berita/'.$item->gambar_utama) }}" alt="berita" class="h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                    </div>
                @endif
                <img id="preview-gambar-utama" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                <input type="file" name="gambar_utama" id="gambar_utama" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar-utama')">
                <p class="mt-1.5 text-xs text-gray-400">Kosongkan jika tidak ingin mengubah gambar.</p>
                @error('gambar_utama')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="divider"></div>

            <!-- ================= TAGS / TOPIK BERITA ================= -->
            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                2. Tag & Topik Berita
            </h3>

            @php
                $selectedTagIds = old('tag_ids', $item->tags->pluck('id')->toArray());
            @endphp

            <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                <p class="text-xs text-gray-500 mb-3">Centang tag terkait artikel ini:</p>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2.5 max-h-56 overflow-y-auto pr-1">
                    @forelse($tags as $tag)
                        @php
                            $tagName = $tag->translations->firstWhere('bahasa', app()->getLocale())?->tag
                                ?? $tag->translations->firstWhere('bahasa', 'id')?->tag
                                ?? $tag->translations->first()?->tag
                                ?? $tag->slug;
                        @endphp
                        <label class="flex items-center gap-2 p-2.5 rounded-xl bg-white border border-gray-200 hover:border-[#97763A] cursor-pointer transition-all hover:shadow-xs">
                            <input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}"
                                {{ in_array($tag->id, $selectedTagIds) ? 'checked' : '' }}
                                class="form-checkbox text-[#97763A] rounded">
                            <span class="text-xs font-medium text-gray-800 truncate">#{{ $tagName }}</span>
                        </label>
                    @empty
                        <p class="text-xs text-gray-400 italic col-span-full">Belum ada master tag.</p>
                    @endforelse
                </div>
            </div>

            <div class="divider"></div>

            <!-- ================= KONTEN DETAIL MULTIBAHASA ================= -->
            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                </svg>
                3. Konten Artikel Multibahasa
            </h3>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                @php
                    $req = $bahasa->is_default;
                @endphp
                <x-lang-panel :kode="$bahasa->kode" class="space-y-5">
                    <div class="input-group">
                        <x-trans-input field="judul" label="Judul Berita" :kode="$bahasa->kode" :required="$req" placeholder="Judul artikel berita dalam bahasa {{ $bahasa->nama }}" :item="$item"/>

                        <div>
                            <label class="form-label">
                                Kategori Berita @if ($req)<span class="text-rose-500">*</span>@endif
                                <span class="text-xs font-normal text-gray-400">({{ strtoupper($bahasa->kode) }})</span>
                            </label>
                            @php
                                $katVal = old('translations.'.$bahasa->kode.'.kategori', $item->translationFor($bahasa->kode)?->kategori ?? '');
                            @endphp
                            <select name="translations[{{ $bahasa->kode }}][kategori]"
                                class="form-select"
                                {{ $req ? 'required' : '' }}>
                                <option value="">-- Pilih Kategori ({{ strtoupper($bahasa->kode) }}) --</option>
                                @foreach($kategoris as $kat)
                                    @php
                                        $katTitle = $kat->translations->firstWhere('bahasa', $bahasa->kode)?->judul
                                            ?? $kat->translations->firstWhere('bahasa', 'id')?->judul
                                            ?? $kat->translations->first()?->judul;
                                    @endphp
                                    @if($katTitle)
                                        <option value="{{ $katTitle }}" {{ $katVal === $katTitle ? 'selected' : '' }}>
                                            {{ $katTitle }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('translations.'.$bahasa->kode.'.kategori')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <x-trans-textarea field="ringkasan" label="Ringkasan Singkat (Excerpt)" :kode="$bahasa->kode" :required="$req" rows="2" placeholder="Ringkasan 1-2 kalimat dalam bahasa {{ $bahasa->nama }}" :item="$item"/>
                    </div>

                    <!-- Rich Text Editor untuk Isi Konten Berita -->
                    <div>
                        <x-rich-editor field="isi" label="Isi Lengkap Berita" :kode="$bahasa->kode" :required="$req" height="300px" placeholder="Tuliskan naskah berita lengkap..." :item="$item"/>
                    </div>

                    <div>
                        <x-trans-textarea field="kutipan" label="Kutipan Penting / Highlight Quote" :kode="$bahasa->kode" rows="2" placeholder="Kutipan dalam bahasa {{ $bahasa->nama }}" :item="$item"/>
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Update Berita
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn-outline">Batal</a>
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
