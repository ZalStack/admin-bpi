@extends('layouts.app')

@section('title', 'Shortlinks')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Shortlink</span>
            </nav>
            <h1 class="page-title">Shortlinks</h1>
            <p class="page-subtitle">Short links on the landing page domain (<span class="font-mono">{{ $baseUrl }}</span>) with click tracking</p>
            <div class="mt-3 flex flex-wrap gap-2">
                <span class="inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#97763A] ring-1 ring-[#97763A]/10 shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#97763A]"></span>
                    {{ $items->count() }} Shortlinks
                </span>
                <span class="inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#2B4E94] ring-1 ring-[#2B4E94]/10 shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#2B4E94]"></span>
                    {{ number_format($items->sum('jumlah_klik')) }} Total Clicks
                </span>
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.shortlink.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Shortlink
            </a>
            <a href="{{ route('admin.qrcode.index') }}" class="btn-outline">QR Codes</a>
        </div>
    </div>

    @if($items->isEmpty())
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
            </svg>
            <h3 class="empty-title">No shortlinks yet</h3>
            <p class="empty-desc">Start by adding a new shortlink.</p>
        </div>
    @else
        <div class="table-container">
            <div class="table-scroll">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th class="th">#</th>
                            <th class="th">Short Link</th>
                            <th class="th hidden md:table-cell">Destination</th>
                            <th class="th">Clicks</th>
                            <th class="th">Status</th>
                            <th class="th text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($items as $index => $item)
                            <tr class="tr-hover">
                                <td class="td text-gray-500 font-mono text-xs">{{ $index + 1 }}</td>
                                <td class="td">
                                    @if($item->judul)
                                        <p class="font-semibold text-gray-900">{{ $item->judul }}</p>
                                    @endif
                                    <div class="flex items-center gap-1.5" x-data="{ copied: false }">
                                        <a href="{{ $item->short_url }}" target="_blank" rel="noopener" class="font-mono text-sm text-[#2B4E94] hover:underline">{{ $item->short_url }}</a>
                                        <button type="button" class="icon-btn-view !h-7 !w-7" title="Copy link"
                                            @click="copyText(@js($item->short_url)).then(() => { copied = true; setTimeout(() => copied = false, 1500) })">
                                            <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                            <svg x-show="copied" x-cloak class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>
                                    </div>
                                    @if($item->qrcodes_count > 0)
                                        <span class="mt-1 inline-flex items-center rounded-md bg-[#2B4E94]/[0.08] px-2 py-0.5 text-[11px] font-semibold text-[#2B4E94]">{{ $item->qrcodes_count }} QR</span>
                                    @endif
                                </td>
                                <td class="td hidden md:table-cell">
                                    <a href="{{ $item->url_tujuan }}" target="_blank" rel="noopener" class="block max-w-xs truncate text-sm text-gray-600 hover:text-[#2B4E94] hover:underline" title="{{ $item->url_tujuan }}">{{ $item->url_tujuan }}</a>
                                </td>
                                <td class="td">
                                    <p class="font-semibold text-gray-900">{{ number_format($item->jumlah_klik) }}</p>
                                    <p class="text-[11px] text-gray-400">
                                        {{ $item->terakhir_diklik_at ? 'Last '.$item->terakhir_diklik_at->diffForHumans() : 'Never clicked' }}
                                    </p>
                                </td>
                                <td class="td">
                                    <button onclick="toggleStatus('shortlink', {{ $item->id }})" class="{{ $item->status ? 'badge-active' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer">
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="td text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <button type="button" class="icon-btn-gold" title="QR Code"
                                            @click="$dispatch('qr-quick', { kode: @js($item->kode), shortUrl: @js($item->short_url), customizeUrl: @js(route('admin.qrcode.create', ['shortlink' => $item->id])) })">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                            </svg>
                                        </button>
                                        <a href="{{ route('admin.shortlink.edit', $item->id) }}" class="icon-btn-edit" title="Edit">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.shortlink.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this shortlink? Shared links will stop working.')">
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

    {{-- Modal QR cepat: gaya default + logo BPI, bisa langsung diunduh --}}
    <div x-data="qrQuick({ bpiLogoUrl: @js(asset('images/logo-bpi-qr.png')) })"
         @qr-quick.window="show($event.detail)"
         @keydown.escape.window="open = false"
         x-show="open" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
        <div @click.outside="open = false" class="card w-full max-w-sm p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-900">QR Code</h3>
            <p class="mt-1 mb-4 break-all font-mono text-xs text-gray-500" x-text="shortUrl"></p>
            <canvas x-ref="canvas" class="mx-auto h-auto w-full max-w-[280px] rounded-xl ring-1 ring-gray-200"></canvas>
            <div class="mt-5 flex flex-wrap justify-center gap-2">
                <button type="button" class="btn-primary" @click="downloadPng()">Download PNG</button>
                <button type="button" class="btn-outline" @click="downloadSvg()">Download SVG</button>
            </div>
            <a :href="customizeUrl" class="mt-3 inline-block text-sm font-semibold text-[#97763A] hover:underline">Customize &amp; save as QR Code →</a>
        </div>
    </div>
</div>

@include('admin.partials.toggle-status-script')
@endsection
