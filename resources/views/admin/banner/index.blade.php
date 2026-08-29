@extends('layouts.app')

@section('title', 'Banner')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Banner</span>
            </nav>
            <h1 class="page-title">Page Banners</h1>
            <p class="page-subtitle">Manage banners for each page</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#132C5C] ring-1 ring-[#132C5C]/10 shadow-sm">
                <span class="h-1.5 w-1.5 rounded-full bg-[#132C5C]"></span>
                {{ $items->count() }} Data
            </div>
        </div>
        <a href="{{ route('admin.banner.create') }}" class="btn-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Banner
        </a>
    </div>

    @if($items->isEmpty())
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <h3 class="empty-title">No banners yet</h3>
            <p class="empty-desc">Start by adding a new banner.</p>
        </div>
    @else
        <div class="table-container">
            <div class="table-scroll">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th class="th">Page</th>
                            <th class="th hidden md:table-cell">Title</th>
                            <th class="th hidden lg:table-cell">Image</th>
                            <th class="th hidden md:table-cell">Status</th>
                            <th class="th text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @php
                            $halamanLabels = [
                                'home' => 'Homepage',
                                'stakeholders' => 'Stakeholders',
                                'program' => 'Strategic Programs',
                                'proyek' => 'Collaboration Projects',
                                'mitra' => 'Partners',
                                'berita' => 'Articles & News',
                                'tentang' => 'About Us',
                                'kontak' => 'Contact Us',
                            ];
                        @endphp
                        @foreach($items as $item)
                            <tr class="tr-hover">
                                <td class="td">
                                    <span class="inline-flex items-center rounded-lg bg-[#97763A]/[0.1] px-2.5 py-1 text-xs font-semibold text-[#97763A]">
                                        {{ $halamanLabels[$item->halaman] ?? ucfirst($item->halaman) }}
                                        <span class="ml-1 text-[10px] text-gray-400 font-normal">({{ $item->halaman }})</span>
                                    </span>
                                </td>
                                <td class="td hidden md:table-cell font-medium text-gray-800">{{ Str::limit($item->translateField('judul'), 30) }}</td>
                                <td class="td hidden lg:table-cell">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/banners/'.$item->gambar) }}" alt="banner" class="thumb" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                        <div class="hidden items-center justify-center h-10 w-10 rounded-lg bg-gray-100">
                                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="td hidden md:table-cell">
                                    <button onclick="toggleStatus('banner', {{ $item->id }})" class="{{ $item->status ? 'badge-active' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="td text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.banner.edit', $item->id) }}" class="icon-btn-edit" title="Edit">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.banner.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this data?')">
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
