@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Berita</span>
            </nav>
            <h1 class="page-title">Berita</h1>
            <p class="page-subtitle">Kelola berita dan galerinya ({{ strtoupper(\App\Models\Bahasa::defaultKode()) }} ditampilkan)</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#2B4E94] ring-1 ring-[#2B4E94]/10 shadow-sm">
                <span class="h-1.5 w-1.5 rounded-full bg-[#2B4E94]"></span>
                {{ $items->count() }} Data
            </div>
        </div>
        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('admin.kategori-berita.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-[#132C5C]/20 bg-white px-4 py-2.5 text-xs font-bold text-[#132C5C] shadow-sm hover:bg-[#132C5C]/5 transition-all">
                <svg class="w-4 h-4 text-[#132C5C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Kelola Kategori Berita
            </a>

            <a href="{{ route('admin.tag.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-[#132C5C]/20 bg-white px-4 py-2.5 text-xs font-bold text-[#132C5C] shadow-sm hover:bg-[#132C5C]/5 transition-all">
                <svg class="w-4 h-4 text-[#132C5C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Kelola Tag Berita
            </a>

            <a href="{{ route('admin.berita.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Berita
            </a>
        </div>
    </div>

    @if($items->isEmpty())
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            <h3 class="empty-title">Belum ada data berita</h3>
            <p class="empty-desc">Mulai dengan menambahkan berita baru.</p>
        </div>
    @else
        <div class="table-container">
            <div class="table-scroll">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th class="th">#</th>
                            <th class="th">Judul</th>
                            <th class="th hidden md:table-cell">Kategori</th>
                            <th class="th hidden lg:table-cell">Gambar</th>
                            <th class="th hidden sm:table-cell">Status</th>
                            <th class="th text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($items as $index => $item)
                            <tr class="tr-hover">
                                <td class="td text-gray-500">{{ $index + 1 }}</td>
                                <td class="td font-medium text-gray-900">{{ Str::limit($item->translateField('judul'), 30) }}</td>
                                <td class="td text-gray-500 hidden md:table-cell">
                                    <span class="inline-flex items-center rounded-lg bg-[#97763A]/[0.1] px-2.5 py-1 text-xs font-semibold text-[#97763A]">{{ Str::limit($item->translateField('kategori'), 15) }}</span>
                                </td>
                                <td class="td hidden lg:table-cell">
                                    @if($item->gambar_utama)
                                        <img src="{{ asset('storage/berita/'.$item->gambar_utama) }}" alt="berita" class="thumb" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                        <div class="hidden items-center justify-center h-10 w-10 rounded-lg bg-gray-100">
                                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="td hidden sm:table-cell">
                                    <button onclick="toggleStatus('berita', {{ $item->id }})" class="{{ $item->status == 'published' ? 'badge-published' : 'badge-draft' }} transition-transform hover:scale-105 cursor-pointer">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ ucfirst($item->status == 'published' ? 'published' : 'draft') }}
                                    </button>
                                </td>
                                <td class="td text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.berita.galeri.index', $item->id) }}" class="icon-btn-gold" title="Galeri">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.berita.edit', $item->id) }}" class="icon-btn-edit" title="Edit">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon-btn-delete" title="Hapus">
                                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    @include('admin.partials.toggle-status-script')
@endpush
@endsection
