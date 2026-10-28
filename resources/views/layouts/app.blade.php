<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel BPI - @yield('title', 'Dashboard')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-bpi.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo-bpi.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-bpi.png') }}">

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Quill Rich Text Editor -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-poppins antialiased h-full bg-[#F6F5F2]">
    <div class="min-h-full">
        <livewire:navbar />

        <livewire:sidebar />

        @php
            $babPanduan = \App\Support\Panduan::babUntukRoute(request()->route()?->getName(), auth()->user());
        @endphp

        <main class="pt-16 lg:pl-72 min-h-screen">
            {{-- pb ekstra agar baris terakhir tidak tertutup tombol bantuan --}}
            <div class="p-4 md:p-6 lg:p-8 lg:px-10 max-w-[1600px] mx-auto w-full {{ $babPanduan ? 'pb-24 lg:pb-24' : '' }}">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         x-transition.opacity.duration.500ms
                         class="mb-6 flex items-start justify-between gap-3 rounded-2xl border border-emerald-200 bg-emerald-50/90 px-5 py-4 shadow-sm backdrop-blur">
                        <div class="flex items-center gap-3">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="text-emerald-500 hover:text-emerald-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         x-transition.opacity.duration.500ms
                         class="mb-6 flex items-start justify-between gap-3 rounded-2xl border border-rose-200 bg-rose-50/90 px-5 py-4 shadow-sm backdrop-blur">
                        <div class="flex items-center gap-3">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-rose-100 text-rose-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-rose-800">{{ session('error') }}</p>
                        </div>
                        <button @click="show = false" class="text-rose-500 hover:text-rose-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50/90 px-5 py-4 shadow-sm backdrop-blur">
                        <div class="flex items-start gap-3">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-rose-100 text-rose-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-rose-800">There are errors in the form:</p>
                                <ul class="mt-1.5 list-disc list-inside space-y-1 text-xs font-medium text-rose-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        {{-- Tombol bantuan: buka bab panduan untuk halaman yang sedang dibuka --}}
        @if ($babPanduan)
            <a href="{{ route('admin.panduan.show', $babPanduan) }}" target="_blank"
               class="guide-help-btn fixed bottom-24 right-4 z-30 inline-flex items-center gap-2 rounded-full border border-[#97763A]/30 bg-white p-3 text-sm font-semibold text-[#520A18] shadow-[0_8px_24px_-8px_rgba(23,32,54,0.35)] transition-all hover:-translate-y-0.5 hover:bg-[#FBF8EF] lg:bottom-6 lg:right-6 lg:px-4 lg:py-2.5"
               title="Open the guide for this page (new tab)">
                <svg class="h-5 w-5 text-[#97763A]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="hidden lg:inline">Page Guide</span>
            </a>
        @endif
    </div>
    @livewireScripts
    <!-- Quill Rich Text Editor JS -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    @stack('scripts')
</body>
</html>
