@extends('layouts.app')

@section('title', 'Project Gallery')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.proyek.index') }}">Projects</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Gallery</span>
            </nav>
            <h1 class="page-title">Project Gallery</h1>
            <p class="page-subtitle">{{ $proyek->translateField('judul') }}</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#2B4E94] ring-1 ring-[#2B4E94]/10 shadow-sm">
                <span class="h-1.5 w-1.5 rounded-full bg-[#2B4E94]"></span>
                {{ $items->count() }} Data
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.proyek.galeri.create', $proyek->id) }}" class="btn-primary">Add Gallery</a>
            <a href="{{ route('admin.proyek.index') }}" class="btn-outline">Back</a>
        </div>
    </div>

    @if($items->isEmpty())
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <h3 class="empty-title">No gallery for this project yet</h3>
            <p class="empty-desc">Add gallery images for this project.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($items as $galeri)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
                    <div class="relative h-48 overflow-hidden">
                        @if($galeri->gambar)
                            <img src="{{ asset('storage/proyek/galeri/'.$galeri->gambar) }}" alt="{{ $galeri->translateField('judul') ?? 'Gallery' }}" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                        @else
                            <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-2 right-2">
                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-black/40 text-white text-xs font-bold backdrop-blur-sm">#{{ $galeri->urutan }}</span>
                        </div>
                    </div>

                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 font-poppins">{{ Str::limit($galeri->translateField('judul') ?? 'Gallery', 25) }}</h3>
                        <p class="text-sm text-gray-500 font-poppins mt-1">{{ Str::limit($galeri->translateField('deskripsi') ?? '', 40) }}</p>

                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                            <button onclick="toggleStatus('proyek/{{ $proyek->id }}/galeri', {{ $galeri->id }})" class="{{ $galeri->status ? 'badge-active' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                {{ $galeri->status ? 'Active' : 'Inactive' }}
                            </button>
                            <div class="flex items-center gap-1">
                                <a href="{{ route('admin.proyek.galeri.edit', [$proyek->id, $galeri->id]) }}" class="icon-btn-edit !h-8 !w-8" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.proyek.galeri.destroy', [$proyek->id, $galeri->id]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this gallery?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn-delete !h-8 !w-8" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@push('scripts')
    @include('admin.partials.toggle-status-script')
@endpush
@endsection
