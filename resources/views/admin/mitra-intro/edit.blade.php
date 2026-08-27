@extends('layouts.app')

@section('title', 'Intro Halaman Mitra')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.mitra.index') }}">Mitra</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Intro Halaman Mitra</span>
            </nav>
            <h1 class="page-title">Intro Halaman Mitra</h1>
            <p class="page-subtitle">Atur judul section, subjudul headline, deskripsi, dan foto pengantar pada halaman Mitra</p>
        </div>
        <a href="{{ route('admin.mitra.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Mitra
        </a>
    </div>

    @php
        $initialLang = $bahasas->firstWhere('is_default', true)?->kode ?? $bahasas->first()?->kode;
    @endphp

    <div class="form-card">
        <form action="{{ route('admin.mitra-intro.update', $item->id) }}" method="POST" enctype="multipart/form-data"
            x-data="{ lang: @js($initialLang) }">
            @csrf
            @method('PUT')

            <div class="input-group">
                <div>
                    <label class="form-label">Section</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-200 bg-gray-100 px-3.5">
                        <span class="inline-flex items-center rounded-lg bg-[#97763A]/[0.15] px-2.5 py-1 text-xs font-bold text-[#97763A] uppercase">
                            INTRO MITRA
                        </span>
                    </div>
                </div>

                <div>
                    <label for="status" class="form-label">Status Tampil</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1" {{ old('status', $item->status) ? 'checked' : '' }} class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Tampilkan Seksi Intro di Landing Page</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Multi-bahasa Fields: Judul (Badge), Subjudul (Headline), Deskripsi -->
            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <x-trans-input 
                            field="judul" 
                            label="Judul Section (Badge)" 
                            :kode="$bahasa->kode" 
                            :required="$bahasa->is_default" 
                            :item="$item"
                            placeholder="cth: Mitra Kami"
                        />
                        <x-trans-input 
                            field="subjudul" 
                            label="Subjudul / Headline Utama" 
                            :kode="$bahasa->kode" 
                            :required="$bahasa->is_default" 
                            :item="$item"
                            placeholder="cth: Kolaborasi Membangun Masa Depan Perfilman Indonesia"
                        />
                    </div>
                    <div class="mt-2">
                        <x-trans-textarea 
                            field="deskripsi" 
                            label="Deskripsi Lengkap" 
                            :kode="$bahasa->kode" 
                            :required="$bahasa->is_default" 
                            rows="4" 
                            :item="$item"
                            placeholder="Deskripsi kemitraan dalam bahasa {{ $bahasa->nama }}"
                        />
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <!-- Upload Foto Section Intro Mitra -->
            <div>
                <label for="gambar" class="form-label">Foto / Gambar Intro</label>
                @if($item->gambar)
                    <div class="mb-3" x-data="{ deleting: false }">
                        <p class="mb-1.5 text-xs font-medium text-gray-500">Gambar saat ini:</p>
                        <div class="flex items-start gap-3">
                            <img id="current-gambar" src="{{ asset('storage/mitra/'.$item->gambar) }}" alt="intro mitra" class="h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200 shadow-sm">
                            <button type="button" @click="if(!confirm('Yakin ingin menghapus gambar ini?')) return; deleting=true; fetch('{{ route('admin.image.delete') }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'},body:JSON.stringify({model:'MitraIntro',id:{{ $item->id }},field:'gambar'})}).then(r=>r.json()).then(d=>{if(d.success){document.getElementById('current-gambar').style.display='none';this.style.display='none';}else{alert(d.message);deleting=false;}}).catch(()=>{alert('Terjadi kesalahan.');deleting=false;})" class="shrink-0 mt-2 inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100 transition-colors" :disabled="deleting">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span x-text="deleting ? 'Menghapus...' : 'Hapus Gambar'"></span>
                            </button>
                        </div>
                    </div>
                @endif
                <img id="preview-gambar" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200 shadow-sm">
                <input type="file" name="gambar" id="gambar" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar')">
                <p class="mt-1.5 text-xs text-gray-400">Kosongkan jika tidak ingin mengubah foto. Format: JPG, PNG, WEBP max 2MB.</p>
                @error('gambar')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Simpan Pengaturan Intro
                </button>
                <a href="{{ route('admin.mitra.index') }}" class="btn-outline">Batal</a>
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
