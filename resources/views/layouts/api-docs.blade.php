<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dokumentasi API') · Admin Panel BPI</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-bpi.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo-bpi.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-bpi.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-poppins antialiased min-h-screen bg-[#F6F5F2] flex flex-col">
    <header class="sticky top-0 z-40 h-16 shrink-0 border-b border-white/10 bg-gradient-to-r from-[#0E2043] via-[#132C5C] to-[#16336D] shadow-lg shadow-[#0E2043]/30 backdrop-blur">
        <div class="mx-auto flex h-full max-w-6xl items-center justify-between gap-4 px-4 md:px-6">
            <div class="flex min-w-0 items-center gap-3">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#97763A] to-[#B09861] text-xs font-extrabold tracking-wide text-white shadow-md">BPI</span>
                <div class="min-w-0 leading-tight">
                    <p class="truncate text-sm font-bold text-white">Admin Panel BPI</p>
                    <p class="truncate text-[0.68rem] uppercase tracking-[0.14em] text-white/50">@yield('docs-subtitle', 'REST API Documentation')</p>
                </div>
            </div>
            <a href="{{ route('dashboard') }}"
               class="inline-flex shrink-0 items-center gap-2 rounded-xl border border-white/15 bg-white/[0.06] px-3.5 py-2 text-xs font-semibold text-white/85 transition-all hover:bg-white/[0.12] hover:text-white">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Dashboard
            </a>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl flex-1 px-4 py-8 md:px-6 md:py-10">
        @yield('content')
    </main>

    <footer class="shrink-0 border-t border-gray-200/80 py-5">
        <p class="text-center text-xs text-gray-400">Admin Panel BPI · Dokumentasi REST API v1</p>
    </footer>

    @stack('scripts')
</body>
</html>
