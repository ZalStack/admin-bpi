@extends('layouts.app')

@section('title', 'Edit News Category')

@section('content')
<div class="form-page">
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
                <a href="{{ route('admin.kategori-berita.index') }}">Category</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit News Category</h1>
            <p class="page-subtitle">Update news category with multilingual titles and customizable badge color</p>
        </div>
        <a href="{{ route('admin.kategori-berita.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
    </div>

    <div class="form-card max-w-3xl">
        <form action="{{ route('admin.kategori-berita.update', $item->id) }}" method="POST"
            x-data="{
                lang: @js($bahasas->first()?->kode),
                color: @js(old('warna', $item->warna ?? '#68001C')),
                titleTick: 0,
                presetColors: [
                    { hex: '#68001C', name: 'Maroon (BPI)' },
                    { hex: '#16336D', name: 'Navy Blue (BPI)' },
                    { hex: '#97763A', name: 'Gold (BPI)' },
                    { hex: '#E58C97', name: 'Rose Pink' },
                    { hex: '#0284C7', name: 'Sky Blue' },
                    { hex: '#0D9488', name: 'Teal' },
                    { hex: '#059669', name: 'Emerald' },
                    { hex: '#D97706', name: 'Amber' },
                    { hex: '#7C3AED', name: 'Purple' },
                    { hex: '#EA580C', name: 'Orange' },
                    { hex: '#2563EB', name: 'Royal Blue' },
                    { hex: '#4F46E5', name: 'Indigo' },
                    { hex: '#DC2626', name: 'Crimson' },
                    { hex: '#475569', name: 'Slate' }
                ],
                getLiveTitle() {
                    this.titleTick;
                    const activeInput = document.querySelector('input[name=\'translations[' + this.lang + '][judul]\']')
                        || document.querySelector('input[name*=\'[judul]\']');
                    return (activeInput && activeInput.value.trim()) ? activeInput.value.trim() : @js($item->translateField('judul') ?: 'Category Name');
                },
                hexToRgba(hex, alpha) {
                    if (!hex) return 'rgba(104, 0, 28, ' + alpha + ')';
                    let c = hex.replace('#', '');
                    if (c.length === 3) c = c.split('').map(x => x + x).join('');
                    if (c.length !== 6) return 'rgba(104, 0, 28, ' + alpha + ')';
                    const num = parseInt(c, 16);
                    return 'rgba(' + ((num >> 16) & 255) + ', ' + ((num >> 8) & 255) + ', ' + (num & 255) + ', ' + alpha + ')';
                }
            }"
            @input="titleTick++">
            @csrf
            @method('PUT')

            <!-- ================= MULTILINGUAL TITLES ================= -->
            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Multilingual Content
            </h3>

            <x-lang-tabs :bahasas="$bahasas"/>

            @foreach ($bahasas as $bahasa)
                @php
                    $req = $bahasa->is_default;
                @endphp
                <x-lang-panel :kode="$bahasa->kode" class="space-y-4">
                    <x-trans-input field="judul" label="Category Title" :kode="$bahasa->kode" :required="$req" placeholder="{{ $req ? 'e.g.: Industry / Festival' : 'e.g.: Industry / Festival' }}" :item="$item"/>
                    <x-trans-input field="slug" label="Slug (Optional, auto-generated from title)" :kode="$bahasa->kode" placeholder="{{ $req ? 'e.g.: industry' : 'e.g.: industry' }}" :item="$item"/>
                </x-lang-panel>
            @endforeach

            <!-- ================= BADGE COLOR & LIVE PREVIEW ================= -->
            <div class="divider"></div>

            <h3 class="section-label">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4 4 4 0 014-4 4 4 0 014 4 4 4 0 01-4 4zm0 0l1.293-1.293a1 1 0 00.287-.638V15a2 2 0 012-2h1.086a2 2 0 011.414.586l3.414 3.414a2 2 0 001.414.586H19a2 2 0 002-2v-1.086a2 2 0 00-.586-1.414l-3.414-3.414A2 2 0 0116.414 11H15a2 2 0 01-2-2V7.914a1 1 0 00-.287-.638L11.414 6A2 2 0 0010 5.414H7"/>
                </svg>
                Badge Color & Live Preview
            </h3>

            <div class="rounded-2xl border border-gray-200/80 bg-gray-50/70 p-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start">
                    <!-- Color Picker Input & Presets -->
                    <div>
                        <label for="warna" class="form-label">
                            Category Badge Color <span class="text-rose-500">*</span>
                        </label>
                        <p class="text-xs text-gray-500 mb-2.5">
                            Select an accent color for this category badge on the news and home pages.
                        </p>
                        
                        <div class="flex items-center gap-3">
                            <div class="relative flex items-center justify-center">
                                <input
                                    type="color"
                                    id="warna_picker"
                                    x-model="color"
                                    class="h-10 w-12 cursor-pointer rounded-xl border border-gray-300 p-1 bg-white shadow-xs hover:border-[#520A18] transition"
                                >
                            </div>
                            <div class="relative flex-1">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 font-mono text-sm">#</span>
                                <input
                                    type="text"
                                    name="warna"
                                    id="warna"
                                    :value="color.replace('#', '')"
                                    @input="color = '#' + $event.target.value.replace(/[^0-9A-Fa-f]/g, '').slice(0, 6)"
                                    class="form-input font-mono pl-7 uppercase text-sm"
                                    placeholder="68001C"
                                    maxlength="7"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Preset Swatches -->
                        <div class="mt-3.5">
                            <span class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider block mb-2">Color Presets:</span>
                            <div class="flex flex-wrap items-center gap-2">
                                <template x-for="c in presetColors" :key="c.hex">
                                    <button
                                        type="button"
                                        @click="color = c.hex"
                                        :style="`background-color: ${c.hex};`"
                                        :title="c.name + ' (' + c.hex + ')'"
                                        class="w-7 h-7 rounded-full shadow-xs border-2 transition-all hover:scale-115 focus:outline-none"
                                        :class="color.toUpperCase() === c.hex.toUpperCase() ? 'border-gray-900 scale-110 ring-2 ring-offset-2 ring-gray-400' : 'border-white/90'"
                                    ></button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Live Badge Preview -->
                    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-xs">
                        <div class="flex items-center justify-between mb-3 pb-2 border-b border-gray-100">
                            <span class="text-xs font-bold text-gray-700 uppercase tracking-wider flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full transition-colors duration-300" :style="`background-color: ${color};`"></span>
                                Live Preview Badge
                            </span>
                            <span class="text-[11px] font-mono font-semibold px-2 py-0.5 rounded bg-gray-100 text-gray-600" x-text="color.toUpperCase()"></span>
                        </div>

                        <div>
                            <span class="text-[11px] font-medium text-gray-400 block mb-1.5">News & Home Card Preview:</span>
                            <div class="p-3.5 rounded-xl bg-[#F1ECDD] border border-[#E3DBAF]/70 flex items-center justify-between">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase transition-all duration-300 shadow-xs"
                                    :style="`background-color: ${hexToRgba(color, 0.12)}; color: ${color}; border: 1px solid ${hexToRgba(color, 0.25)};`"
                                    x-text="getLiveTitle()"
                                ></span>
                                <span class="text-xs font-medium text-slate-500">24.09.2026</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Update Category
                </button>
                <a href="{{ route('admin.kategori-berita.index') }}" class="btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection





