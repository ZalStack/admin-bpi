@extends('layouts.app')

@section('title', 'Edit Banner')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.banner.index') }}">Banner</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit Banner</h1>
            <p class="page-subtitle">{{ $item->translateField('judul') }}</p>
        </div>
        <a href="{{ route('admin.banner.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.banner.update', $item->id) }}" method="POST" enctype="multipart/form-data"
            x-data="{ lang: @js($bahasas->first()?->kode) }">
            @csrf
            @method('PUT')

            <div class="input-group">
                <div>
                    <label for="halaman" class="form-label">Page *</label>
                    <select name="halaman" id="halaman" class="form-select" required>
                        <option value="home" {{ old('halaman', $item->halaman) == 'home' ? 'selected' : '' }}>🏠 Homepage (home)</option>
                        <option value="stakeholders" {{ old('halaman', $item->halaman) == 'stakeholders' ? 'selected' : '' }}>👥 Stakeholders (stakeholders)</option>
                        <option value="program" {{ old('halaman', $item->halaman) == 'program' ? 'selected' : '' }}>📊 Strategic Programs (program)</option>
                        <option value="proyek" {{ old('halaman', $item->halaman) == 'proyek' ? 'selected' : '' }}>🎬 Collaboration Projects (proyek)</option>
                        <option value="mitra" {{ old('halaman', $item->halaman) == 'mitra' ? 'selected' : '' }}>🤝 Partners (mitra)</option>
                        <option value="berita" {{ old('halaman', $item->halaman) == 'berita' ? 'selected' : '' }}>📰 Articles & News (berita)</option>
                        <option value="tentang" {{ old('halaman', $item->halaman) == 'tentang' ? 'selected' : '' }}>🏛️ About Us (tentang)</option>
                        <option value="kontak" {{ old('halaman', $item->halaman) == 'kontak' ? 'selected' : '' }}>📞 Contact Us (kontak)</option>
                    </select>
                    @error('halaman')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" {{ $item->status ? 'checked' : '' }} class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Active</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <x-trans-input field="judul" label="Title" :kode="$bahasa->kode" :required="$bahasa->is_default" :item="$item" placeholder="Title in language {{ $bahasa->nama }}"/>
                    <div class="mt-4">
                        <x-trans-textarea field="deskripsi" label="Description" :kode="$bahasa->kode" :required="$bahasa->is_default" :item="$item" placeholder="Description in language {{ $bahasa->nama }}"/>
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div>
                <label for="gambar" class="form-label">Image</label>
                @if($item->gambar)
                    <div class="mb-3" x-data="{ deleting: false }">
                        <p class="mb-1.5 text-xs font-medium text-gray-500">Current image:</p>
                        <div class="flex items-start gap-3">
                            <img id="current-gambar" src="{{ asset('storage/banners/'.$item->gambar) }}" alt="banner" class="h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                            <button type="button" @click="if(!confirm('Are you sure you want to delete this image?')) return; deleting=true; fetch('{{ route('admin.image.delete') }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'},body:JSON.stringify({model:'BannerHalaman',id:{{ $item->id }},field:'gambar'})}).then(r=>r.json()).then(d=>{if(d.success){document.getElementById('current-gambar').style.display='none';this.style.display='none';}else{alert(d.message);deleting=false;}}).catch(()=>{alert('An error occurred.');deleting=false;})" class="shrink-0 mt-2 inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100 transition-colors" :disabled="deleting">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span x-text="deleting ? 'Deleting...' : 'Delete Image'"></span>
                            </button>
                        </div>
                    </div>
                @endif
                <img id="preview-gambar" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                <input type="file" name="gambar" id="gambar" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar')">
                <p class="mt-1.5 text-xs text-gray-400">Leave empty if you don't want to change the image.</p>
                @error('gambar')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">Update</button>
                <a href="{{ route('admin.banner.index') }}" class="btn-outline">Cancel</a>
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
