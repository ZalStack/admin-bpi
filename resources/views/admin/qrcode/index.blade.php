@extends('layouts.app')

@section('title', 'QR Codes')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>QR Code</span>
            </nav>
            <h1 class="page-title">QR Codes</h1>
            <p class="page-subtitle">Branded QR codes for shortlinks or custom URLs, ready to download as PNG or SVG</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#97763A] ring-1 ring-[#97763A]/10 shadow-sm">
                <span class="h-1.5 w-1.5 rounded-full bg-[#97763A]"></span>
                {{ $items->count() }} QR Codes
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.qrcode.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add QR Code
            </a>
            <a href="{{ route('admin.shortlink.index') }}" class="btn-outline">Shortlinks</a>
        </div>
    </div>

    @if($items->isEmpty())
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
            </svg>
            <h3 class="empty-title">No QR codes yet</h3>
            <p class="empty-desc">Start by adding a new QR code.</p>
        </div>
    @else
        <div class="table-container">
            <div class="table-scroll">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th class="th">#</th>
                            <th class="th">Preview</th>
                            <th class="th">Title & Content</th>
                            <th class="th hidden md:table-cell">Target</th>
                            <th class="th text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($items as $index => $item)
                            @php
                                $qrOptions = [
                                    'content' => $item->konten,
                                    'fg' => $item->warna_depan,
                                    'bg' => $item->warna_latar,
                                    'caption' => $item->caption,
                                    'logoSrc' => $item->logo_url,
                                ];
                            @endphp
                            <tr class="tr-hover" x-data="qrThumb(@js($qrOptions), @js($item->judul))">
                                <td class="td text-gray-500 font-mono text-xs">{{ $index + 1 }}</td>
                                <td class="td">
                                    <canvas x-ref="canvas" class="h-auto w-16 rounded-lg ring-1 ring-gray-200"></canvas>
                                </td>
                                <td class="td">
                                    <p class="font-semibold text-gray-900">{{ $item->judul }}</p>
                                    <p class="break-all font-mono text-xs text-gray-500">{{ $item->konten }}</p>
                                    @if($item->caption)
                                        <p class="mt-0.5 text-xs italic text-gray-400">"{{ $item->caption }}"</p>
                                    @endif
                                </td>
                                <td class="td hidden md:table-cell">
                                    @if($item->shortlink)
                                        <a href="{{ route('admin.shortlink.edit', $item->shortlink_id) }}" class="inline-flex items-center rounded-md bg-[#2B4E94]/[0.08] px-2 py-0.5 text-[11px] font-semibold text-[#2B4E94] hover:underline">
                                            Shortlink: {{ $item->shortlink->kode }}
                                        </a>
                                        <p class="mt-1 max-w-xs truncate text-xs text-gray-500" title="{{ $item->shortlink->url_tujuan }}">→ {{ $item->shortlink->url_tujuan }}</p>
                                        <p class="text-[11px] text-gray-400">{{ number_format($item->shortlink->jumlah_klik) }} scans/clicks</p>
                                        @unless($item->shortlink->status)
                                            <span class="badge-inactive mt-1">Shortlink inactive</span>
                                        @endunless
                                    @else
                                        <span class="inline-flex items-center rounded-md bg-gray-100 px-2 py-0.5 text-[11px] font-semibold text-gray-600">Direct URL</span>
                                    @endif
                                </td>
                                <td class="td text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <button type="button" class="icon-btn-gold !w-auto px-2 text-xs font-semibold" title="Download PNG" @click="downloadPng()">PNG</button>
                                        <button type="button" class="icon-btn-gold !w-auto px-2 text-xs font-semibold" title="Download SVG" @click="downloadSvg()">SVG</button>
                                        <a href="{{ route('admin.qrcode.edit', $item->id) }}" class="icon-btn-edit" title="Edit">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.qrcode.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this QR code? Printed codes keep working as long as their shortlink exists.')">
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
