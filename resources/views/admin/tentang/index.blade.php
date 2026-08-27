@extends('layouts.app')

@section('title', 'Tentang')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Tentang</span>
            </nav>
            <h1 class="page-title">Tentang</h1>
            <p class="page-subtitle">Kelola konten, judul, pilar visi misi, dan status tampil halaman Tentang</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#132C5C] ring-1 ring-[#132C5C]/10 shadow-sm">
                <span class="h-1.5 w-1.5 rounded-full bg-[#132C5C]"></span>
                {{ $items->count() }} Section Terdaftar
            </div>
        </div>
        <a href="{{ route('admin.tentang.create') }}" class="btn-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Section
        </a>
    </div>

    @if($items->isEmpty())
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 10h16M4 14h16M4 18h10"/>
            </svg>
            <h3 class="empty-title">Belum ada data section tentang</h3>
            <p class="empty-desc">Data section tentang belum diinisialisasi.</p>
        </div>
    @else
        <div class="table-container">
            <div class="table-scroll">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th class="th">Section</th>
                            <th class="th">Judul Section</th>
                            <th class="th text-center">Urutan Tampil</th>
                            <th class="th text-center">Status Tampil</th>
                            <th class="th text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @php
                            $tentangLabels = [
                                'intro' => 'Pengantar / Profil',
                                'visi' => 'Visi BPI',
                                'misi' => 'Misi BPI',
                            ];
                        @endphp
                        @foreach($items as $item)
                            <tr class="tr-hover">
                                <td class="td">
                                    <span class="inline-flex items-center rounded-lg bg-[#97763A]/[0.1] px-2.5 py-1 text-xs font-semibold text-[#97763A]">
                                        {{ $tentangLabels[$item->section] ?? ucfirst($item->section) }}
                                        <span class="ml-1 text-[10px] text-gray-400 font-normal">({{ $item->section }})</span>
                                    </span>
                                </td>
                                <td class="td">
                                    <div class="font-medium text-gray-800">{{ $item->translateField('judul') ?? '-' }}</div>
                                    @if($item->section === 'intro' && $item->translateField('subjudul'))
                                        <div class="mt-0.5 text-xs text-gray-500 font-normal">
                                            Headline: <span class="text-gray-700 italic">"{{ $item->translateField('subjudul') }}"</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="td text-center">
                                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-gray-100 text-sm font-bold text-gray-700">{{ $item->urutan }}</span>
                                </td>
                                <td class="td text-center">
                                    <button onclick="toggleStatus('tentang', {{ $item->id }})" class="{{ $item->status ? 'badge-active' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer" title="Klik untuk mengubah status aktif/nonaktif">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="td text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.tentang.edit', $item->id) }}" class="icon-btn-edit" title="Edit Konten & Poin">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.tentang.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
