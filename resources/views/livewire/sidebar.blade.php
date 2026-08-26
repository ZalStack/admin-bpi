<div x-data="{ isOpen: false }"
     @toggle-sidebar.window="isOpen = !isOpen">

    <!-- Mobile backdrop -->
    <div x-show="isOpen" @click="isOpen = false" x-transition:opacity x-cloak
         class="fixed inset-0 z-30 bg-black/60 backdrop-blur-sm lg:hidden" aria-hidden="true"></div>

    <aside class="sidebar-scroll fixed top-16 bottom-0 left-0 z-40 w-72 overflow-y-auto border-r border-[#16336D]/60 bg-gradient-to-b from-[#132C5C] via-[#11264F] to-[#0E2043] shadow-[6px_0_30px_-12px_rgba(10,20,45,0.7)] transition-transform duration-300 ease-in-out lg:translate-x-0"
           :class="{ 'translate-x-0': isOpen, '-translate-x-full': !isOpen }">

        <div class="relative flex h-full flex-col px-3 pb-6">
            <!-- Decorative glow -->
            <div class="pointer-events-none absolute -top-24 left-1/2 h-56 w-56 -translate-x-1/2 rounded-full bg-[#2B4E94]/30 blur-3xl"></div>

            <div class="relative flex-1">
                <ul class="space-y-1 pt-4 font-medium">
                    @auth
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('dashboard') }}" @click="isOpen = false"
                           class="group relative flex items-center rounded-xl p-2.5 text-[15px] text-white/80 transition-all duration-200 hover:bg-white/[0.06] hover:text-white {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-[#2B4E94]/80 to-[#16336D] text-white shadow-lg shadow-[#0E2043]/60' : '' }}">
                            @if(request()->routeIs('dashboard'))
                                <span class="absolute left-0 top-1/2 h-6 w-1 -translate-y-1/2 rounded-r-full bg-[#E3DBAF]"></span>
                            @endif
                            <svg class="h-5 w-5 shrink-0 transition duration-200 group-hover:text-[#E3DBAF]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                            </svg>
                            <span class="ms-3 font-poppins">Dashboard</span>
                        </a>
                    </li>

                    {{-- ================================================================== --}}
                    {{-- Content Manager — Super Admin & Admin --}}
                    {{-- ================================================================== --}}
                    @role('super_admin|admin')
                    <li class="pt-4">
                        <p class="px-2.5 pb-2 text-[0.65rem] font-bold uppercase tracking-[0.15em] text-[#5876B0]">Content Manager</p>
                    </li>

                    @php
                        $menuItems = [
                            [
                                'label' => 'Banner',
                                'route' => 'admin.banner.index',
                                'active' => 'admin.banner.*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>'
                            ],
                            [
                                'label' => 'Beranda',
                                'route' => 'admin.beranda.index',
                                'active' => 'admin.beranda.*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'
                            ],
                            [
                                'label' => 'Tentang',
                                'route' => 'admin.tentang.index',
                                'active' => 'admin.tentang.*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                            ],
                            [
                                'label' => 'Mitra',
                                'route' => 'admin.mitra.index',
                                'active' => ['admin.mitra.*', 'admin.kategori-mitra.*', 'admin.mitra-intro.*'],
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>'
                            ],
                            [
                                'label' => 'Stakeholder',
                                'route' => 'admin.stakeholder.index',
                                'active' => 'admin.stakeholder.*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>'
                            ],
                            [
                                'label' => 'Program',
                                'route' => 'admin.program.index',
                                'active' => ['admin.program.*', 'admin.program-roadmap.*'],
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>'
                            ],
                            [
                                'label' => 'Proyek',
                                'route' => 'admin.proyek.index',
                                'active' => 'admin.proyek.*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>'
                            ],
                            [
                                'label' => 'Struktur Organisasi',
                                'route' => 'admin.struktur.index',
                                'active' => 'admin.struktur.*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>'
                            ],
                            [
                                'label' => 'Kontak',
                                'route' => 'admin.kontak.index',
                                'active' => 'admin.kontak.*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>'
                            ],
                            [
                                'label' => 'Pesan Kontak',
                                'route' => 'admin.kontak-form.index',
                                'active' => 'admin.kontak-form.*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'
                            ],
                            [
                                'label' => 'Menu',
                                'route' => 'admin.menu.index',
                                'active' => 'admin.menu.*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>'
                            ],
                            [
                                'label' => 'Footer',
                                'route' => 'admin.footer.index',
                                'active' => 'admin.footer.*',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm0 10h16"/>'
                            ],
                        ];
                    @endphp

                    @foreach($menuItems as $item)
                        <li>
                            <a href="{{ route($item['route']) }}" @click="isOpen = false"
                               class="group relative flex items-center rounded-xl p-2.5 text-[15px] text-white/80 transition-all duration-200 hover:bg-white/[0.06] hover:text-white {{ request()->routeIs($item['active']) ? 'bg-gradient-to-r from-[#2B4E94]/80 to-[#16336D] text-white shadow-lg shadow-[#0E2043]/60' : '' }}">
                                @if(request()->routeIs($item['active']))
                                    <span class="absolute left-0 top-1/2 h-6 w-1 -translate-y-1/2 rounded-r-full bg-[#E3DBAF]"></span>
                                @endif
                                <svg class="h-5 w-5 shrink-0 transition duration-200 group-hover:text-[#E3DBAF]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    {!! $item['icon'] !!}
                                </svg>
                                <span class="ms-3 font-poppins">{{ $item['label'] }}</span>
                            </a>
                        </li>
                    @endforeach

                    <!-- Pengaturan Bahasa -->
                    <li>
                        <a href="{{ route('admin.bahasa.index') }}" @click="isOpen = false"
                           class="group relative flex items-center rounded-xl p-2.5 text-[15px] text-white/80 transition-all duration-200 hover:bg-white/[0.06] hover:text-white {{ request()->routeIs('admin.bahasa.*') ? 'bg-gradient-to-r from-[#2B4E94]/80 to-[#16336D] text-white shadow-lg shadow-[#0E2043]/60' : '' }}">
                            @if(request()->routeIs('admin.bahasa.*'))
                                <span class="absolute left-0 top-1/2 h-6 w-1 -translate-y-1/2 rounded-r-full bg-[#E3DBAF]"></span>
                            @endif
                            <svg class="h-5 w-5 shrink-0 transition duration-200 group-hover:text-[#E3DBAF]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7.667 12.667a2.667 2.667 0 0 1 1.5-.5h3.666a2.667 2.667 0 0 1 1.5.5 3.333 3.333 0 0 1-6.666 0ZM10 11a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 2v3"/>
                                <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-3.5 4.5a.5.5 0 0 1 .5.5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0V7h-1a.5.5 0 0 1 0-1h1V5a.5.5 0 0 1 .5-.5ZM10 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm-5.5-.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm0-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Z"/>
                            </svg>
                            <span class="ms-3 font-poppins">Pengaturan Bahasa</span>
                        </a>
                    </li>
                    @endrole

                    {{-- ================================================================== --}}
                    {{-- Berita — Super Admin, Admin & Editor --}}
                    {{-- ================================================================== --}}
                    @role('super_admin|admin|editor')
                    @if(! Auth::user()->hasAnyRole(['super_admin', 'admin']))
                    <li class="pt-4">
                        <p class="px-2.5 pb-2 text-[0.65rem] font-bold uppercase tracking-[0.15em] text-[#5876B0]">Content Manager</p>
                    </li>
                    @endif

                    @php
                        $beritaItems = [
                            [
                                'label' => 'Berita',
                                'route' => 'admin.berita.index',
                                'active' => ['admin.berita.*', 'admin.kategori-berita.*', 'admin.tag.*'],
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>'
                            ],
                        ];
                    @endphp

                    @foreach($beritaItems as $item)
                        <li>
                            <a href="{{ route($item['route']) }}" @click="isOpen = false"
                               class="group relative flex items-center rounded-xl p-2.5 text-[15px] text-white/80 transition-all duration-200 hover:bg-white/[0.06] hover:text-white {{ request()->routeIs($item['active']) ? 'bg-gradient-to-r from-[#2B4E94]/80 to-[#16336D] text-white shadow-lg shadow-[#0E2043]/60' : '' }}">
                                @if(request()->routeIs($item['active']))
                                    <span class="absolute left-0 top-1/2 h-6 w-1 -translate-y-1/2 rounded-r-full bg-[#E3DBAF]"></span>
                                @endif
                                <svg class="h-5 w-5 shrink-0 transition duration-200 group-hover:text-[#E3DBAF]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    {!! $item['icon'] !!}
                                </svg>
                                <span class="ms-3 font-poppins">{{ $item['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                    @endrole

                    @endauth

                    <!-- API Documentation — Super Admin only -->
                    @role('super_admin')
                    <li>
                        <a href="{{ route('admin.api-documentation.index') }}" @click="isOpen = false"
                           class="group relative flex items-center rounded-xl p-2.5 text-[15px] text-white/80 transition-all duration-200 hover:bg-white/[0.06] hover:text-white {{ request()->routeIs('admin.api-documentation.*') ? 'bg-gradient-to-r from-[#2B4E94]/80 to-[#16336D] text-white shadow-lg shadow-[#0E2043]/60' : '' }}">
                            @if(request()->routeIs('admin.api-documentation.*'))
                                <span class="absolute left-0 top-1/2 h-6 w-1 -translate-y-1/2 rounded-r-full bg-[#E3DBAF]"></span>
                            @endif
                            <svg class="h-5 w-5 shrink-0 transition duration-200 group-hover:text-[#E3DBAF]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                            <span class="ms-3 font-poppins">API Documentation</span>
                        </a>
                    </li>
                    @endrole

                    @auth
                    <!-- Group: Account -->
                    <li class="pt-4">
                        <p class="px-2.5 pb-2 text-[0.65rem] font-bold uppercase tracking-[0.15em] text-[#5876B0]">Akun</p>
                    </li>

                    <!-- Profile -->
                    <li>
                        <a href="{{ route('profile.edit') }}" @click="isOpen = false"
                           class="group flex items-center rounded-xl p-2.5 text-[15px] text-white/80 transition-all duration-200 hover:bg-white/[0.06] hover:text-white">
                            <svg class="h-5 w-5 shrink-0 transition duration-200 group-hover:text-[#E3DBAF]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                            </svg>
                            <span class="ms-3 font-poppins">Profile</span>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="group flex w-full items-center rounded-xl p-2.5 text-[15px] text-white/80 transition-all duration-200 hover:bg-red-500/15 hover:text-red-300">
                                <svg class="h-5 w-5 shrink-0 transition duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span class="ms-3 font-poppins">Logout</span>
                            </button>
                        </form>
                    </li>
                    @endauth

                    @guest
                    <li class="pt-4">
                        <a href="{{ route('login') }}" @click="isOpen = false"
                           class="group flex items-center rounded-xl p-2.5 text-[15px] text-white/80 transition-all duration-200 hover:bg-white/[0.06] hover:text-white">
                            <svg class="h-5 w-5 shrink-0 transition duration-200 group-hover:text-[#E3DBAF]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span class="ms-3 font-poppins">Login</span>
                        </a>
                    </li>
                    @endguest
                </ul>
            </div>

            <!-- Footer card -->
            @auth
            <div class="relative mt-6 rounded-2xl border border-white/10 bg-white/[0.04] p-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#E3DBAF] to-[#CAB988] font-bold text-[#520A18] shadow-md">
                        {{ Auth::user()->name ? substr(Auth::user()->name, 0, 2) : 'AD' }}
                    </div>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                        <p class="truncate text-xs text-[#5876B0]">
                            @if(Auth::user()->hasRole('super_admin'))
                                Super Admin
                            @elseif(Auth::user()->hasRole('admin'))
                                Admin
                            @elseif(Auth::user()->hasRole('editor'))
                                Editor
                            @else
                                User
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endauth

            @guest
            <div class="relative mt-6 rounded-2xl border border-white/10 bg-white/[0.04] p-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#E3DBAF] to-[#CAB988] font-bold text-[#520A18] shadow-md">
                        G
                    </div>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-white">Guest</p>
                        <a href="{{ route('login') }}" class="truncate text-xs text-[#E3DBAF] hover:underline">Login untuk akses admin</a>
                    </div>
                </div>
            </div>
            @endguest
        </div>
    </aside>
</div>
