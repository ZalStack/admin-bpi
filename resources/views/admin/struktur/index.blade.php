@extends('layouts.app')

@section('title', 'Organizational Structure')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Organizational Structure</span>
            </nav>
            <h1 class="page-title">Organizational Structure</h1>
            <p class="page-subtitle">Manage company organizational structure</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#520A18] ring-1 ring-[#520A18]/10 shadow-sm">
                <span class="h-1.5 w-1.5 rounded-full bg-[#520A18]"></span>
                {{ $items->count() }} Data
            </div>
        </div>
        <a href="{{ route('admin.struktur.create') }}" class="btn-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Member
        </a>
    </div>

    @if($items->isEmpty())
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <h3 class="empty-title">No members yet</h3>
            <p class="empty-desc">Add organizational structure members.</p>
        </div>
    @else
        <div class="table-container">
            <div class="table-scroll">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th class="th">Photo</th>
                            <th class="th">Name</th>
                            <th class="th hidden md:table-cell">Position</th>
                            <th class="th hidden sm:table-cell">Order</th>
                            <th class="th hidden md:table-cell">Status</th>
                            <th class="th text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($items as $item)
                            <tr class="tr-hover">
                                <td class="td">
                                    @if($item->foto)
                                        <img src="{{ asset('storage/struktur/'.$item->foto) }}" alt="foto" class="thumb" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                        <div class="hidden items-center justify-center h-10 w-10 rounded-lg bg-gray-100">
                                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400">No photo</span>
                                    @endif
                                </td>
                                <td class="td font-medium text-gray-800">{{ $item->nama }}</td>
                                <td class="td hidden md:table-cell">
                                    <span class="text-sm text-gray-600">{{ Str::limit($item->translateField('jabatan'), 25) }}</span>
                                </td>
                                <td class="td hidden sm:table-cell">
                                    <span class="inline-flex items-center rounded-lg bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700">#{{ $item->urutan }}</span>
                                </td>
                                <td class="td hidden md:table-cell">
                                    <button onclick="toggleStatus('struktur', {{ $item->id }})" class="{{ $item->status ? 'badge-active' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="td text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.struktur.edit', $item->id) }}" class="icon-btn-edit" title="Edit">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.struktur.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this data?')">
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
