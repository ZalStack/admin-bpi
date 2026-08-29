@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Homepage</span>
            </nav>
            <h1 class="page-title">Homepage</h1>
            <p class="page-subtitle">Kelola urutan tampil dan status aktif/tidak aktif section pada halaman beranda</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#132C5C] ring-1 ring-[#132C5C]/10 shadow-sm">
                <span class="h-1.5 w-1.5 rounded-full bg-[#132C5C]"></span>
                {{ $items->count() }} Section Terdaftar
            </div>
        </div>
        <a href="{{ route('admin.beranda.create') }}" class="btn-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Section
        </a>
    </div>

    @if($items->isEmpty())
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="empty-title">Belum ada section beranda</h3>
            <p class="empty-desc">Data section halaman beranda belum diinisialisasi.</p>
        </div>
    @else
        <div class="table-container">
            <div class="table-scroll">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th class="th">Nama Section</th>
                            <th class="th text-center">Urutan Tampil</th>
                            <th class="th text-center">Status Tampil</th>
                            <th class="th text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @php
                            $sectionLabels = [
                                'tentang' => 'Tentang Kami',
                                'struktur' => 'Struktur Organisasi',
                                'proyek' => 'Proyek Kolaboratif',
                                'program' => 'Program Strategis',
                                'berita' => 'Artikel & Berita',
                                'mitra' => 'Mitra Kerjasama',
                            ];
                        @endphp
                        @foreach($items as $item)
                            <tr class="tr-hover">
                                <td class="td">
                                    <div class="flex items-center gap-2.5">
                                        <span class="inline-flex items-center rounded-lg bg-[#97763A]/[0.1] px-2.5 py-1 text-xs font-semibold text-[#97763A] uppercase font-mono">{{ $item->section }}</span>
                                        <span class="text-sm font-semibold text-gray-800">{{ $sectionLabels[$item->section] ?? ucfirst($item->section) }}</span>
                                    </div>
                                </td>
                                <td class="td text-center">
                                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-gray-100 text-sm font-bold text-gray-700">{{ $item->urutan }}</span>
                                </td>
                                <td class="td text-center">
                                     <button onclick="toggleStatus('beranda', {{ $item->id }})" class="{{ $item->status ? 'badge-active' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer" title="Click to toggle active/inactive status">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="td text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                         <a href="{{ route('admin.beranda.edit', $item->id) }}" class="icon-btn-edit" title="Edit Title & Order">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                         <form action="{{ route('admin.beranda.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this data?')">
                                            @csrf
                                            @method('DELETE')
                                             <button type="submit" class="icon-btn-delete" title="Delete">
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
