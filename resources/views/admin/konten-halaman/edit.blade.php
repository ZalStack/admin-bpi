@extends('layouts.app')

@section('title', $page['title'])

@section('content')
<div class="form-page">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route($page['parent_route']) }}">{{ $page['parent_label'] }}</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>{{ $page['title'] }}</span>
            </nav>
            <h1 class="page-title">{{ $page['title'] }}</h1>
            <p class="page-subtitle">{{ $page['subtitle'] }}</p>
        </div>
        @if (! empty($page['links']))
            {{-- Related pages edited from the same menu (e.g. Footer → Privacy / Terms) --}}
            <div class="flex flex-wrap items-center justify-end gap-2.5">
                @foreach ($page['links'] as $link)
                    <a href="{{ Route::has($link['route']) ? route($link['route']) : url($link['url']) }}"
                       class="{{ request()->routeIs($link['route']) ? 'btn-primary' : 'btn-outline' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>
        @else
            <a href="{{ route($page['parent_route']) }}" class="btn-outline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to {{ $page['parent_label'] }}
            </a>
        @endif
    </div>

    <div class="form-card">
        <form action="{{ Route::has($page['update_route']) ? route($page['update_route']) : url($page['update_url']) }}" method="POST">
            @csrf
            @method('PUT')

            <p class="mb-5 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-xs leading-relaxed text-amber-800">
                Leave a field empty to show the website's built-in default text for that language.
            </p>

            @forelse ($groups as $grup => $items)
                @if (! $loop->first)
                    <div class="divider"></div>
                @endif

                <h2 class="mb-4 text-sm font-bold uppercase tracking-wider text-[#520A18] font-poppins">{{ $grup }}</h2>

                <div class="space-y-5">
                    @foreach ($items as $item)
                        <div>
                            <p class="form-label">{{ $item->label }}</p>
                            {{-- Only classes already in the compiled CMS CSS (public/build) are used here. --}}
                            {{-- Rich text editors are stacked (one language per row); short fields side by side. --}}
                            <div class="grid grid-cols-1 gap-3 {{ $item->tipe === 'richtext' ? '' : 'sm:grid-cols-2' }}">
                                @foreach ($bahasas as $bahasa)
                                    @php
                                        $errorKey = "konten.{$item->id}.{$bahasa->kode}";
                                        $value = old($errorKey, $item->translationFor($bahasa->kode)?->nilai ?? '');
                                        $name = "konten[{$item->id}][{$bahasa->kode}]";
                                    @endphp
                                    <div>
                                        @if ($item->tipe === 'richtext')
                                            {{-- The component shows its own label and validation error --}}
                                            <x-rich-editor :field="'konten-' . $item->id" :label="$bahasa->nama" :kode="$bahasa->kode"
                                                :name="$name" :value="$value" height="420px" />
                                        @else
                                            <span class="mb-1 inline-block text-xs font-semibold text-gray-400">{{ strtoupper($bahasa->kode) }} &middot; {{ $bahasa->nama }}</span>
                                            @if ($item->tipe === 'textarea')
                                                <textarea name="{{ $name }}" rows="3" class="form-textarea">{{ $value }}</textarea>
                                            @else
                                                <input type="text" name="{{ $name }}" value="{{ $value }}" class="form-input">
                                            @endif
                                            @error($errorKey)
                                                <p class="form-error">{{ $message }}</p>
                                            @enderror
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="empty-state">
                    <h3 class="empty-title">No texts registered for this page yet</h3>
                    <p class="empty-desc">Run the latest database migration to register the editable texts.</p>
                </div>
            @endforelse

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Save Texts
                </button>
                <a href="{{ route($page['parent_route']) }}" class="btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
