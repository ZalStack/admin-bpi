@extends('layouts.app')

@section('title', 'Tambah Kontak')

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.kontak.index') }}">Kontak</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Tambah</span>
            </nav>
            <h1 class="page-title">Tambah Kontak</h1>
            <p class="page-subtitle">Kelola informasi kontak, media sosial, email, dan telepon</p>
        </div>
        <a href="{{ route('admin.kontak.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card" x-data="{
        lang: @js($bahasas->first()?->kode),
        socialMedia: [
            { platform: 'instagram', username: '@bpi.indonesia', url: 'https://instagram.com/bpi.indonesia' },
            { platform: 'youtube', username: 'bpitv', url: 'https://youtube.com/@bpitv' },
            { platform: 'facebook', username: 'bpindonesia', url: 'https://facebook.com/bpindonesia' },
            { platform: 'linkedin', username: 'bpiindonesia', url: 'https://linkedin.com/company/bpiindonesia' }
        ],
        emails: [
            { email: 'info@bpi.or.id', description: 'Respon cepat untuk pertanyaan resmi dan kerjasama.', url: 'mailto:info@bpi.or.id' }
        ],
        phones: [
            { number: '+62 878 3992 0990', type: 'whatsapp', url: 'https://wa.me/6287839920990' },
            { number: '+62 878 3991 0991', type: 'whatsapp', url: 'https://wa.me/6287839910991' }
        ],
        addSocialMedia() {
            this.socialMedia.push({ platform: 'instagram', username: '', url: '' });
        },
        removeSocialMedia(index) {
            this.socialMedia.splice(index, 1);
        },
        addEmail() {
            this.emails.push({ email: '', description: '', url: '' });
        },
        removeEmail(index) {
            this.emails.splice(index, 1);
        },
        addPhone() {
            this.phones.push({ number: '', type: 'whatsapp', url: '' });
        },
        removePhone(index) {
            this.phones.splice(index, 1);
        }
    }">
        <form action="{{ route('admin.kontak.store') }}" method="POST">
            @csrf

            <!-- ================= SECTION 1: LOKASI & KOORDINAT ================= -->
            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                1. Lokasi & Koordinat Peta
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude', '-6.2500000') }}" class="form-input" placeholder="-6.2500000">
                    @error('latitude')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude', '106.8500000') }}" class="form-input" placeholder="106.8500000">
                    @error('longitude')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" checked class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <!-- ================= SECTION 2: MEDIA SOSIAL ================= -->
            <div class="flex items-center justify-between">
                <h3 class="section-label mb-0">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    2. Media Sosial
                </h3>
                <button type="button" @click="addSocialMedia()" class="btn-outline text-xs py-1.5 px-3">
                    + Tambah Akun Medsos
                </button>
            </div>
            <p class="text-xs text-gray-500 mt-1 mb-3">Daftar media sosial resmi organisasi (Instagram, YouTube, Facebook, LinkedIn, TikTok, dll.)</p>

            <div class="space-y-3">
                <template x-for="(sm, idx) in socialMedia" :key="idx">
                    <div class="p-3.5 rounded-2xl border border-gray-200 bg-gray-50/70 flex flex-col md:flex-row items-start md:items-center gap-3">
                        <div class="w-full md:w-44 shrink-0">
                            <label class="block text-[11px] font-semibold text-gray-500 uppercase mb-1">Platform</label>
                            <select :name="`social_media[${idx}][platform]`" x-model="sm.platform" class="form-select text-xs py-2 bg-white" required>
                                <option value="instagram">Instagram</option>
                                <option value="youtube">YouTube</option>
                                <option value="facebook">Facebook</option>
                                <option value="linkedin">LinkedIn</option>
                                <option value="tiktok">TikTok</option>
                                <option value="twitter">Twitter / X</option>
                                <option value="website">Website</option>
                            </select>
                        </div>
                        <div class="w-full md:w-56 shrink-0">
                            <label class="block text-[11px] font-semibold text-gray-500 uppercase mb-1">Username / Handle</label>
                            <input type="text" :name="`social_media[${idx}][username]`" x-model="sm.username" class="form-input text-xs py-2 bg-white" placeholder="cth: @bpi.indonesia" required>
                        </div>
                        <div class="flex-1 w-full">
                            <label class="block text-[11px] font-semibold text-gray-500 uppercase mb-1">URL Profil (Opsional, otomatis bila kosong)</label>
                            <input type="text" :name="`social_media[${idx}][url]`" x-model="sm.url" class="form-input text-xs py-2 bg-white" placeholder="https://instagram.com/bpi.indonesia">
                        </div>
                        <div class="self-end md:self-center pt-2 md:pt-4">
                            <button type="button" @click="removeSocialMedia(idx)" class="p-2 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                </template>
            </div>

            <div class="divider"></div>

            <!-- ================= SECTION 3: EMAIL KONTAK ================= -->
            <div class="flex items-center justify-between">
                <h3 class="section-label mb-0">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    3. Alamat Email
                </h3>
                <button type="button" @click="addEmail()" class="btn-outline text-xs py-1.5 px-3">
                    + Tambah Email
                </button>
            </div>
            <p class="text-xs text-gray-500 mt-1 mb-3">Daftar email resmi untuk korespondensi dan pertanyaan.</p>

            <div class="space-y-3">
                <template x-for="(em, idx) in emails" :key="idx">
                    <div class="p-3.5 rounded-2xl border border-gray-200 bg-gray-50/70 flex flex-col md:flex-row items-start md:items-center gap-3">
                        <div class="w-full md:w-60 shrink-0">
                            <label class="block text-[11px] font-semibold text-gray-500 uppercase mb-1">Alamat Email</label>
                            <input type="email" :name="`email[${idx}][email]`" x-model="em.email" class="form-input text-xs py-2 bg-white" placeholder="info@bpi.or.id" required>
                        </div>
                        <div class="flex-1 w-full">
                            <label class="block text-[11px] font-semibold text-gray-500 uppercase mb-1">Deskripsi / Peruntukan</label>
                            <input type="text" :name="`email[${idx}][description]`" x-model="em.description" class="form-input text-xs py-2 bg-white" placeholder="Respon cepat untuk pertanyaan resmi dan kerjasama.">
                        </div>
                        <div class="w-full md:w-56 shrink-0">
                            <label class="block text-[11px] font-semibold text-gray-500 uppercase mb-1">URL Mailto (Opsional)</label>
                            <input type="text" :name="`email[${idx}][url]`" x-model="em.url" class="form-input text-xs py-2 bg-white" placeholder="mailto:info@bpi.or.id">
                        </div>
                        <div class="self-end md:self-center pt-2 md:pt-4">
                            <button type="button" @click="removeEmail(idx)" class="p-2 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                </template>
            </div>

            <div class="divider"></div>

            <!-- ================= SECTION 4: NOMOR TELEPON & WHATSAPP ================= -->
            <div class="flex items-center justify-between">
                <h3 class="section-label mb-0">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    4. Nomor Telepon & WhatsApp
                </h3>
                <button type="button" @click="addPhone()" class="btn-outline text-xs py-1.5 px-3">
                    + Tambah Nomor
                </button>
            </div>
            <p class="text-xs text-gray-500 mt-1 mb-3">Nomor kontak telepon atau WhatsApp hotline.</p>

            <div class="space-y-3">
                <template x-for="(ph, idx) in phones" :key="idx">
                    <div class="p-3.5 rounded-2xl border border-gray-200 bg-gray-50/70 flex flex-col md:flex-row items-start md:items-center gap-3">
                        <div class="w-full md:w-56 shrink-0">
                            <label class="block text-[11px] font-semibold text-gray-500 uppercase mb-1">Nomor Kontak</label>
                            <input type="text" :name="`phone[${idx}][number]`" x-model="ph.number" class="form-input text-xs py-2 bg-white" placeholder="+62 878 3992 0990" required>
                        </div>
                        <div class="w-full md:w-44 shrink-0">
                            <label class="block text-[11px] font-semibold text-gray-500 uppercase mb-1">Tipe</label>
                            <select :name="`phone[${idx}][type]`" x-model="ph.type" class="form-select text-xs py-2 bg-white">
                                <option value="whatsapp">WhatsApp</option>
                                <option value="phone">Telepon Kantor</option>
                                <option value="hotline">Hotline</option>
                                <option value="fax">Fax</option>
                            </select>
                        </div>
                        <div class="flex-1 w-full">
                            <label class="block text-[11px] font-semibold text-gray-500 uppercase mb-1">URL Click-to-Action (Opsional, otomatis bila kosong)</label>
                            <input type="text" :name="`phone[${idx}][url]`" x-model="ph.url" class="form-input text-xs py-2 bg-white" placeholder="https://wa.me/6287839920990">
                        </div>
                        <div class="self-end md:self-center pt-2 md:pt-4">
                            <button type="button" @click="removePhone(idx)" class="p-2 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                </template>
            </div>

            <div class="divider"></div>

            <!-- ================= SECTION 5: JUDUL HALAMAN KONTAK ================= -->
            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                </svg>
                5. Judul Halaman Kontak (Multibahasa)
            </h3>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                @php
                    $req = $bahasa->is_default;
                @endphp
                <x-lang-panel :kode="$bahasa->kode" class="space-y-4">
                    <x-trans-input field="judul" label="Judul Halaman Kontak" :kode="$bahasa->kode" :required="$req" placeholder="cth: Hubungi Kami / Contact Us"/>
                </x-lang-panel>
            @endforeach

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Simpan Kontak
                </button>
                <a href="{{ route('admin.kontak.index') }}" class="btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
