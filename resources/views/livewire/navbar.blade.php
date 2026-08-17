<nav class="fixed top-0 z-50 h-16 w-full bg-gradient-to-r from-[#520A18] via-[#5f0b1b] to-[#68001C] border-b border-[#68001C] shadow-[0_4px_24px_-8px_rgba(82,10,24,0.6)]">
    <div class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-[#E3DBAF]/40 to-transparent"></div>
    <div class="h-full px-2 sm:px-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between h-full">
            <div class="flex items-center justify-start rtl:justify-end min-w-0">
                <button @click="$dispatch('toggle-sidebar')" type="button" class="inline-flex items-center p-2 text-sm text-white rounded-lg lg:hidden hover:bg-[#821E38] focus:outline-none focus:ring-2 focus:ring-[#E3DBAF]/50 transition-colors shrink-0">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <a href="{{ route('dashboard') }}" class="flex ms-2 lg:ms-1 md:me-24 items-center gap-2 sm:gap-2.5 group min-w-0">
                    <img
                        src="{{ asset('images/logo-bpi.png') }}"
                        alt="Logo BPI"
                        class="h-7 sm:h-8 lg:h-9 w-auto object-contain shrink-0 transition-transform duration-200 group-hover:scale-105"
                    >
                    <span class="self-center text-base sm:text-lg md:text-xl lg:text-2xl font-semibold whitespace-nowrap text-white font-poppins tracking-tight">Admin <span class="text-[#E3DBAF]">BPI</span></span>
                </a>
            </div>

            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                <!-- Language Switcher -->
                <div class="hidden sm:flex items-center gap-1 rounded-xl bg-black/20 p-1 ring-1 ring-inset ring-white/10">
                    <button wire:click="switchLanguage('id')" class="px-2.5 sm:px-3 py-1 text-xs sm:text-sm rounded-lg transition-all font-poppins {{ $currentLocale == 'id' ? 'bg-[#E3DBAF] text-[#520A18] font-semibold shadow-sm' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                        ID
                    </button>
                    <button wire:click="switchLanguage('en')" class="px-2.5 sm:px-3 py-1 text-xs sm:text-sm rounded-lg transition-all font-poppins {{ $currentLocale == 'en' ? 'bg-[#E3DBAF] text-[#520A18] font-semibold shadow-sm' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                        EN
                    </button>
                </div>

                <!-- User Menu -->
                <div class="flex items-center">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" type="button" class="flex items-center gap-1.5 sm:gap-2 text-sm bg-white/[0.08] ring-1 ring-inset ring-white/15 rounded-full py-1 ps-1 pe-2 sm:pe-3 hover:bg-white/[0.14] transition-colors" aria-expanded="false">
                            <span class="sr-only">Open user menu</span>
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#E3DBAF] to-[#CAB988] text-[#520A18] flex items-center justify-center font-semibold font-poppins shadow-inner">
                                {{ Auth::user()->name ? substr(Auth::user()->name, 0, 2) : 'AD' }}
                            </div>
                            <span class="hidden md:inline text-white text-sm font-poppins max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-white/60 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition.origin.top.right x-cloak
                             class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-[0_16px_48px_-12px_rgba(23,32,54,0.35)] ring-1 ring-gray-200/80 border border-gray-100 z-50 overflow-hidden">
                            <div class="px-4 py-3.5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                                <p class="text-sm font-semibold text-gray-800 font-poppins truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 font-poppins truncate mt-0.5">{{ Auth::user()->email }}</p>
                            </div>
                            <ul class="py-2 text-sm text-gray-700">
                                <li>
                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-gray-50 font-poppins transition-colors">
                                        <svg class="w-4.5 h-4.5 text-[#2B4E94]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left flex items-center gap-2.5 px-4 py-2.5 hover:bg-red-50 hover:text-red-700 font-poppins transition-colors">
                                            <svg class="w-4.5 h-4.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
