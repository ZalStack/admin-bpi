@extends('layouts.app')

@section('title', 'Pengaturan Bahasa')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Pengaturan Bahasa</span>
            </nav>
            <h1 class="page-title">Pengaturan Bahasa</h1>
            <p class="page-subtitle">Kelola daftar bahasa yang tersedia pada website</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <div class="table-container">
                <div class="table-scroll">
                    <table class="table" x-data="{ editing: null }">
                        <thead class="thead">
                            <tr>
                                <th class="th">Kode</th>
                                <th class="th">Nama</th>
                                <th class="th hidden sm:table-cell">Status</th>
                                <th class="th text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($items as $bahasa)
                                <tr class="tr-hover" x-show="editing !== '{{ $bahasa->kode }}'">
                                    <td class="td">
                                        <span class="inline-flex items-center rounded-lg bg-[#2B4E94]/10 px-2.5 py-1 font-mono text-xs font-bold uppercase text-[#2B4E94]">{{ $bahasa->kode }}</span>
                                    </td>
                                    <td class="td font-medium text-gray-900">
                                        {{ $bahasa->nama }}
                                        @if ($bahasa->is_default)
                                            <span class="ml-2 inline-flex items-center rounded-full bg-[#97763A]/15 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-[#97763A]">Default</span>
                                        @endif
                                    </td>
                                    <td class="td hidden sm:table-cell">
                                        <button onclick="toggleBahasa('{{ $bahasa->kode }}')" class="{{ $bahasa->aktif ? 'badge-active' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer" {{ $bahasa->is_default ? 'disabled title="Bahasa default tidak dapat dinonaktifkan"' : '' }}>
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            {{ $bahasa->aktif ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </td>
                                    <td class="td text-right">
                                        <div class="flex items-center justify-end gap-1.5">
                                            @unless ($bahasa->is_default)
                                                <form action="{{ route('admin.bahasa.set-default', $bahasa->kode) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="icon-btn-gold !h-8 !w-8" title="Jadikan Default">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endunless
                                            <button type="button" class="icon-btn-edit !h-8 !w-8" title="Edit" @click="editing = editing === '{{ $bahasa->kode }}' ? null : '{{ $bahasa->kode }}'">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            @unless ($bahasa->is_default)
                                                <form action="{{ route('admin.bahasa.destroy', $bahasa->kode) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus bahasa ini? Semua terjemahan dalam bahasa ini akan ikut terhapus.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="icon-btn-delete !h-8 !w-8" title="Hapus">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endunless
                                        </div>
                                    </td>
                                </tr>
                                <tr x-show="editing === '{{ $bahasa->kode }}'" x-cloak>
                                    <td colspan="4" class="td bg-gray-50/60">
                                        <form action="{{ route('admin.bahasa.update', $bahasa->kode) }}" method="POST" class="flex flex-wrap items-end gap-3 p-2">
                                            @csrf
                                            @method('PUT')
                                            <div class="flex-1 min-w-[200px]">
                                                <label class="form-label">Nama Bahasa *</label>
                                                <input type="text" name="nama" value="{{ old('nama', $bahasa->nama) }}" class="form-input" required>
                                                @error('nama')
                                                    <p class="form-error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <label class="flex h-[46px] items-center gap-2 cursor-pointer">
                                                <input type="hidden" name="aktif" value="0">
                                                <input type="checkbox" name="aktif" value="1" {{ old('aktif', $bahasa->aktif) ? 'checked' : '' }} class="form-checkbox" {{ $bahasa->is_default ? 'checked disabled' : '' }}>
                                                <span class="text-sm font-medium text-gray-700">Aktif</span>
                                            </label>
                                            <button type="submit" class="btn-primary">Simpan</button>
                                            <button type="button" class="btn-outline" @click="editing = null">Batal</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div>
            <div class="form-card">
                <h3 class="section-label">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Bahasa
                </h3>

                <form action="{{ route('admin.bahasa.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="kode" class="form-label">Kode *</label>
                        <input type="text" name="kode" id="kode" value="{{ old('kode') }}" class="form-input font-mono uppercase" placeholder="cth: jp" maxlength="5" required>
                        <p class="mt-1.5 text-xs text-gray-400">Kode ISO 2-5 karakter, cth: id, en, jp.</p>
                        @error('kode')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nama" class="form-label">Nama Bahasa *</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-input" placeholder="cth: Japan" required>
                        @error('nama')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="aktif" value="0">
                            <input type="checkbox" name="aktif" value="1" checked class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Langsung aktif</span>
                        </label>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center">Tambahkan</button>
                </form>
            </div>

            <div class="mt-4 rounded-xl border border-blue-100 bg-blue-50/60 p-4 text-xs leading-relaxed text-gray-600">
                <p class="font-semibold text-[#2B4E94]">Catatan:</p>
                <ul class="mt-1.5 list-disc space-y-1 pl-4">
                    <li>Bahasa default tidak dapat dinonaktifkan atau dihapus.</li>
                    <li>Menghapus bahasa akan menghapus semua terjemahan dalam bahasa tersebut.</li>
                    <li>Konten utama tersimpan netral; terjemahan diisi per tab bahasa pada setiap halaman CMS.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleBahasa(kode) {
    fetch(`/admin/bahasa/${kode}/toggle-status`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
    })
    .then(res => res.json().then(data => ({ ok: res.ok, data })))
    .then(({ ok, data }) => {
        if (!ok) {
            alert(data.message || 'Gagal mengubah status bahasa.');
            return;
        }
        window.location.reload();
    })
    .catch(() => alert('Terjadi kesalahan jaringan.'));
}
</script>
@endpush
@endsection
