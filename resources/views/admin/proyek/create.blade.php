@extends('layouts.app')

@section('title', 'Tambah Proyek')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.proyek.index') }}">Proyek</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Tambah</span>
            </nav>
            <h1 class="page-title">Tambah Proyek</h1>
            <p class="page-subtitle">Tambahkan proyek baru lengkap beserta tujuan, capaian, kegiatan, linimasa, dan mitra terkait</p>
        </div>
        <a href="{{ route('admin.proyek.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.proyek.store') }}" method="POST" enctype="multipart/form-data"
            x-data="{
                lang: @js($bahasas->first()?->kode),
                tujuan: {
                    @foreach($bahasas as $b)
                        '{{ $b->kode }}': [{ icon: 'fa-solid fa-handshake', deskripsi: '' }],
                    @endforeach
                },
                dampak: {
                    @foreach($bahasas as $b)
                        '{{ $b->kode }}': [{ icon: 'fa-solid fa-chart-line', total_capaian: '', deskripsi: '' }],
                    @endforeach
                },
                kegiatan: {
                    @foreach($bahasas as $b)
                        '{{ $b->kode }}': [{ icon: 'fa-solid fa-calendar-check', deskripsi: '' }],
                    @endforeach
                },
                linimasa: {
                    @foreach($bahasas as $b)
                        '{{ $b->kode }}': [{ tahun: '', deskripsi: '' }],
                    @endforeach
                },
                addTujuan(k) { this.tujuan[k].push({ icon: 'fa-solid fa-handshake', deskripsi: '' }); },
                removeTujuan(k, i) { this.tujuan[k].splice(i, 1); },
                addDampak(k) { this.dampak[k].push({ icon: 'fa-solid fa-chart-line', total_capaian: '', deskripsi: '' }); },
                removeDampak(k, i) { this.dampak[k].splice(i, 1); },
                addKegiatan(k) { this.kegiatan[k].push({ icon: 'fa-solid fa-calendar-check', deskripsi: '' }); },
                removeKegiatan(k, i) { this.kegiatan[k].splice(i, 1); },
                addLinimasa(k) { this.linimasa[k].push({ tahun: '', deskripsi: '' }); },
                removeLinimasa(k, i) { this.linimasa[k].splice(i, 1); }
            }">
            @csrf

            <!-- ================= INFORMASI DASAR ================= -->
            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                1. Tahun, Status & Gambar Utama
            </h3>

            <div class="input-group">
                <div>
                    <label for="tahun" class="form-label">Tahun / Periode <span class="text-rose-500">*</span></label>
                    <input type="text" name="tahun" id="tahun" value="{{ old('tahun', date('Y').' - Sekarang') }}" class="form-input" placeholder="cth: 2024 - Sekarang" required>
                    @error('tahun')
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

                <div>
                    <label for="urutan" class="form-label">Urutan Tampil</label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 1) }}" class="form-input" min="1">
                    @error('urutan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Gambar Utama -->
            <div class="mt-4">
                <label for="gambar_utama" class="form-label">Gambar Utama / Cover Proyek</label>
                <img id="preview-gambar-utama" src="" alt="Preview" class="hidden mb-3 h-44 w-full max-w-md rounded-xl object-cover ring-1 ring-gray-200">
                <input type="file" name="gambar_utama" id="gambar_utama" accept="image/*" class="form-file" onchange="previewImage(this, 'preview-gambar-utama')">
                <p class="mt-1.5 text-xs text-gray-400">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                @error('gambar_utama')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="divider"></div>

            <!-- ================= MITRA TERLIBAT ================= -->
            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                2. Mitra Terlibat / Kolaborator
            </h3>

            <div class="rounded-2xl border border-gray-200 bg-gray-50/60 p-4">
                <p class="text-xs text-gray-500 mb-3">Centang mitra-mitra yang berkolaborasi dalam proyek ini:</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 max-h-60 overflow-y-auto pr-1">
                    @forelse($mitras as $m)
                        <label class="flex items-center gap-2.5 p-2 rounded-xl bg-white border border-gray-200 hover:border-[#97763A] cursor-pointer transition-colors">
                            <input type="checkbox" name="mitra_ids[]" value="{{ $m->id }}" class="form-checkbox text-[#97763A]">
                            <div class="flex items-center gap-2 min-w-0">
                                @if($m->logo)
                                    <img src="{{ asset('storage/mitra/'.$m->logo) }}" alt="logo" class="h-6 w-6 object-contain rounded shrink-0">
                                @endif
                                <span class="text-xs font-semibold text-gray-800 truncate">{{ $m->translateField('nama') }}</span>
                            </div>
                        </label>
                    @empty
                        <p class="text-xs text-gray-400 italic">Belum ada data mitra.</p>
                    @endforelse
                </div>
            </div>

            <div class="divider"></div>

            <!-- ================= INFORMASI DETAIL MULTIBAHASA ================= -->
            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                </svg>
                3. Detail Konten Multibahasa
            </h3>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                @php
                    $req = $bahasa->is_default;
                @endphp
                <x-lang-panel :kode="$bahasa->kode" class="space-y-6">
                    <!-- Judul & Kategori -->
                    <div class="input-group">
                        <x-trans-input field="judul" label="Judul Proyek" :kode="$bahasa->kode" :required="$req" placeholder="cth: BPI Film Market"/>
                        <x-trans-input field="kategori" label="Kategori Proyek" :kode="$bahasa->kode" :required="$req" placeholder="cth: Pasar Film"/>
                    </div>

                    <!-- Deskripsi Singkat & Lengkap -->
                    <div>
                        <x-trans-textarea field="deskripsi_singkat" label="Deskripsi Singkat" :kode="$bahasa->kode" :required="$req" rows="2" placeholder="Ringkasan 1-2 kalimat untuk kartu proyek"/>
                    </div>

                    <div>
                        <x-rich-editor field="deskripsi" label="Deskripsi Lengkap Proyek" :kode="$bahasa->kode" :required="$req" height="220px" placeholder="Penjelasan mendalam mengenai proyek..."/>
                    </div>

                    <!-- Meta Informasi Proyek -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
                        <x-trans-input field="lokasi" label="Lokasi" :kode="$bahasa->kode" :required="$req" placeholder="cth: Jakarta, Indonesia"/>
                        <x-trans-input field="ruang_lingkup" label="Ruang Lingkup" :kode="$bahasa->kode" placeholder="cth: Nasional & Internasional"/>
                        <x-trans-input field="status_proyek" label="Status Proyek" :kode="$bahasa->kode" placeholder="cth: Berjalan"/>
                        <x-trans-input field="icon" label="Icon Font Awesome" :kode="$bahasa->kode" placeholder="cth: fa-solid fa-film"/>
                    </div>

                    <div>
                        <x-trans-input field="timeline" label="Timeline Ringkas" :kode="$bahasa->kode" :required="$req" placeholder="cth: 2022 - Sekarang"/>
                    </div>

                    <!-- SUB-SECTION A: TUJUAN PROYEK -->
                    <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-800">🎯 Tujuan Proyek ({{ $bahasa->nama }})</h4>
                                <p class="text-xs text-gray-500">Poin-poin tujuan strategis dari proyek ini.</p>
                            </div>
                            <button type="button" @click="addTujuan('{{ $bahasa->kode }}')" class="btn-outline text-xs py-1.5 px-3">
                                + Tambah Tujuan
                            </button>
                        </div>
                        <div class="space-y-2.5">
                            <template x-for="(tItem, tIdx) in tujuan['{{ $bahasa->kode }}']" :key="tIdx">
                                <div class="flex items-center gap-2">
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][tujuan][${tIdx}][icon]`" x-model="tItem.icon" class="form-input w-40 text-xs py-2 bg-white shrink-0 font-mono" placeholder="fa-solid fa-handshake">
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][tujuan][${tIdx}][deskripsi]`" x-model="tItem.deskripsi" class="form-input text-xs py-2 bg-white" placeholder="Deskripsi tujuan...">
                                    <button type="button" @click="removeTujuan('{{ $bahasa->kode }}', tIdx)" class="p-2 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- SUB-SECTION B: DAMPAK & CAPAIAN PROYEK -->
                    <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-800">📊 Dampak & Capaian ({{ $bahasa->nama }})</h4>
                                <p class="text-xs text-gray-500">Statistik metrik dan capaian proyek (cth: 1.250+ Peserta).</p>
                            </div>
                            <button type="button" @click="addDampak('{{ $bahasa->kode }}')" class="btn-outline text-xs py-1.5 px-3">
                                + Tambah Capaian
                            </button>
                        </div>
                        <div class="space-y-2.5">
                            <template x-for="(dItem, dIdx) in dampak['{{ $bahasa->kode }}']" :key="dIdx">
                                <div class="flex items-center gap-2">
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][dampak_capaian][${dIdx}][icon]`" x-model="dItem.icon" class="form-input w-36 text-xs py-2 bg-white shrink-0 font-mono" placeholder="fa-solid fa-chart-line">
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][dampak_capaian][${dIdx}][total_capaian]`" x-model="dItem.total_capaian" class="form-input w-28 text-xs py-2 bg-white shrink-0 font-bold" placeholder="cth: 1.250+">
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][dampak_capaian][${dIdx}][deskripsi]`" x-model="dItem.deskripsi" class="form-input text-xs py-2 bg-white" placeholder="Deskripsi capaian...">
                                    <button type="button" @click="removeDampak('{{ $bahasa->kode }}', dIdx)" class="p-2 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- SUB-SECTION C: KEGIATAN UTAMA -->
                    <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-800">⚡ Kegiatan Utama ({{ $bahasa->nama }})</h4>
                                <p class="text-xs text-gray-500">Aktivitas dan format program yang diselenggarakan.</p>
                            </div>
                            <button type="button" @click="addKegiatan('{{ $bahasa->kode }}')" class="btn-outline text-xs py-1.5 px-3">
                                + Tambah Kegiatan
                            </button>
                        </div>
                        <div class="space-y-2.5">
                            <template x-for="(kItem, kIdx) in kegiatan['{{ $bahasa->kode }}']" :key="kIdx">
                                <div class="flex items-center gap-2">
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][kegiatan_utama][${kIdx}][icon]`" x-model="kItem.icon" class="form-input w-40 text-xs py-2 bg-white shrink-0 font-mono" placeholder="fa-solid fa-calendar-check">
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][kegiatan_utama][${kIdx}][deskripsi]`" x-model="kItem.deskripsi" class="form-input text-xs py-2 bg-white" placeholder="cth: Sesi Pitching Proyek">
                                    <button type="button" @click="removeKegiatan('{{ $bahasa->kode }}', kIdx)" class="p-2 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- SUB-SECTION D: LINIMASA PROYEK -->
                    <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 sm:p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-800">📅 Linimasa / Tahapan Proyek ({{ $bahasa->nama }})</h4>
                                <p class="text-xs text-gray-500">Jejak langkah perkembangan proyek dari tahun ke tahun.</p>
                            </div>
                            <button type="button" @click="addLinimasa('{{ $bahasa->kode }}')" class="btn-outline text-xs py-1.5 px-3">
                                + Tambah Linimasa
                            </button>
                        </div>
                        <div class="space-y-2.5">
                            <template x-for="(lItem, lIdx) in linimasa['{{ $bahasa->kode }}']" :key="lIdx">
                                <div class="flex items-center gap-2">
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][linimasa_proyek][${lIdx}][tahun]`" x-model="lItem.tahun" class="form-input w-36 text-xs py-2 bg-white shrink-0 font-bold" placeholder="cth: 2022">
                                    <input type="text" :name="`translations[{{ $bahasa->kode }}][linimasa_proyek][${lIdx}][deskripsi]`" x-model="lItem.deskripsi" class="form-input text-xs py-2 bg-white" placeholder="Deskripsi capaian linimasa...">
                                    <button type="button" @click="removeLinimasa('{{ $bahasa->kode }}', lIdx)" class="p-2 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Simpan Proyek
                </button>
                <a href="{{ route('admin.proyek.index') }}" class="btn-outline">Batal</a>
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
