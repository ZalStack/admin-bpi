@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="form-page">
    {{-- Header --}}
    <div class="mb-6 sm:mb-8">
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('dashboard') }}" class="hover:text-[#520A18] transition-colors">Dashboard</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-[#520A18] font-medium">Profile</span>
        </nav>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 font-poppins">My Profile</h1>
        <p class="text-sm text-gray-500 mt-1">Manage your account information and security</p>
    </div>

    {{-- Profile Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- Header Profile --}}
        <div class="bg-gradient-to-r from-[#520A18] to-[#821E38] px-6 py-8 sm:px-8 sm:py-10">
            <div class="flex flex-col sm:flex-row items-center gap-6">
                {{-- Avatar --}}
                <div class="relative shrink-0">
                    <div class="flex h-24 w-24 sm:h-28 sm:w-28 items-center justify-center rounded-2xl bg-white/20 backdrop-blur-sm text-white text-3xl sm:text-4xl font-bold font-poppins border-2 border-white/30 shadow-lg shadow-black/10">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div class="absolute -bottom-1 -right-1 bg-emerald-500 rounded-full p-1.5 border-2 border-white shadow-sm">
                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>

                {{-- User Info --}}
                <div class="flex-1 text-center sm:text-left">
                    <h2 class="text-xl sm:text-2xl font-bold text-white font-poppins">{{ $user->name }}</h2>
                    <p class="text-white/80 text-sm flex items-center justify-center sm:justify-start gap-2 mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        {{ $user->email }}
                    </p>
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 mt-3">
                        <span class="inline-flex items-center gap-1.5 bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-medium text-white border border-white/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            Administrator
                        </span>
                        <span class="inline-flex items-center gap-1.5 bg-white/10 backdrop-blur-sm px-3 py-1 rounded-full text-xs text-white/80 border border-white/10">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $user->created_at->locale('en')->isoFormat('D MMMM Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-6 sm:p-8 space-y-6">
            {{-- Edit Profile --}}
            <div x-data="{ editingProfile: false }">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-4">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#520A18]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profile Information
                        </h3>
                        <p class="text-sm text-gray-400">Update your name and email</p>
                    </div>
                    <button @click="editingProfile = !editingProfile"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-[#520A18] bg-[#520A18]/10 rounded-xl hover:bg-[#520A18]/20 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="{ 'rotate-45': editingProfile }">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span x-text="editingProfile ? 'Close' : 'Edit Profile'"></span>
                    </button>
                </div>

                <div x-show="editingProfile" x-transition.opacity.duration.200ms x-cloak>
                    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Full Name</label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $user->name) }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#520A18]/50 focus:border-[#520A18] transition-all outline-none text-sm"
                                       required
                                       autofocus
                                       autocomplete="name">
                                @error('name')
                                    <p class="mt-1.5 text-sm text-red-500 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       value="{{ old('email', $user->email) }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#520A18]/50 focus:border-[#520A18] transition-all outline-none text-sm"
                                       required
                                       autocomplete="username">
                                @error('email')
                                    <p class="mt-1.5 text-sm text-red-500 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 pt-2">
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#520A18] text-white font-medium rounded-xl hover:bg-[#68001C] transition-all duration-200 shadow-sm hover:shadow-md text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Save Changes
                            </button>

                            @if(session('success') && !str_contains(session('success'), 'Password'))
                                <span x-data="{ show: true }"
                                      x-show="show"
                                      x-transition
                                      x-init="setTimeout(() => show = false, 3000)"
                                      class="text-sm text-emerald-600 font-medium flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ session('success') }}
                                </span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-200"></div>

            {{-- Change Password --}}
            <div x-data="{
                editingPassword: false,
                showCurrentPassword: false,
                showNewPassword: false,
                showConfirmPassword: false
            }">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-4">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#520A18]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Change Password
                        </h3>
                        <p class="text-sm text-gray-400">Update your account password</p>
                    </div>
                    <button @click="editingPassword = !editingPassword"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-[#520A18] bg-[#520A18]/10 rounded-xl hover:bg-[#520A18]/20 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="{ 'rotate-45': editingPassword }">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span x-text="editingPassword ? 'Close' : 'Change Password'"></span>
                    </button>
                </div>

                <div x-show="editingPassword" x-transition.opacity.duration.200ms x-cloak>
                    <form method="post" action="{{ route('profile.password.update') }}" class="space-y-4">
                        @csrf
                        @method('put')

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            {{-- Current Password --}}
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1.5">Current Password</label>
                                <div class="relative">
                                    <input :type="showCurrentPassword ? 'text' : 'password'"
                                           name="current_password"
                                           id="current_password"
                                           class="w-full px-4 py-2.5 pr-10 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#520A18]/50 focus:border-[#520A18] transition-all outline-none text-sm"
                                           autocomplete="current-password"
                                           required>
                                    <button type="button"
                                            @click="showCurrentPassword = !showCurrentPassword"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                        <svg x-show="!showCurrentPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg x-show="showCurrentPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                                @error('current_password')
                                    <p class="mt-1.5 text-sm text-red-500 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- New Password --}}
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">New Password</label>
                                <div class="relative">
                                    <input :type="showNewPassword ? 'text' : 'password'"
                                           name="password"
                                           id="password"
                                           class="w-full px-4 py-2.5 pr-10 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#520A18]/50 focus:border-[#520A18] transition-all outline-none text-sm"
                                           autocomplete="new-password"
                                           required>
                                    <button type="button"
                                            @click="showNewPassword = !showNewPassword"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                        <svg x-show="!showNewPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg x-show="showNewPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-1.5 text-sm text-red-500 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Confirm Password</label>
                                <div class="relative">
                                    <input :type="showConfirmPassword ? 'text' : 'password'"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           class="w-full px-4 py-2.5 pr-10 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#520A18]/50 focus:border-[#520A18] transition-all outline-none text-sm"
                                           autocomplete="new-password"
                                           required>
                                    <button type="button"
                                            @click="showConfirmPassword = !showConfirmPassword"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                        <svg x-show="!showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg x-show="showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Password Strength Indicator --}}
                        <div class="mt-2">
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <span class="font-medium">Password Strength:</span>
                                <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-gray-300 rounded-full transition-all duration-300"
                                         x-data="{ strength: 0 }"
                                         x-init="$watch('showNewPassword', () => {
                                             const pass = document.getElementById('password').value;
                                             if (pass.length === 0) { strength = 0; return; }
                                             let score = 0;
                                             if (pass.length >= 8) score += 25;
                                             if (/[a-z]/.test(pass) && /[A-Z]/.test(pass)) score += 25;
                                             if (/[0-9]/.test(pass)) score += 25;
                                             if (/[^a-zA-Z0-9]/.test(pass)) score += 25;
                                             strength = score;
                                         })"
                                         :style="{ width: strength + '%' }"
                                         :class="{
                                             'bg-red-400': strength < 25,
                                             'bg-orange-400': strength >= 25 && strength < 50,
                                             'bg-yellow-400': strength >= 50 && strength < 75,
                                             'bg-green-400': strength >= 75
                                         }"></div>
                                </div>
                                <span x-text="strength === 0 ? 'Empty' : strength < 25 ? 'Weak' : strength < 50 ? 'Medium' : strength < 75 ? 'Strong' : 'Very Strong'"
                                      :class="{
                                          'text-red-400': strength < 25,
                                          'text-orange-400': strength >= 25 && strength < 50,
                                          'text-yellow-600': strength >= 50 && strength < 75,
                                          'text-green-400': strength >= 75
                                      }"
                                      class="font-medium text-xs"></span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 pt-2">
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#E3DBAF] text-[#520A18] font-medium rounded-xl hover:bg-[#CAB988] transition-all duration-200 shadow-sm hover:shadow-md text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Update Password
                            </button>

                            @if(session('success') && str_contains(session('success'), 'Password'))
                                <span x-data="{ show: true }"
                                      x-show="show"
                                      x-transition
                                      x-init="setTimeout(() => show = false, 3000)"
                                      class="text-sm text-emerald-600 font-medium flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ session('success') }}
                                </span>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- Password hint --}}
                <div x-show="!editingPassword" x-transition.opacity.duration.200ms class="mt-4 flex items-start gap-3 rounded-xl bg-amber-50/80 border border-amber-200/60 px-4 py-3">
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-sm text-amber-700 leading-relaxed">
                        Click <strong>"Change Password"</strong> to update your account password.
                        <span class="block mt-1 text-amber-600/80 text-xs">Make sure your new password is at least 8 characters and easy to remember.</span>
                    </p>
                </div>
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-200"></div>

            {{-- Danger Zone --}}
            <div class="bg-red-50/80 rounded-xl p-4 sm:p-5 border border-red-200/60">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                    <div>
                        <h4 class="text-sm font-semibold text-red-700 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Delete Account
                        </h4>
                        <p class="text-sm text-red-600/70 mt-0.5">Once your account is deleted, all data will be permanently removed</p>
                    </div>
                    <form method="post" action="{{ route('profile.destroy') }}"
                          onsubmit="return confirm('Are you sure you want to delete this account? This action cannot be undone!')">
                        @csrf
                        @method('delete')
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white font-medium rounded-xl hover:bg-red-700 transition-all duration-200 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
