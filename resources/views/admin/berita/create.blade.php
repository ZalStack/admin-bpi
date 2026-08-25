@extends('layouts.app')

@section('title', 'Tambah Berita')

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
                <span>Tambah</span>
            </nav>
            <h1 class="page-title">Tambah Berita</h1>
            <p class="page-subtitle">Tambahkan artikel berita baru lengkap dengan format visual, tags, dan konten multibahasa</p>
        </div>
        <a href="{{ route('admin.berita.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data"
            x-data="{ lang: @js($bahasas->first()?->kode) }">
            @csrf

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
                    <input type="text" name="penulis" id="penulis" value="{{ old('penulis', 'BPI') }}" class="form-input" placeholder="cth: Humas BPI / Redaksi" required>
                    @error('penulis')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_publikasi" class="form-label">Tanggal Publikasi <span class="text-rose-500">*</span></label>
                    <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" value="{{ old('tanggal_publikasi', now()->format('Y-m-d')) }}" class="form-input" required>
                    @error('tanggal_publikasi')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status Publikasi</label>
                    <select name="status" id="status" class="form-select">
                        <option value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Gambar Utama -->
            <div class="mt-4">
                <label for="gambar_utama" class="form-label">Gambar Utama / Cover Berita</label>
                <img id="preview-gambar-utama" src="" alt="Preview" class="hidden mb-3 h-48 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                <input type="file" name="gambar_utama" id="gambar_utama" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar-utama')">
                <p class="mt-1.5 text-xs text-gray-400">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
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

            <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                <p class="text-xs text-gray-500 mb-3">Pilih tag yang relevan untuk artikel ini agar mudah dikelompokkan oleh pembaca:</p>
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
                                {{ in_array($tag->id, old('tag_ids', [])) ? 'checked' : '' }}
                                class="form-checkbox text-[#97763A] rounded">
                            <span class="text-xs font-medium text-gray-800 truncate">#{{ $tagName }}</span>
                        </label>
                    @empty
                        <p class="text-xs text-gray-400 italic col-span-full">Belum ada master tag. Tambahkan di menu Master Tag.</p>
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
                        <x-trans-input field="judul" label="Judul Berita" :kode="$bahasa->kode" :required="$req" placeholder="Judul artikel berita dalam bahasa {{ $bahasa->nama }}"/>

                        <div>
                            <label class="form-label">
                                Kategori Berita @if ($req)<span class="text-rose-500">*</span>@endif
                                <span class="text-xs font-normal text-gray-400">({{ strtoupper($bahasa->kode) }})</span>
                            </label>
                            @php
                                $selectedKat = old('translations.'.$bahasa->kode.'.kategori');
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
                                        <option value="{{ $katTitle }}" {{ $selectedKat === $katTitle ? 'selected' : '' }}>
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
                        <x-trans-textarea field="ringkasan" label="Ringkasan Singkat (Excerpt)" :kode="$bahasa->kode" :required="$req" rows="2" placeholder="Ringkasan 1-2 kalimat pengantar berita dalam bahasa {{ $bahasa->nama }}"/>
                    </div>

                    <!-- Rich Text Editor untuk Isi Konten Berita -->
                    <div>
                        <x-rich-editor field="isi" label="Isi Lengkap Berita" :kode="$bahasa->kode" :required="$req" height="300px" placeholder="Tuliskan naskah berita lengkap beserta format teks, poin-poin, dan kutipan..."/>
                    </div>

                    <div>
                        <x-trans-textarea field="kutipan" label="Kutipan Penting / Highlight Quote" :kode="$bahasa->kode" rows="2" placeholder="Kutipan pernyataan tokoh/narasumber penting dalam berita..."/>
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Simpan Berita
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
