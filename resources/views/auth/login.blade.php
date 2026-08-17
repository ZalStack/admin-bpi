<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Admin Panel BPI</title>

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-poppins antialiased h-full bg-gradient-to-br from-[#520A18] via-[#68001C] to-[#821E38]">
    <div class="min-h-full flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Logo / Brand -->
            <div class="text-center mb-6 sm:mb-8">
                <div class="inline-flex items-center justify-center bg-white/10 backdrop-blur-sm rounded-2xl p-3 sm:p-4 mb-3 sm:mb-4">
                    <img
                        src="{{ asset('images/logo-bpi.png') }}"
                        alt="Logo BPI"
                        class="w-12 h-12 sm:w-16 sm:h-16 md:w-20 md:h-20 object-contain"
                    >
                </div>
                <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-white">Admin Panel BPI</h1>
                <p class="text-[#E3DBAF] mt-1.5 sm:mt-2 font-light text-sm sm:text-base">Login untuk mengakses dashboard</p>
            </div>

            <!-- Card Login -->
            <div class="bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl p-8 border border-white/20">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-white mb-2">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-[#E3DBAF]/60" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                            </div>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                class="w-full pl-10 pr-3 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-[#E3DBAF] focus:border-transparent transition-all"
                                placeholder="Masukan Email"
                            >
                        </div>
                        @error('email')
                            <p class="text-[#EBA9B0] text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-white mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-[#E3DBAF]/60" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                class="w-full pl-10 pr-3 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-[#E3DBAF] focus:border-transparent transition-all"
                                placeholder="Masukan Password"
                            >
                        </div>
                        @error('password')
                            <p class="text-[#EBA9B0] text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                                class="h-4 w-4 rounded border-white/30 bg-white/20 text-[#E3DBAF] focus:ring-[#E3DBAF] focus:ring-offset-0"
                            >
                            <span class="ml-2 text-sm text-white/80">Ingat Saya</span>
                        </label>
                    </div>

                    <!-- Error Message -->
                    @if ($errors->has('email') || $errors->has('password'))
                        <div class="bg-red-500/20 backdrop-blur-sm border border-red-400 text-white px-4 py-3 rounded-xl">
                            <p class="text-sm">Email atau password salah. Silakan coba lagi.</p>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-[#E3DBAF] text-[#520A18] py-3 rounded-xl font-semibold text-lg hover:bg-[#CAB988] transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-[#E3DBAF]/50 shadow-lg"
                    >
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Masuk ke Dashboard
                        </span>
                    </button>

                    <!-- Footer -->
                    <div class="text-center pt-4 border-t border-white/20">
                        <p class="text-xs text-white/50">
                            &copy; {{ date('Y') }} Admin Panel BPI. All rights reserved.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
