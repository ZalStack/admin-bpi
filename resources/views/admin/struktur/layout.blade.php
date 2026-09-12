@extends('layouts.app')

@section('title', 'Organizational Chart Layout')

@section('content')
<div x-data="chartLayoutManager()" x-init="init()" class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <nav class="breadcrumb mb-2">
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700">Dashboard</a>
                <svg class="h-3 w-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.struktur.index') }}" class="text-gray-500 hover:text-gray-700">Organizational Structure</a>
                <svg class="h-3 w-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-800 font-semibold">Chart Layout</span>
            </nav>
            <h1 class="page-title text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                <span>Organizational Chart Layout</span>
                <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-[#520A18]/10 text-[#520A18] border border-[#520A18]/20">
                    Live Organizer
                </span>
            </h1>
            <p class="page-subtitle text-sm text-gray-600 mt-1">
                Visually manage the order and positioning of department cards (Row 1, Row 2, Row 3) and operational units displayed on the website.
            </p>
        </div>

        <div class="flex items-center gap-3 shrink-0">
            <a href="{{ route('admin.struktur.index') }}" class="btn-outline flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Members List</span>
            </a>

            <button 
                type="button" 
                @click="saveLayout()" 
                :disabled="isSaving"
                class="btn-primary flex items-center gap-2 shadow-lg hover:shadow-xl transition-all cursor-pointer"
                :class="{ 'opacity-70 cursor-not-allowed': isSaving }"
            >
                <template x-if="isSaving">
                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </template>
                <template x-if="!isSaving">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                </template>
                <span x-text="isSaving ? 'Saving...' : 'Save Layout'"></span>
            </button>
        </div>
    </div>

    <!-- Toast Notification -->
    <div 
        x-show="toast.show" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2"
        class="fixed bottom-6 right-6 z-50 flex items-center gap-3 px-5 py-3.5 rounded-2xl shadow-2xl border text-sm font-semibold"
        :class="toast.type === 'success' ? 'bg-emerald-900 text-white border-emerald-700' : 'bg-rose-900 text-white border-rose-700'"
        style="display: none;"
    >
        <template x-if="toast.type === 'success'">
            <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </template>
        <template x-if="toast.type !== 'success'">
            <svg class="w-5 h-5 text-rose-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </template>
        <span x-text="toast.message"></span>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex items-center gap-2 border-b border-gray-200">
        <button 
            type="button" 
            @click="activeTab = 'bidang'"
            class="px-5 py-3 text-sm font-bold border-b-2 transition-colors flex items-center gap-2 cursor-pointer"
            :class="activeTab === 'bidang' ? 'border-[#520A18] text-[#520A18]' : 'border-transparent text-gray-500 hover:text-gray-800'"
        >
            <span>🏛️ BPI Departments</span>
            <span class="text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 font-semibold" x-text="bidangList.length"></span>
        </button>

        <button 
            type="button" 
            @click="activeTab = 'unit'"
            class="px-5 py-3 text-sm font-bold border-b-2 transition-colors flex items-center gap-2 cursor-pointer"
            :class="activeTab === 'unit' ? 'border-[#520A18] text-[#520A18]' : 'border-transparent text-gray-500 hover:text-gray-800'"
        >
            <span>📋 Committees, Taskforces & Working Groups</span>
            <span class="text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 font-semibold" x-text="unitList.length"></span>
        </button>
    </div>

    <!-- ================= TAB 1: BPI DEPARTMENTS ================= -->
    <div x-show="activeTab === 'bidang'" class="space-y-6">
        <!-- Info Banner -->
        <div class="p-4 sm:p-5 rounded-2xl bg-amber-50/80 border border-amber-200/90 text-amber-900 text-xs sm:text-sm leading-relaxed flex items-start gap-3">
            <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="font-bold text-amber-950 mb-0.5">Department Cards Layout Guide:</p>
                <p class="text-amber-900/90">
                    The website displays department cards in 3 rows: <strong>Row 1 (Slots 1–5)</strong>, <strong>Row 2 (Slots 6–10)</strong>, and <strong>Row 3 (Slots 11–13+)</strong>.
                    Use the <strong>⬅️ Move Left</strong> and <strong>➡️ Move Right</strong> buttons on each card to swap slot positions, then click <strong>"Save Layout"</strong> above.
                </p>
            </div>
        </div>

        <!-- Section: Row 1 (Slots 1 - 5) -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-[#520A18]"></span>
                    <h3 class="text-base font-extrabold text-slate-900">Row 1 — Slots 1 to 5 (Primary Departments)</h3>
                </div>
                <span class="text-xs font-semibold text-slate-500">Maximum 5 Cards</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3.5">
                <template x-for="(item, idx) in bidangList.slice(0, 5)" :key="item.key">
                    <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-[#520A18]/40 transition-all flex flex-col justify-between group">
                        <div>
                            <!-- Header: Slot Badge & Movement -->
                            <div class="flex items-center justify-between gap-1 mb-2.5">
                                <span class="px-2 py-0.5 rounded-md bg-[#520A18] text-white text-[10px] font-extrabold" x-text="'Slot #' + (idx + 1)"></span>
                                <div class="flex items-center gap-1">
                                    <button 
                                        type="button" 
                                        @click="moveBidang(idx, -1)" 
                                        :disabled="idx === 0"
                                        class="w-7 h-7 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-[#520A18] hover:border-[#520A18] disabled:opacity-30 disabled:cursor-not-allowed transition-colors"
                                        title="Move Left"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    </button>
                                    <button 
                                        type="button" 
                                        @click="moveBidang(idx, 1)" 
                                        :disabled="idx === bidangList.length - 1"
                                        class="w-7 h-7 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-[#520A18] hover:border-[#520A18] disabled:opacity-30 disabled:cursor-not-allowed transition-colors"
                                        title="Move Right"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Department Name -->
                            <h4 class="text-xs font-black text-slate-900 line-clamp-2 leading-snug mb-1" x-text="item.name_id"></h4>
                            <p class="text-[10px] text-slate-500 font-medium truncate mb-3" x-text="item.name_en"></p>

                            <!-- Members List Preview -->
                            <div class="space-y-1.5 pt-2 border-t border-slate-200/80">
                                <template x-for="m in item.members" :key="m.id">
                                    <div class="flex items-center gap-2 p-1.5 rounded-xl bg-white border border-slate-100">
                                        <template x-if="m.foto_url">
                                            <img :src="m.foto_url" :alt="m.nama" class="w-6 h-6 rounded-full object-cover shrink-0">
                                        </template>
                                        <template x-if="!m.foto_url">
                                            <div class="w-6 h-6 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-[10px] font-bold shrink-0" x-text="m.nama.charAt(0)"></div>
                                        </template>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-[10px] font-bold text-slate-900 truncate leading-tight" x-text="m.nama"></p>
                                            <p class="text-[9px] text-slate-500 truncate" x-text="m.jabatan_en || m.jabatan_id || 'Member'"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Section: Row 2 (Slots 6 - 10) -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-[#1B365D]"></span>
                    <h3 class="text-base font-extrabold text-slate-900">Row 2 — Slots 6 to 10 (Secondary Departments)</h3>
                </div>
                <span class="text-xs font-semibold text-slate-500">Maximum 5 Cards</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3.5">
                <template x-for="(item, idx) in bidangList.slice(5, 10)" :key="item.key">
                    <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-[#1B365D]/40 transition-all flex flex-col justify-between group">
                        <div>
                            <!-- Header: Slot Badge & Movement -->
                            <div class="flex items-center justify-between gap-1 mb-2.5">
                                <span class="px-2 py-0.5 rounded-md bg-[#1B365D] text-white text-[10px] font-extrabold" x-text="'Slot #' + (idx + 6)"></span>
                                <div class="flex items-center gap-1">
                                    <button 
                                        type="button" 
                                        @click="moveBidang(idx + 5, -1)" 
                                        class="w-7 h-7 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-[#1B365D] hover:border-[#1B365D] transition-colors"
                                        title="Move Left"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    </button>
                                    <button 
                                        type="button" 
                                        @click="moveBidang(idx + 5, 1)" 
                                        :disabled="idx + 5 === bidangList.length - 1"
                                        class="w-7 h-7 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-[#1B365D] hover:border-[#1B365D] disabled:opacity-30 disabled:cursor-not-allowed transition-colors"
                                        title="Move Right"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Department Name -->
                            <h4 class="text-xs font-black text-slate-900 line-clamp-2 leading-snug mb-1" x-text="item.name_id"></h4>
                            <p class="text-[10px] text-slate-500 font-medium truncate mb-3" x-text="item.name_en"></p>

                            <!-- Members List Preview -->
                            <div class="space-y-1.5 pt-2 border-t border-slate-200/80">
                                <template x-for="m in item.members" :key="m.id">
                                    <div class="flex items-center gap-2 p-1.5 rounded-xl bg-white border border-slate-100">
                                        <template x-if="m.foto_url">
                                            <img :src="m.foto_url" :alt="m.nama" class="w-6 h-6 rounded-full object-cover shrink-0">
                                        </template>
                                        <template x-if="!m.foto_url">
                                            <div class="w-6 h-6 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-[10px] font-bold shrink-0" x-text="m.nama.charAt(0)"></div>
                                        </template>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-[10px] font-bold text-slate-900 truncate leading-tight" x-text="m.nama"></p>
                                            <p class="text-[9px] text-slate-500 truncate" x-text="m.jabatan_en || m.jabatan_id || 'Member'"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Section: Row 3 (Slots 11 - 13+) -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-amber-600"></span>
                    <h3 class="text-base font-extrabold text-slate-900">Row 3 — Slots 11 to End</h3>
                </div>
                <span class="text-xs font-semibold text-slate-500">Centered at Bottom</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 max-w-4xl mx-auto">
                <template x-for="(item, idx) in bidangList.slice(10)" :key="item.key">
                    <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-amber-500/40 transition-all flex flex-col justify-between group">
                        <div>
                            <!-- Header: Slot Badge & Movement -->
                            <div class="flex items-center justify-between gap-1 mb-2.5">
                                <span class="px-2 py-0.5 rounded-md bg-amber-700 text-white text-[10px] font-extrabold" x-text="'Slot #' + (idx + 11)"></span>
                                <div class="flex items-center gap-1">
                                    <button 
                                        type="button" 
                                        @click="moveBidang(idx + 10, -1)" 
                                        class="w-7 h-7 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-amber-700 hover:border-amber-700 transition-colors"
                                        title="Move Left"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    </button>
                                    <button 
                                        type="button" 
                                        @click="moveBidang(idx + 10, 1)" 
                                        :disabled="idx + 10 === bidangList.length - 1"
                                        class="w-7 h-7 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-amber-700 hover:border-amber-700 disabled:opacity-30 disabled:cursor-not-allowed transition-colors"
                                        title="Move Right"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Department Name -->
                            <h4 class="text-xs font-black text-slate-900 line-clamp-2 leading-snug mb-1" x-text="item.name_id"></h4>
                            <p class="text-[10px] text-slate-500 font-medium truncate mb-3" x-text="item.name_en"></p>

                            <!-- Members List Preview -->
                            <div class="space-y-1.5 pt-2 border-t border-slate-200/80">
                                <template x-for="m in item.members" :key="m.id">
                                    <div class="flex items-center gap-2 p-1.5 rounded-xl bg-white border border-slate-100">
                                        <template x-if="m.foto_url">
                                            <img :src="m.foto_url" :alt="m.nama" class="w-6 h-6 rounded-full object-cover shrink-0">
                                        </template>
                                        <template x-if="!m.foto_url">
                                            <div class="w-6 h-6 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-[10px] font-bold shrink-0" x-text="m.nama.charAt(0)"></div>
                                        </template>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-[10px] font-bold text-slate-900 truncate leading-tight" x-text="m.nama"></p>
                                            <p class="text-[9px] text-slate-500 truncate" x-text="m.jabatan_en || m.jabatan_id || 'Member'"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- ================= TAB 2: COMMITTEES, TASKFORCES & WORKING GROUPS ================= -->
    <div x-show="activeTab === 'unit'" class="space-y-6" style="display: none;">
        <!-- Info Banner -->
        <div class="p-4 sm:p-5 rounded-2xl bg-blue-50/80 border border-blue-200/90 text-blue-900 text-xs sm:text-sm leading-relaxed flex items-start gap-3">
            <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="font-bold text-blue-950 mb-0.5">Operational Units Layout Guide:</p>
                <p class="text-blue-900/90">
                    The committee, taskforce, and working group cards below will be displayed in the operational cluster at the bottom of the chart.
                    Use the <strong>⬅️ Move Left</strong> and <strong>➡️ Move Right</strong> buttons to adjust the card display order.
                </p>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200 shadow-sm space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <template x-for="(item, idx) in unitList" :key="item.key">
                    <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-200/90 shadow-2xs hover:shadow-md hover:border-blue-300 transition-all flex flex-col justify-between group">
                        <div>
                            <!-- Header: Slot Badge & Movement -->
                            <div class="flex items-center justify-between gap-1 mb-2.5">
                                <span 
                                    class="px-2 py-0.5 rounded-md text-white text-[10px] font-extrabold uppercase"
                                    :class="item.kategori === 'komite' ? 'bg-blue-600' : 'bg-purple-600'"
                                    x-text="'Slot #' + (idx + 1)"
                                ></span>
                                <div class="flex items-center gap-1">
                                    <button 
                                        type="button" 
                                        @click="moveUnit(idx, -1)" 
                                        :disabled="idx === 0"
                                        class="w-7 h-7 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-blue-600 hover:border-blue-600 disabled:opacity-30 disabled:cursor-not-allowed transition-colors"
                                        title="Move Left"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    </button>
                                    <button 
                                        type="button" 
                                        @click="moveUnit(idx, 1)" 
                                        :disabled="idx === unitList.length - 1"
                                        class="w-7 h-7 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-blue-600 hover:border-blue-600 disabled:opacity-30 disabled:cursor-not-allowed transition-colors"
                                        title="Move Right"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Unit Name & Type -->
                            <div class="flex items-center gap-1.5 mb-1">
                                <span 
                                    class="text-[9px] font-extrabold uppercase px-2 py-0.2 rounded-full border"
                                    :class="item.kategori === 'komite' ? 'bg-blue-100 text-blue-800 border-blue-200' : 'bg-purple-100 text-purple-800 border-purple-200'"
                                    x-text="item.sub_kategori || item.kategori"
                                ></span>
                            </div>
                            <h4 class="text-xs font-black text-slate-900 line-clamp-2 leading-snug mb-1" x-text="item.name_id"></h4>
                            <p class="text-[10px] text-slate-500 font-medium truncate mb-3" x-text="item.name_en"></p>

                            <!-- Members List Preview -->
                            <div class="space-y-1.5 pt-2 border-t border-slate-200/80">
                                <template x-for="m in item.members" :key="m.id">
                                    <div class="flex items-center gap-2 p-1.5 rounded-xl bg-white border border-slate-100">
                                        <template x-if="m.foto_url">
                                            <img :src="m.foto_url" :alt="m.nama" class="w-6 h-6 rounded-full object-cover shrink-0">
                                        </template>
                                        <template x-if="!m.foto_url">
                                            <div class="w-6 h-6 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-[10px] font-bold shrink-0" x-text="m.nama.charAt(0)"></div>
                                        </template>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-[10px] font-bold text-slate-900 truncate leading-tight" x-text="m.nama"></p>
                                            <p class="text-[9px] text-slate-500 truncate" x-text="m.jabatan_en || m.jabatan_id || 'Member'"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
function chartLayoutManager() {
    return {
        activeTab: 'bidang',
        isSaving: false,
        toast: {
            show: false,
            message: '',
            type: 'success'
        },
        bidangList: @js($bidangList),
        unitList: @js($unitList),

        init() {
            // initial setup
        },

        showToast(message, type = 'success') {
            this.toast.message = message;
            this.toast.type = type;
            this.toast.show = true;
            setTimeout(() => {
                this.toast.show = false;
            }, 3500);
        },

        moveBidang(index, direction) {
            const targetIdx = index + direction;
            if (targetIdx < 0 || targetIdx >= this.bidangList.length) return;
            const temp = this.bidangList[index];
            this.bidangList[index] = this.bidangList[targetIdx];
            this.bidangList[targetIdx] = temp;
            this.bidangList = [...this.bidangList];
        },

        moveUnit(index, direction) {
            const targetIdx = index + direction;
            if (targetIdx < 0 || targetIdx >= this.unitList.length) return;
            const temp = this.unitList[index];
            this.unitList[index] = this.unitList[targetIdx];
            this.unitList[targetIdx] = temp;
            this.unitList = [...this.unitList];
        },

        async saveLayout() {
            this.isSaving = true;
            try {
                // Generate base orders for Bidang (e.g. 1 to 13)
                const bidangOrders = this.bidangList.map((item, idx) => ({
                    key: item.key,
                    urutan: idx + 1
                }));

                // Generate base orders for Units (e.g. 20+)
                const unitOrders = this.unitList.map((item, idx) => ({
                    key: item.key,
                    urutan: 20 + idx
                }));

                const payload = {
                    bidang_orders: bidangOrders,
                    unit_orders: unitOrders,
                    _token: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                };

                const res = await fetch('{{ Route::has('admin.struktur.save-layout') ? route('admin.struktur.save-layout') : url('/admin/struktur-layout/save') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': payload._token
                    },
                    body: JSON.stringify(payload)
                });

                const json = await res.json();
                if (res.ok && json.status === 'success') {
                    this.showToast(json.message || 'Chart layout order successfully saved!', 'success');
                } else {
                    this.showToast(json.message || 'Failed to save layout.', 'error');
                }
            } catch (err) {
                console.error(err);
                this.showToast('An error occurred while saving.', 'error');
            } finally {
                this.isSaving = false;
            }
        }
    };
}
</script>
@endsection
