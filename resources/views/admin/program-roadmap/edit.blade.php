@extends('layouts.app')

@section('title', 'Edit Peta Jalan (Roadmap)')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.program.index') }}">Program</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit Peta Jalan</span>
            </nav>
            <h1 class="page-title">Edit Peta Jalan (Roadmap)</h1>
            <p class="page-subtitle">Tahun {{ $item->tahun }} - {{ $item->translateField('judul') }}</p>
        </div>
        <a href="{{ route('admin.program.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Program
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.program-roadmap.update', $item->id) }}" method="POST" enctype="multipart/form-data"
            x-data="{
                lang: @js($bahasas->first()?->kode),
                items: {
                    @foreach($bahasas as $b)
                        @php
                            $trans = $item->translations->firstWhere('bahasa', $b->kode);
                            $rawItems = $trans?->items ?? [];
                            if (empty($rawItems)) $rawItems = [''];
                        @endphp
                        '{{ $b->kode }}': @js($rawItems),
                    @endforeach
                },
                addItem(kode) {
                    if (!this.items[kode]) this.items[kode] = [];
                    this.items[kode].push('');
                },
                removeItem(kode, index) {
                    this.items[kode].splice(index, 1);
                }
            }">
            @csrf
            @method('PUT')

            <div class="input-group">
                <div>
                    <label for="tahun" class="form-label">Tahun Peta Jalan <span class="text-rose-500">*</span></label>
                    <input type="text" name="tahun" id="tahun" value="{{ old('tahun', $item->tahun) }}" class="form-input" placeholder="cth: 2025 atau 2025 - 2026" required>
                    @error('tahun')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-icon-picker name="icon" :value="old('icon', $item->icon)" label="Icon Peta Jalan" />
                </div>

                <div>
                    <label for="urutan" class="form-label">Urutan</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $item->urutan) }}" class="form-input" min="1">
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1" {{ old('status', $item->status) ? 'checked' : '' }} class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="space-y-5">
                    <x-trans-input field="judul" label="Tema / Judul Peta Jalan" :kode="$bahasa->kode" :required="$bahasa->is_default" :item="$item" placeholder="cth: Fondasi & Konsolidasi"/>

                    <div>
                        <x-trans-textarea field="deskripsi" label="Deskripsi Peta Jalan" :kode="$bahasa->kode" :required="$bahasa->is_default" :item="$item" rows="3" placeholder="Deskripsi fokus peta jalan tahun {{ $bahasa->nama }}"/>
                    </div>

                    <!-- Bullet Points Capaian -->
                    <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-700">
                                    Poin-Poin Capaian (Bullet Points) - Bahasa {{ $bahasa->nama }}
                                </label>
                                <p class="text-xs text-gray-500">Daftar capaian atau fokus inisiatif pada tahun ini.</p>
                            </div>
                            <button type="button" @click="addItem('{{ $bahasa->kode }}')" class="btn-outline text-xs py-1.5 px-3">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Tambah Poin
                            </button>
                        </div>

                        <div class="space-y-2.5">
                            <template x-for="(itemVal, idx) in items['{{ $bahasa->kode }}']" :key="idx">
                                <div class="flex items-center gap-2">
                                    <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white border border-gray-200 text-xs font-bold text-gray-500" x-text="idx + 1"></span>
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][items][]`" x-model="items['{{ $bahasa->kode }}'][idx]" class="form-input py-2 text-sm bg-white" placeholder="cth: Penguatan Kebijakan & Regulasi">
                                    <button type="button" @click="removeItem('{{ $bahasa->kode }}', idx)" class="p-2 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition-colors" title="Hapus baris">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <!-- Optional Image Upload -->
            <div>
                <label for="gambar" class="form-label">Logo / Gambar Peta Jalan <span class="text-xs font-normal text-gray-400">(Prioritas Utama Tampilan)</span></label>
                @if($item->gambar)
                    <div class="mb-3" x-data="{ deleting: false }">
                        <p class="mb-1.5 text-xs font-medium text-gray-500">Logo saat ini:</p>
                        <div class="flex items-start gap-3">
                            <img id="current-gambar" src="{{ asset('storage/program/'.$item->gambar) }}" alt="peta jalan" class="h-28 w-auto max-w-xs rounded-xl object-contain bg-white p-2 border border-gray-200 ring-1 ring-gray-100">
                            <button type="button" @click="if(!confirm('Yakin ingin menghapus gambar ini?')) return; deleting=true; fetch('{{ route('admin.image.delete') }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'},body:JSON.stringify({model:'ProgramRoadmap',id:{{ $item->id }},field:'gambar'})}).then(r=>r.json()).then(d=>{if(d.success){document.getElementById('current-gambar').style.display='none';this.style.display='none';}else{alert(d.message);deleting=false;}}).catch(()=>{alert('Terjadi kesalahan.');deleting=false;})" class="shrink-0 mt-2 inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100 transition-colors" :disabled="deleting">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span x-text="deleting ? 'Menghapus...' : 'Hapus Gambar'"></span>
                            </button>
                        </div>
                    </div>
                @endif
                <img id="preview-gambar" src="" alt="Preview" class="hidden mb-3 h-28 w-auto max-w-xs rounded-xl object-contain bg-white p-2 border border-gray-200">
                <input type="file" name="gambar" id="gambar" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar')">
                <p class="mt-1.5 text-xs text-gray-400">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, WEBP, SVG. Maksimal 2MB.</p>
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
                    Update Peta Jalan
                </button>
                <a href="{{ route('admin.program.index') }}" class="btn-outline">Batal</a>
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
