@extends('layouts.app')

@section('title', 'Edit Struktur Organisasi')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.struktur.index') }}">Struktur Organisasi</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit Anggota</h1>
            <p class="page-subtitle">{{ $item->nama }}</p>
        </div>
        <a href="{{ route('admin.struktur.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.struktur.update', $item->id) }}" method="POST" enctype="multipart/form-data"
            x-data="{ lang: @js($bahasas->first()?->kode) }">
            @csrf
            @method('PUT')

            <div>
                <label for="nama" class="form-label">Nama Lengkap *</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $item->nama) }}" class="form-input" placeholder="Nama lengkap" required>
                @error('nama')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="linkedin" class="form-label">LinkedIn</label>
                    <input type="text" name="linkedin" id="linkedin" value="{{ old('linkedin', $item->linkedin) }}" class="form-input" placeholder="https://linkedin.com/in/username">
                    @error('linkedin')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="text" name="instagram" id="instagram" value="{{ old('instagram', $item->instagram) }}" class="form-input" placeholder="https://instagram.com/username">
                    @error('instagram')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $item->email) }}" class="form-input" placeholder="email@example.com">
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="urutan" class="form-label">Urutan</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $item->urutan) }}" class="form-input" min="0">
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" {{ old('status', $item->status) ? 'checked' : '' }} class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <x-trans-input field="jabatan" label="Jabatan" :kode="$bahasa->kode" :required="$bahasa->is_default" :item="$item" placeholder="Jabatan dalam bahasa {{ $bahasa->nama }}"/>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div>
                <label for="foto" class="form-label">Foto</label>
                @if($item->foto)
                    <div class="mb-3" x-data="{ deleting: false }">
                        <p class="mb-1.5 text-xs font-medium text-gray-500">Gambar saat ini:</p>
                        <div class="flex items-start gap-3">
                            <img id="current-foto" src="{{ asset('storage/struktur/'.$item->foto) }}" alt="foto" class="h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                            <button type="button" @click="if(!confirm('Yakin ingin menghapus foto ini?')) return; deleting=true; fetch('{{ route('admin.image.delete') }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'},body:JSON.stringify({model:'StrukturOrganisasi',id:{{ $item->id }},field:'foto'})}).then(r=>r.json()).then(d=>{if(d.success){document.getElementById('current-foto').style.display='none';this.style.display='none';}else{alert(d.message);deleting=false;}}).catch(()=>{alert('Terjadi kesalahan.');deleting=false;})" class="shrink-0 mt-2 inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100 transition-colors" :disabled="deleting">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span x-text="deleting ? 'Menghapus...' : 'Hapus Foto'"></span>
                            </button>
                        </div>
                    </div>
                @endif
                <img id="preview-foto" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                <input type="file" name="foto" id="foto" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-foto')">
                <p class="mt-1.5 text-xs text-gray-400">Kosongkan jika tidak ingin mengubah foto.</p>
                @error('foto')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Update
                </button>
                <a href="{{ route('admin.struktur.index') }}" class="btn-outline">Batal</a>
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
