@extends('layouts.app')

@section('title', 'Guide')

@section('content')
<div x-data="{
        q: '',
        indeks: @js($indeksPencarian),
        get hasil() {
            const kata = this.q.toLowerCase().trim().split(/\s+/).filter(Boolean);
            if (! kata.length) return [];
            return this.indeks
                .filter(b => kata.every(k => (b.judul + ' ' + b.teks).toLowerCase().includes(k)))
                .map(b => {
                    const teks = b.teks.toLowerCase();
                    const pos = teks.indexOf(kata[0]);
                    const mulai = Math.max(0, pos - 60);
                    return { ...b, cuplikan: (mulai > 0 ? '…' : '') + b.teks.substr(mulai, 180) + '…' };
                });
        }
    }">
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Guide</span>
            </nav>
            <h1 class="page-title">{{ $t['judul_index'] }}</h1>
            <p class="page-subtitle">{{ $t['subjudul_index'] }}</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            @include('admin.panduan._lang-switch')
            <a href="{{ route('admin.panduan.cetak') }}" target="_blank" class="btn-outline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                {{ $t['cetak_pdf'] }}
            </a>
        </div>
    </div>

    {{-- Pencarian --}}
    <div class="card mb-6 p-5 md:p-6">
        <label for="cari-panduan" class="form-label">{{ $t['cari_label'] }}</label>
        <div class="relative">
            <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input id="cari-panduan" type="search" x-model="q" class="form-input !pl-10"
                   placeholder="{{ $t['cari_placeholder'] }}">
        </div>

        <div x-show="q.trim() !== ''" x-cloak class="mt-4">
            <p class="mb-2 text-xs text-gray-500" x-text="hasil.length ? hasil.length + ' ' + @js($t['hasil']) : @js($t['tidak_ada'])"></p>
            <ul class="divide-y divide-gray-100">
                <template x-for="b in hasil" :key="b.slug">
                    <li>
                        <a :href="b.url" class="block rounded-lg px-2 py-3 hover:bg-gray-50">
                            <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#5876B0]" x-text="b.grup"></span>
                            <span class="block font-semibold text-[#520A18]" x-text="b.judul"></span>
                            <span class="mt-0.5 block text-xs text-gray-500" x-text="b.cuplikan"></span>
                        </a>
                    </li>
                </template>
            </ul>
        </div>
    </div>

    {{-- Daftar bab --}}
    <div x-show="q.trim() === ''" class="space-y-8">
        @foreach($grups as $grup => $babs)
            <section>
                <h2 class="mb-3 text-xs font-bold uppercase tracking-[0.15em] text-[#5876B0]">{{ $grup }}</h2>
                <div class="grid grid-cols-1 gap-3 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($babs as $bab)
                        <a href="{{ route('admin.panduan.show', $bab['slug']) }}" class="card card-hover block p-5">
                            <p class="font-semibold text-[#520A18]">{{ $bab['judul'] }}</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $bab['ringkasan'] }}</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
</div>
@endsection
