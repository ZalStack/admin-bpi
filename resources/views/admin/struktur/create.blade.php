@extends('layouts.app')

@section('title', 'Add Organizational Structure Member')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.struktur.index') }}">Organizational Structure</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Add Member</span>
            </nav>
            <h1 class="page-title">Add Member</h1>
            <p class="page-subtitle">Add a new leader, council member, department head, or unit member to the organizational hierarchy</p>
        </div>
        <a href="{{ route('admin.struktur.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.struktur.store') }}" method="POST" enctype="multipart/form-data"
            x-data="{ 
                lang: @js($bahasas->first()?->kode),
                kategori: '{{ old('kategori', 'bidang') }}',
                sub_kategori: '{{ old('sub_kategori', 'bidang') }}'
            }">
            @csrf

            <!-- Name -->
            <div>
                <label for="nama" class="form-label">Full Name *</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-input" placeholder="e.g. Gunawan Paggaru, Slamet Rahardjo" required>
                @error('nama')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Hierarchy Grouping (Kategori, Sub Kategori, Level, Departemen) -->
            <div class="mt-5 p-5 rounded-2xl bg-slate-50/70 border border-slate-200/90 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="kategori" class="form-label font-bold text-slate-800">Category *</label>
                    <select name="kategori" id="kategori" x-model="kategori" class="form-select w-full" required>
                        <option value="pimpinan">Pimpinan Inti (Ketum, Sekjen, Bendum)</option>
                        <option value="dewan">Majelis Dewan (Pengawas, Penasehat, Pakar)</option>
                        <option value="bidang">Bidang Strategis BPI</option>
                        <option value="satgas_pokja">Satgas & Pokja BPI</option>
                        <option value="komite">Komite BPI (e.g. Komite FFI)</option>
                    </select>
                    @error('kategori')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sub_kategori" class="form-label font-bold text-slate-800">Sub-Category</label>
                    <select name="sub_kategori" id="sub_kategori" x-model="sub_kategori" class="form-select w-full">
                        <option value="inti">Pimpinan Inti</option>
                        <option value="wasekjen">Wakil Sekretaris Jenderal</option>
                        <option value="pengawas">Dewan Pengawas</option>
                        <option value="penasehat">Dewan Penasehat</option>
                        <option value="pakar">Dewan Pakar</option>
                        <option value="bidang">Bidang</option>
                        <option value="satgas">Satuan Tugas (Satgas)</option>
                        <option value="pokja">Kelompok Kerja (Pokja)</option>
                        <option value="komite">Komite</option>
                    </select>
                    @error('sub_kategori')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="level" class="form-label font-bold text-slate-800">Hierarchy Level *</label>
                    <select name="level" id="level" class="form-select w-full" required>
                        <option value="1" {{ old('level', '3') == '1' ? 'selected' : '' }}>Tier 1 - Ketum / Anggota Dewan</option>
                        <option value="2" {{ old('level', '3') == '2' ? 'selected' : '' }}>Tier 2 - Sekjen / Bendum / Wasekjen</option>
                        <option value="3" {{ old('level', '3') == '3' ? 'selected' : '' }}>Tier 3 - Ketua Bidang / Unit</option>
                        <option value="4" {{ old('level', '3') == '4' ? 'selected' : '' }}>Tier 4 - Anggota</option>
                    </select>
                    @error('level')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="departemen" class="form-label font-bold text-slate-800">Department / Unit</label>
                    <input type="text" name="departemen" id="departemen" list="departemen-options" value="{{ old('departemen') }}" class="form-input w-full" placeholder="e.g. Bidang Organisasi">
                    <datalist id="departemen-options">
                        <option value="Pimpinan Inti">
                        <option value="Sekretariat Jenderal">
                        <option value="Kebendaharaan Umum">
                        <option value="Dewan Pengawas">
                        <option value="Dewan Penasehat">
                        <option value="Dewan Pakar">
                        <option value="Bidang Organisasi">
                        <option value="Bidang Penelitian">
                        <option value="Bidang Pengembangan SDM">
                        <option value="Bidang Festival">
                        <option value="Bidang Literasi Film">
                        <option value="Bidang Hubungan Internasional">
                        <option value="Bidang Pengembangan Film Daerah">
                        <option value="Bidang Fasilitasi Pembiayaan">
                        <option value="Bidang Pelestarian Film">
                        <option value="Bidang Advokasi Kebijakan">
                        <option value="Bidang Kerjasama">
                        <option value="Bidang Komunikasi">
                        <option value="Bidang Kesekretariatan">
                        <option value="Komite Festival Film Indonesia 2026">
                        <option value="Pokja Kajian dan Advokasi Rencana Induk Perfilman Indonesia">
                        <option value="Satgas Anti Pembajakan">
                        <option value="Pokja Akselerasi Pengembangan SDM">
                        <option value="Pokja Kajian Pelestarian Film">
                        <option value="Pokja Revisi UU Perfilman">
                    </datalist>
                    @error('departemen')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Contact & Social Details -->
            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-input" placeholder="email@bpi.or.id">
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="linkedin" class="form-label">LinkedIn URL</label>
                    <input type="text" name="linkedin" id="linkedin" value="{{ old('linkedin') }}" class="form-input" placeholder="https://linkedin.com/in/username">
                    @error('linkedin')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="instagram" class="form-label">Instagram URL</label>
                    <input type="text" name="instagram" id="instagram" value="{{ old('instagram') }}" class="form-input" placeholder="https://instagram.com/username">
                    @error('instagram')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="telepon" class="form-label">Phone / WhatsApp</label>
                    <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}" class="form-input" placeholder="+628123456789">
                    @error('telepon')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Order & Active Status -->
            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="urutan" class="form-label">Display Order</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 0) }}" class="form-input" min="0">
                    <p class="mt-1 text-xs text-gray-400">Order index (1, 2, 3...) for sorting cards within their tier.</p>
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" checked class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Active (Visible on Website)</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Multilingual Translatable Details -->
            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                <x-lang-panel :kode="$bahasa->kode" class="grid grid-cols-1 gap-4">
                    <x-trans-input field="jabatan" label="Position / Jabatan" :kode="$bahasa->kode" :required="$bahasa->is_default" placeholder="Position in {{ $bahasa->nama }} (e.g. Ketua Umum, Dewan Pengawas, Ketua Bidang Organisasi)"/>
                    
                    <x-trans-input field="departemen" label="Department Name (Translated)" :kode="$bahasa->kode" placeholder="Department name in {{ $bahasa->nama }} (e.g. Organization Department, Supervisory Council)"/>
                    
                    <x-trans-textarea field="deskripsi" label="Biography / Profile Description" :kode="$bahasa->kode" rows="4" placeholder="Brief biography or profile of the member in {{ $bahasa->nama }}..."/>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <!-- Photo Upload -->
            <div>
                <label for="foto" class="form-label">Official Photo</label>
                <img id="preview-foto" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                <input type="file" name="foto" id="foto" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-foto')">
                <p class="mt-1.5 text-xs text-gray-400">Format: JPG, PNG, WEBP. Max 2MB. Recommended ratio: Portrait / Square.</p>
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
                    Save Member
                </button>
                <a href="{{ route('admin.struktur.index') }}" class="btn-outline">Cancel</a>
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