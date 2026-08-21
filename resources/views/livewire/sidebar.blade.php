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

                    <!-- Group: Content -->
                    <li class="pt-4">
                        <p class="px-2.5 pb-2 text-[0.65rem] font-bold uppercase tracking-[0.15em] text-[#5876B0]">Content Manager</p>
                    </li>

                    @foreach([
                        ['label' => 'Banner', 'route' => 'admin.banner.index', 'active' => 'admin.banner.*'],
                        ['label' => 'Beranda', 'route' => 'admin.beranda.index', 'active' => 'admin.beranda.*'],
                        ['label' => 'Tentang', 'route' => 'admin.tentang.index', 'active' => 'admin.tentang.*'],
                        ['label' => 'Mitra', 'route' => 'admin.mitra.index', 'active' => 'admin.mitra.*'],
                        ['label' => 'Stakeholder', 'route' => 'admin.stakeholder.index', 'active' => 'admin.stakeholder.*'],
                        ['label' => 'Program', 'route' => 'admin.program.index', 'active' => 'admin.program.*'],
                        ['label' => 'Proyek', 'route' => 'admin.proyek.index', 'active' => 'admin.proyek.*'],
                        ['label' => 'Berita', 'route' => 'admin.berita.index', 'active' => 'admin.berita.*'],
                        ['label' => 'Struktur Organisasi', 'route' => 'admin.struktur.index', 'active' => 'admin.struktur.*'],
                        ['label' => 'Kontak', 'route' => 'admin.kontak.index', 'active' => 'admin.kontak.*'],
                        ['label' => 'Pesan Kontak', 'route' => 'admin.kontak-form.index', 'active' => 'admin.kontak-form.*'],
                        ['label' => 'Menu', 'route' => 'admin.menu.index', 'active' => 'admin.menu.*'],
                        ['label' => 'Footer', 'route' => 'admin.footer.index', 'active' => 'admin.footer.*'],
                    ] as $item)
                        <li>
                            <a href="{{ route($item['route']) }}" @click="isOpen = false"
                               class="group relative flex items-center rounded-xl p-2.5 text-[15px] text-white/80 transition-all duration-200 hover:bg-white/[0.06] hover:text-white {{ request()->routeIs($item['active']) ? 'bg-gradient-to-r from-[#2B4E94]/80 to-[#16336D] text-white shadow-lg shadow-[#0E2043]/60' : '' }}">
                                @if(request()->routeIs($item['active']))
                                    <span class="absolute left-0 top-1/2 h-6 w-1 -translate-y-1/2 rounded-r-full bg-[#E3DBAF]"></span>
                                @endif
                                <svg class="h-5 w-5 shrink-0 transition duration-200 group-hover:text-[#E3DBAF]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                    <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
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
                </ul>
            </div>

            <!-- Footer card -->
            <div class="relative mt-6 rounded-2xl border border-white/10 bg-white/[0.04] p-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#E3DBAF] to-[#CAB988] font-bold text-[#520A18] shadow-md">
                        {{ Auth::user()->name ? substr(Auth::user()->name, 0, 2) : 'AD' }}
                    </div>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                        <p class="truncate text-xs text-[#5876B0]">Administrator</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>
