@extends('layouts.app')

@section('title', 'Vision & Mission Points')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Vision & Mission Points</span>
            </nav>
            <h1 class="page-title">Vision & Mission Points</h1>
            <p class="page-subtitle">Manage Vision pillar cards and Mission cards displayed on the About page ({{ strtoupper(\App\Models\Bahasa::defaultKode()) }} displayed)</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#97763A] ring-1 ring-[#97763A]/10 shadow-sm">
                <span class="h-1.5 w-1.5 rounded-full bg-[#97763A]"></span>
                {{ $items->count() }} Data
            </div>
        </div>
        <a href="{{ route('admin.tentang-poin.create') }}" class="btn-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Vision / Mission Point
        </a>
    </div>

    @if($items->isEmpty())
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="empty-title">No vision & mission point data yet</h3>
            <p class="empty-desc">Start by adding a new vision or mission pillar point.</p>
        </div>
    @else
        <div class="table-container">
            <div class="table-scroll">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th class="th">Category</th>
                            <th class="th">Order</th>
                            <th class="th">Title</th>
                            <th class="th hidden md:table-cell">Icon</th>
                            <th class="th hidden md:table-cell">Status</th>
                            <th class="th text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($items as $item)
                            <tr class="tr-hover">
                                <td class="td">
                                    @if(strtolower($item->tentang?->section) === 'visi')
                                        <span class="inline-flex items-center rounded-lg bg-[#244E96]/[0.12] px-2.5 py-1 text-xs font-bold text-[#244E96]">Vision Pillar</span>
                                    @elseif(strtolower($item->tentang?->section) === 'misi')
                                        <span class="inline-flex items-center rounded-lg bg-[#775A19]/[0.12] px-2.5 py-1 text-xs font-bold text-[#775A19]">Mission Card</span>
                                    @else
                                        <span class="inline-flex items-center rounded-lg bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-600">{{ $item->tentang?->section ?: '-' }}</span>
                                    @endif
                                </td>
                                <td class="td text-sm text-gray-500 font-bold">{{ $item->urutan }}</td>
                                <td class="td font-medium text-gray-800">{{ Str::limit($item->translateField('judul'), 35) }}</td>
                                <td class="td hidden md:table-cell text-sm text-gray-500 font-mono text-xs">{{ $item->icon ?: '-' }}</td>
                                <td class="td hidden md:table-cell">
                                    <button onclick="toggleStatus('tentang-poin', {{ $item->id }})" class="{{ $item->status ? 'badge-active' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="td text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.tentang-poin.edit', $item->id) }}" class="icon-btn-edit" title="Edit">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.tentang-poin.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this data?')">
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
