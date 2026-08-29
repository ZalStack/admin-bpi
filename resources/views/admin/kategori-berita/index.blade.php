@extends('layouts.app')

@section('title', 'News Categories')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.berita.index') }}">News</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Category</span>
            </nav>
            <h1 class="page-title">News Categories</h1>
            <p class="page-subtitle">Manage master categories for news article grouping</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#97763A] ring-1 ring-[#97763A]/10 shadow-sm">
                <span class="h-1.5 w-1.5 rounded-full bg-[#97763A]"></span>
                {{ $items->count() }} Categories
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.kategori-berita.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Category
            </a>
            <a href="{{ route('admin.berita.index') }}" class="btn-outline">Back to News</a>
        </div>
    </div>

    @if($items->isEmpty())
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <h3 class="empty-title">No news category data yet</h3>
            <p class="empty-desc">Start by adding a new news category.</p>
        </div>
    @else
        <div class="table-container">
            <div class="table-scroll">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th class="th">#</th>
                            <th class="th">Title (Default Language)</th>
                            <th class="th hidden md:table-cell">Other Translations</th>
                            <th class="th hidden lg:table-cell">Slug</th>
                            <th class="th text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($items as $index => $item)
                            <tr class="tr-hover">
                                <td class="td text-gray-500 font-mono text-xs">{{ $index + 1 }}</td>
                                <td class="td">
                                    <span class="font-semibold text-gray-900">{{ $item->translateField('judul') ?? '-' }}</span>
                                </td>
                                <td class="td hidden md:table-cell">
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($item->translations as $trans)
                                            <span class="inline-flex items-center gap-1 rounded-md bg-gray-100 px-2 py-0.5 text-xs text-gray-700 font-medium">
                                                <span class="uppercase text-[10px] font-bold text-gray-400">{{ $trans->bahasa }}:</span>
                                                {{ $trans->judul }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="td hidden lg:table-cell font-mono text-xs text-gray-500">
                                    {{ $item->translateField('slug') ?? '-' }}
                                </td>
                                <td class="td text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.kategori-berita.edit', $item->id) }}" class="icon-btn-edit" title="Edit">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.kategori-berita.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
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
@endsection
