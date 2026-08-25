@extends('layouts.app')

@section('title', 'Program & Peta Jalan')

@section('content')
<div class="space-y-10">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Program</span>
            </nav>
            <h1 class="page-title">Program & Peta Jalan</h1>
            <p class="page-subtitle">Kelola pilar program strategis, sub-poin program, dan peta jalan 4 tahun ke depan</p>
            <div class="mt-3 flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#97763A] ring-1 ring-[#97763A]/10 shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#97763A]"></span>
                    {{ $items->count() }} Program Pilar
                </span>
                <span class="inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#244E96] ring-1 ring-[#244E96]/10 shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#244E96]"></span>
                    {{ $roadmaps->count() }} Peta Jalan (Roadmap)
                </span>
            </div>
        </div>

        <div class="flex items-center">
            <a href="{{ route('admin.program.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Program
            </a>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- TABEL 1: PILAR PROGRAM STRATEGIS                                          -->
    <!-- ========================================================================= -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#97763A]/10 text-[#97763A]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-900">1. Pilar Program Strategis</h2>
                    <p class="text-xs text-gray-500">Daftar pilar program beserta sub-poinnya (dikelola langsung di form edit program)</p>
                </div>
            </div>
        </div>

        @if($items->isEmpty())
            <div class="empty-state">
                <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="empty-title">Belum ada data program</h3>
                <p class="empty-desc">Mulai dengan menambahkan program pilar baru.</p>
            </div>
        @else
            <div class="table-container">
                <div class="table-scroll">
                    <table class="table">
                        <thead class="thead">
                            <tr>
                                <th class="th">Icon / Gambar</th>
                                <th class="th">Judul Program</th>
                                <th class="th">Sub-Poin Program</th>
                                <th class="th hidden sm:table-cell">Urutan</th>
                                <th class="th hidden md:table-cell">Status</th>
                                <th class="th text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach($items as $item)
                                <tr class="tr-hover">
                                    <td class="td">
                                        <div class="flex items-center gap-3">
                                            @if($item->gambar)
                                                <img src="{{ asset('storage/program/'.$item->gambar) }}" alt="program" class="h-10 w-10 object-cover rounded-lg border border-gray-200">
                                            @elseif($item->icon)
                                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-rose-50 text-[#68001C] border border-rose-100 font-mono text-xs" title="{{ $item->icon }}">
                                                    <i class="{{ $item->icon }} text-base"></i>
                                                </div>
                                            @else
                                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-50 text-gray-400 border border-dashed border-gray-200 text-xs">
                                                    -
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="td">
                                        <div class="font-bold text-gray-900">{{ $item->translateField('judul') }}</div>
                                        <div class="text-xs text-gray-500 line-clamp-1 mt-0.5">{{ Str::limit($item->translateField('deskripsi'), 60) }}</div>
                                    </td>
                                    <td class="td">
                                        @if($item->poin && $item->poin->count() > 0)
                                            <div class="flex flex-col gap-1 max-w-xs">
                                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#97763A]">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-[#97763A]"></span>
                                                    {{ $item->poin->count() }} Poin Terdaftar:
                                                </span>
                                                <ul class="text-[11px] text-gray-600 list-disc list-inside space-y-0.5">
                                                    @foreach($item->poin->take(3) as $p)
                                                        <li class="truncate">{{ $p->translateField('judul') }}</li>
                                                    @endforeach
                                                    @if($item->poin->count() > 3)
                                                        <li class="text-gray-400 italic">+{{ $item->poin->count() - 3 }} poin lainnya</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-400 italic">Belum ada poin</span>
                                        @endif
                                    </td>
                                    <td class="td hidden sm:table-cell">
                                        <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-gray-100 text-sm font-bold text-gray-600">{{ $item->urutan }}</span>
                                    </td>
                                    <td class="td hidden md:table-cell">
                                        <button onclick="toggleStatus('program', {{ $item->id }})" class="{{ $item->status ? 'badge-active' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            {{ $item->status ? 'Active' : 'Inactive' }}
                                        </button>
                                    </td>
                                    <td class="td text-right">
                                        <div class="flex items-center justify-end gap-1.5">
                                            <a href="{{ route('admin.program.edit', $item->id) }}" class="icon-btn-edit" title="Edit Program & Poin">
                                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.program.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus program ini beserta seluruh poinnya?')">
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

    <!-- ========================================================================= -->
    <!-- TABEL 2: PETA JALAN 4 TAHUN (ROADMAP)                                      -->
    <!-- ========================================================================= -->
    <div class="space-y-4 pt-4 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#244E96]/10 text-[#244E96]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-900">2. Peta Jalan 4 Tahun (Roadmap)</h2>
                    <p class="text-xs text-gray-500">Rencana strategis tahapan capaian ekosistem perfilman nasional per tahun</p>
                </div>
            </div>

            <a href="{{ route('admin.program-roadmap.create') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-[#244E96] px-3.5 py-2 text-xs font-bold text-white shadow-sm hover:bg-[#1b3d79] transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Peta Jalan
            </a>
        </div>

        @if($roadmaps->isEmpty())
            <div class="empty-state">
                <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="empty-title">Belum ada data peta jalan</h3>
                <p class="empty-desc">Tambahkan peta jalan 4 tahun untuk ditampilkan di landing page.</p>
            </div>
        @else
            <div class="table-container">
                <div class="table-scroll">
                    <table class="table">
                        <thead class="thead">
                            <tr>
                                <th class="th">Tahun</th>
                                <th class="th">Tema / Judul</th>
                                <th class="th">Poin Capaian Tahunan</th>
                                <th class="th hidden sm:table-cell">Urutan</th>
                                <th class="th hidden md:table-cell">Status</th>
                                <th class="th text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach($roadmaps as $r)
                                <tr class="tr-hover">
                                    <td class="td">
                                        <span class="inline-flex items-center rounded-lg bg-[#244E96]/10 px-2.5 py-1 text-xs font-black text-[#244E96]">
                                            {{ $r->tahun }}
                                        </span>
                                    </td>
                                    <td class="td">
                                        <div class="font-bold text-gray-900">{{ $r->translateField('judul') }}</div>
                                        <div class="text-xs text-gray-500 line-clamp-1 mt-0.5">{{ Str::limit($r->translateField('deskripsi'), 60) }}</div>
                                    </td>
                                    <td class="td">
                                        @php
                                            $defaultKode = \App\Models\Bahasa::defaultKode();
                                            $trans = $r->translations->firstWhere('bahasa', $defaultKode);
                                            $rItems = $trans?->items ?? [];
                                        @endphp
                                        @if(!empty($rItems) && is_array($rItems))
                                            <div class="flex flex-wrap gap-1 max-w-sm">
                                                @foreach($rItems as $it)
                                                    <span class="inline-flex items-center rounded-md bg-gray-100 px-2 py-0.5 text-[11px] font-medium text-gray-700">
                                                        • {{ $it }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-400 italic">Belum ada poin</span>
                                        @endif
                                    </td>
                                    <td class="td hidden sm:table-cell">
                                        <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-gray-100 text-sm font-bold text-gray-600">{{ $r->urutan }}</span>
                                    </td>
                                    <td class="td hidden md:table-cell">
                                        <button onclick="toggleStatus('program-roadmap', {{ $r->id }})" class="{{ $r->status ? 'badge-active' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            {{ $r->status ? 'Active' : 'Inactive' }}
                                        </button>
                                    </td>
                                    <td class="td text-right">
                                        <div class="flex items-center justify-end gap-1.5">
                                            <a href="{{ route('admin.program-roadmap.edit', $r->id) }}" class="icon-btn-edit" title="Edit Peta Jalan">
                                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.program-roadmap.destroy', $r->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus peta jalan tahun {{ $r->tahun }} ini?')">
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
</div>

@push('scripts')
    @include('admin.partials.toggle-status-script')
@endpush
@endsection
