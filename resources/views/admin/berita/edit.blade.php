@extends('layouts.app')

@section('title', 'Edit News')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.berita.index') }}">News</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit News</h1>
            <p class="page-subtitle">Update news article, multilingual content, tags, and gallery</p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('admin.berita.galeri.index', $item->id) }}" class="btn-gold text-xs py-2 px-3.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Manage Gallery ({{ $item->galeri->count() }})
            </a>
            <a href="{{ route('admin.berita.index') }}" class="btn-outline">Back</a>
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
                1. General Information
            </h3>

            <div class="input-group">
                <div>
                    <label for="penulis" class="form-label">Author <span class="text-rose-500">*</span></label>
                    <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $item->penulis) }}" class="form-input" placeholder="Author name" required>
                    @error('penulis')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_publikasi" class="form-label">Publication Date <span class="text-rose-500">*</span></label>
                    <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" value="{{ old('tanggal_publikasi', $item->tanggal_publikasi?->format('Y-m-d')) }}" class="form-input" required>
                    @error('tanggal_publikasi')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Publication Status</label>
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
                <label for="gambar_utama" class="form-label">Main Image / News Cover</label>
                @if($item->gambar_utama)
                    <div class="mb-3" x-data="{ deleting: false }">
                        <p class="mb-1.5 text-xs font-medium text-gray-500">Current image:</p>
                        <div class="flex items-start gap-3">
                            <img id="current-gambar_utama" src="{{ asset('storage/berita/'.$item->gambar_utama) }}" alt="berita" class="h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                            <button type="button" @click="if(!confirm('Are you sure you want to delete this image?')) return; deleting=true; fetch('{{ route('admin.image.delete') }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'},body:JSON.stringify({model:'Berita',id:{{ $item->id }},field:'gambar_utama'})}).then(r=>r.json()).then(d=>{if(d.success){document.getElementById('current-gambar_utama').style.display='none';this.style.display='none';}else{alert(d.message);deleting=false;}}).catch(()=>{alert('An error occurred.');deleting=false;})" class="shrink-0 mt-2 inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100 transition-colors" :disabled="deleting">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span x-text="deleting ? 'Deleting...' : 'Delete Image'"></span>
                            </button>
                        </div>
                    </div>
                @endif
                <img id="preview-gambar-utama" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                <input type="file" name="gambar_utama" id="gambar_utama" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar-utama')">
                <p class="mt-1.5 text-xs text-gray-400">Leave empty if you don't want to change the image.</p>
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
                2. News Tags & Topics
            </h3>

            @php
                $selectedTagIds = old('tag_ids', $item->tags->pluck('id')->toArray());
            @endphp

            <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                <p class="text-xs text-gray-500 mb-3">Check tags related to this article:</p>
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
                        <p class="text-xs text-gray-400 italic col-span-full">No master tags yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="divider"></div>

            <!-- ================= KONTEN DETAIL MULTIBAHASA ================= -->
            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                </svg>
                3. Multilingual Article Content
            </h3>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                @php
                    $req = $bahasa->is_default;
                @endphp
                <x-lang-panel :kode="$bahasa->kode" class="space-y-5">
                    <div class="input-group">
                        <x-trans-input field="judul" label="News Title" :kode="$bahasa->kode" :required="$req" placeholder="News article title in {{ $bahasa->nama }}" :item="$item"/>

                        <div>
                            <label class="form-label">
                                News Category @if ($req)<span class="text-rose-500">*</span>@endif
                                <span class="text-xs font-normal text-gray-400">({{ strtoupper($bahasa->kode) }})</span>
                            </label>
                            @php
                                $katVal = old('translations.'.$bahasa->kode.'.kategori', $item->translationFor($bahasa->kode)?->kategori ?? '');
                            @endphp
                            <select name="translations[{{ $bahasa->kode }}][kategori]"
                                class="form-select"
                                {{ $req ? 'required' : '' }}>
                                <option value="">-- Select Category ({{ strtoupper($bahasa->kode) }}) --</option>
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
                        <x-trans-textarea field="ringkasan" label="Short Summary (Excerpt)" :kode="$bahasa->kode" :required="$req" rows="2" placeholder="1-2 sentence summary in {{ $bahasa->nama }}" :item="$item"/>
                    </div>

                    <!-- Rich Text Editor untuk Isi Konten Berita -->
                    <div>
                        <x-rich-editor field="isi" label="Full News Content" :kode="$bahasa->kode" :required="$req" height="300px" placeholder="Write the full news article..." :item="$item"/>
                    </div>

                    <div>
                        <x-trans-textarea field="kutipan" label="Key Quotes / Highlight Quote" :kode="$bahasa->kode" rows="2" placeholder="Quotes in {{ $bahasa->nama }}" :item="$item"/>
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Update News
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn-outline">Cancel</a>
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
