@extends('layouts.app')

@section('title', 'Mitra')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Mitra</span>
            </nav>
            <h1 class="page-title">Mitra</h1>
            <p class="page-subtitle">Kelola daftar mitra, logo lembaga/organisasi, kategori, dan section intro halaman Mitra</p>
            <div class="mt-3 flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#97763A] ring-1 ring-[#97763A]/10 shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#97763A]"></span>
                    {{ $items->count() }} Mitra Terdaftar
                </span>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('admin.mitra-intro.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-[#132C5C]/20 bg-white px-4 py-2.5 text-xs font-bold text-[#132C5C] shadow-sm hover:bg-[#132C5C]/5 transition-all">
                <svg class="w-4 h-4 text-[#97763A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Intro Halaman Mitra
            </a>

            <a href="{{ route('admin.kategori-mitra.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-[#132C5C]/20 bg-white px-4 py-2.5 text-xs font-bold text-[#132C5C] shadow-sm hover:bg-[#132C5C]/5 transition-all">
                <svg class="w-4 h-4 text-[#132C5C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Kelola Kategori Mitra
            </a>

            <a href="{{ route('admin.mitra.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Mitra
            </a>
        </div>
    </div>

    @if($items->isEmpty())
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="empty-title">Belum ada data mitra</h3>
            <p class="empty-desc">Mulai dengan menambahkan mitra baru.</p>
        </div>
    @else
        <div class="table-container">
            <div class="table-scroll">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th class="th">Logo</th>
                            <th class="th">Nama Mitra</th>
                            <th class="th">Kategori</th>
                            <th class="th hidden lg:table-cell">Website</th>
                            <th class="th text-center">Status</th>
                            <th class="th text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($items as $item)
                            <tr class="tr-hover">
                                <td class="td">
                                    @if($item->logo)
                                        <img src="{{ asset('storage/mitra/'.$item->logo) }}" alt="logo" class="h-10 w-16 object-contain rounded-lg border border-gray-100 bg-white p-1" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                        <div class="hidden items-center justify-center h-10 w-16 rounded-lg bg-gray-100">
                                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center h-10 w-16 rounded-lg bg-gray-50 border border-dashed border-gray-200 text-gray-400 text-xs font-medium">
                                            No Logo
                                        </div>
                                    @endif
                                </td>
                                <td class="td font-medium text-gray-800">{{ $item->translateField('nama') ?: '-' }}</td>
                                <td class="td">
                                    <span class="inline-flex items-center rounded-lg bg-[#97763A]/[0.1] px-2.5 py-1 text-xs font-semibold text-[#97763A]">
                                        {{ ucfirst($item->translateField('kategori') ?: '-') }}
                                    </span>
                                </td>
                                <td class="td hidden lg:table-cell text-sm text-gray-600">
                                    @if($item->website)
                                        <a href="{{ $item->website }}" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1">
                                            {{ Str::limit($item->website, 28) }}
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="td text-center">
                                    <button onclick="toggleStatus('mitra', {{ $item->id }})" class="{{ $item->status ? 'badge-active' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="td text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.mitra.edit', $item->id) }}" class="icon-btn-edit" title="Edit">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.mitra.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
