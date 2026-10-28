@extends('layouts.app')

@section('title', 'Guide - '.$bab['judul'])

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.panduan.index') }}">Guide</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>{{ $bab['grup'] }}</span>
            </nav>
            <h1 class="page-title">{{ $bab['judul'] }}</h1>
            <p class="page-subtitle">{{ $bab['ringkasan'] }}</p>
        </div>
        <div class="flex flex-wrap items-center gap-2 print:hidden">
            @include('admin.panduan._lang-switch')
            <a href="{{ route('admin.panduan.index') }}" class="btn-outline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
                {{ $t['daftar_isi'] }}
            </a>
            <button type="button" onclick="window.print()" class="btn-outline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                {{ $t['cetak_bab'] }}
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[250px_minmax(0,1fr)] 2xl:grid-cols-[250px_minmax(0,1fr)_210px]">
        {{-- Daftar bab --}}
        <aside class="print:hidden">
            <details class="card p-3 lg:hidden">
                <summary class="cursor-pointer px-2 py-1 text-sm font-semibold text-[#520A18]">{{ $t['pilih_bab'] }}</summary>
                <div class="mt-3">@include('admin.panduan._nav', ['aktif' => $bab['slug']])</div>
            </details>
            <div class="card sticky top-24 hidden max-h-[calc(100vh-7rem)] overflow-y-auto p-3 lg:block">
                @include('admin.panduan._nav', ['aktif' => $bab['slug']])
            </div>
        </aside>

        {{-- Isi bab --}}
        <article class="card min-w-0 p-5 md:p-8">
            <div class="guide-prose">
                {!! $konten['html'] !!}
            </div>

            <div class="mt-10 grid grid-cols-1 gap-3 border-t border-gray-100 pt-6 sm:grid-cols-2 print:hidden">
                @if($sebelumnya)
                    <a href="{{ route('admin.panduan.show', $sebelumnya['slug']) }}" class="rounded-xl border border-gray-200 p-4 transition-colors hover:border-[#520A18]/40 hover:bg-gray-50">
                        <span class="text-xs text-gray-400">&larr; {{ $t['sebelumnya'] }}</span>
                        <span class="block font-semibold text-[#520A18]">{{ $sebelumnya['judul'] }}</span>
                    </a>
                @else
                    <span></span>
                @endif
                @if($berikutnya)
                    <a href="{{ route('admin.panduan.show', $berikutnya['slug']) }}" class="rounded-xl border border-gray-200 p-4 text-right transition-colors hover:border-[#520A18]/40 hover:bg-gray-50">
                        <span class="text-xs text-gray-400">{{ $t['berikutnya'] }} &rarr;</span>
                        <span class="block font-semibold text-[#520A18]">{{ $berikutnya['judul'] }}</span>
                    </a>
                @endif
            </div>
        </article>

        {{-- Daftar isi bab ini --}}
        @if(count($konten['toc']) > 1)
            <aside class="hidden 2xl:block print:hidden">
                <div class="sticky top-24">
                    <p class="mb-2 text-[0.65rem] font-bold uppercase tracking-[0.15em] text-[#5876B0]">{{ $t['di_bab_ini'] }}</p>
                    <ul class="space-y-1 border-l border-gray-200 text-sm">
                        @foreach($konten['toc'] as $item)
                            <li>
                                <a href="#{{ $item['id'] }}" class="-ml-px block border-l border-transparent py-1 pl-3 text-gray-500 hover:border-[#520A18] hover:text-[#520A18]">{{ $item['judul'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        @endif
    </div>
</div>
@endsection
