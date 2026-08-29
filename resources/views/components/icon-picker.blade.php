@props([
    'name' => 'icon',
    'value' => '',
    'label' => 'Icon',
    'required' => false,
])

@php
$icons = [
    // Film & Media
    ['code' => 'fa-solid fa-clapperboard', 'name' => 'Film Board / Clapperboard', 'category' => 'film', 'tags' => 'film movie clapperboard cinema shooting'],
    ['code' => 'fa-solid fa-video', 'name' => 'Video Camera', 'category' => 'film', 'tags' => 'video camera recording shooting movie'],
    ['code' => 'fa-solid fa-film', 'name' => 'Film Roll', 'category' => 'film', 'tags' => 'film movie roll cinema'],
    ['code' => 'fa-solid fa-camera', 'name' => 'Photo Camera', 'category' => 'film', 'tags' => 'camera photo image picture'],
    ['code' => 'fa-solid fa-tv', 'name' => 'Television / Screen', 'category' => 'film', 'tags' => 'tv television screen monitor'],
    ['code' => 'fa-solid fa-play', 'name' => 'Play Button', 'category' => 'film', 'tags' => 'play video watch'],
    ['code' => 'fa-solid fa-headphones', 'name' => 'Audio / Headphone', 'category' => 'film', 'tags' => 'audio headphone music sound'],
    ['code' => 'fa-solid fa-photo-film', 'name' => 'Film Media', 'category' => 'film', 'tags' => 'media film photo gallery'],

    // Innovation & Creative
    ['code' => 'fa-solid fa-lightbulb', 'name' => 'Idea & Innovation', 'category' => 'inovasi', 'tags' => 'idea innovation creative thought solution'],
    ['code' => 'fa-solid fa-sparkles', 'name' => 'Creativity / Star', 'category' => 'inovasi', 'tags' => 'star sparkle creative excellence achievement innovation'],
    ['code' => 'fa-solid fa-rocket', 'name' => 'Rocket & Acceleration', 'category' => 'inovasi', 'tags' => 'rocket fast acceleration launch fly progress'],
    ['code' => 'fa-solid fa-star', 'name' => 'Star / Core Value', 'category' => 'inovasi', 'tags' => 'star favorite main value rating'],
    ['code' => 'fa-solid fa-leaf', 'name' => 'Leaf & Sustainability', 'category' => 'inovasi', 'tags' => 'leaf eco green environment sustainable sustainability'],
    ['code' => 'fa-solid fa-puzzle-piece', 'name' => 'Puzzle / Collaboration', 'category' => 'inovasi', 'tags' => 'puzzle part integration synergy solution'],

    // HR & Community
    ['code' => 'fa-solid fa-users', 'name' => 'Community / Association', 'category' => 'sdm', 'tags' => 'people users community association group society'],
    ['code' => 'fa-solid fa-user-group', 'name' => 'Group / Team', 'category' => 'sdm', 'tags' => 'group team member organization squad'],
    ['code' => 'fa-solid fa-handshake', 'name' => 'Partnership & Cooperation', 'category' => 'sdm', 'tags' => 'handshake partner cooperation collaboration synergy'],
    ['code' => 'fa-solid fa-hand-holding-heart', 'name' => 'Appreciation & Support', 'category' => 'sdm', 'tags' => 'heart care appreciation social help support'],
    ['code' => 'fa-solid fa-heart', 'name' => 'Passion & Spirit', 'category' => 'sdm', 'tags' => 'heart love passion interest'],

    // Education & Certification
    ['code' => 'fa-solid fa-graduation-cap', 'name' => 'Toga & HR Education', 'category' => 'edukasi', 'tags' => 'toga graduation school college education training certification degree'],
    ['code' => 'fa-solid fa-book-open', 'name' => 'Book / Research & Study', 'category' => 'edukasi', 'tags' => 'book read research science knowledge study archive'],
    ['code' => 'fa-solid fa-award', 'name' => 'Award & Festival', 'category' => 'edukasi', 'tags' => 'trophy medal award winner appreciation festival nomination'],
    ['code' => 'fa-solid fa-certificate', 'name' => 'Professional Certification', 'category' => 'edukasi', 'tags' => 'certificate permit license standard qualification'],

    // Law & Regulation
    ['code' => 'fa-solid fa-gavel', 'name' => 'Gavel & Regulation', 'category' => 'hukum', 'tags' => 'gavel hearing law advocacy regulation policy legislation rules'],
    ['code' => 'fa-solid fa-scale-balanced', 'name' => 'Scales of Justice', 'category' => 'hukum', 'tags' => 'scales law justice regulation copyright'],
    ['code' => 'fa-solid fa-shield-halved', 'name' => 'Protection & Copyright', 'category' => 'hukum', 'tags' => 'shield protect secure protection copyright security'],
    ['code' => 'fa-solid fa-file-lines', 'name' => 'Document & Policy', 'category' => 'hukum', 'tags' => 'document letter paper manuscript policy file'],

    // Business & Global
    ['code' => 'fa-solid fa-globe', 'name' => 'Global Market / International', 'category' => 'global', 'tags' => 'globe earth global international overseas export market'],
    ['code' => 'fa-solid fa-bullseye', 'name' => 'Target & Goals', 'category' => 'global', 'tags' => 'target goal achievement objective roadmap mission'],
    ['code' => 'fa-solid fa-chart-line', 'name' => 'Industry Growth', 'category' => 'global', 'tags' => 'graph growth economy business trend development'],
    ['code' => 'fa-solid fa-building-columns', 'name' => 'Institution / Organization', 'category' => 'global', 'tags' => 'building pillar bank institution ministry government'],
    ['code' => 'fa-solid fa-link', 'name' => 'Connection & Coordination', 'category' => 'global', 'tags' => 'chain link connection relationship coordination network'],
    ['code' => 'fa-solid fa-briefcase', 'name' => 'Business & Professionalism', 'category' => 'global', 'tags' => 'briefcase work business industry profession commercial'],
];
@endphp

<div x-data="{
    openModal: false,
    selectedIcon: @js(old($name, $value)),
    searchQuery: '',
    activeCategory: 'all',
    iconList: @js($icons),

    get filteredIcons() {
        return this.iconList.filter(item => {
            const matchCategory = this.activeCategory === 'all' || item.category === this.activeCategory;
            const query = this.searchQuery.toLowerCase().trim();
            const matchSearch = !query || 
                item.name.toLowerCase().includes(query) || 
                item.code.toLowerCase().includes(query) || 
                item.tags.toLowerCase().includes(query);
            return matchCategory && matchSearch;
        });
    },

    selectIcon(code) {
        this.selectedIcon = code;
        this.openModal = false;
    }
}" class="w-full">
    <label for="{{ $name }}" class="form-label">
        {{ $label }} @if ($required)<span class="text-red-500">*</span>@endif
    </label>

    <div class="flex items-center gap-3">
        <!-- Live Icon Preview Box -->
        <div class="flex h-[46px] w-[46px] shrink-0 items-center justify-center rounded-xl border border-gray-300 bg-gray-50 text-[#1B365D] shadow-sm">
            <template x-if="selectedIcon">
                <i :class="selectedIcon" class="text-xl"></i>
            </template>
            <template x-if="!selectedIcon">
                <i class="fa-solid fa-icons text-xl text-gray-300"></i>
            </template>
        </div>

        <!-- Input Field -->
        <div class="relative flex-1">
            <input type="text" name="{{ $name }}" id="{{ $name }}"
                x-model="selectedIcon"
                placeholder="Select or type icon..."
                class="form-input pr-10 font-mono text-xs text-gray-700">
        </div>

        <!-- Button to open Visual Picker -->
        <button type="button" @click="openModal = true"
            class="inline-flex h-[46px] items-center gap-2 rounded-xl bg-[#1B365D] px-4 text-xs font-semibold text-white shadow-sm hover:bg-[#132847] transition-all hover:scale-[1.02] cursor-pointer">
            <i class="fa-solid fa-shapes text-sm text-[#F6E4AC]"></i>
            <span>Select Icon</span>
        </button>
    </div>

    <p class="mt-1 text-[11px] text-gray-400">
        Click the <strong>"Select Icon"</strong> button to visually select an icon without memorizing codes.
    </p>

    <!-- Modal Visual Icon Picker -->
    <div x-show="openModal"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4 backdrop-blur-sm"
         style="display: none;"
         @keydown.escape.window="openModal = false">

        <div @click.away="openModal = false"
             class="flex max-h-[85vh] w-full max-w-3xl flex-col rounded-3xl bg-white shadow-2xl overflow-hidden border border-gray-100 animate-in fade-in zoom-in duration-200">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#1B365D]/10 text-[#1B365D]">
                        <i class="fa-solid fa-icons text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Select Icon Visually</h3>
                        <p class="text-xs text-gray-500">Click one of the icons below to insert it into the form</p>
                    </div>
                </div>
                <button type="button" @click="openModal = false" class="rounded-xl p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors cursor-pointer">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Search & Filters -->
            <div class="p-6 pb-2 space-y-3 bg-white">
                <!-- Search Box -->
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" x-model="searchQuery"
                           placeholder="Search icons... (e.g.: film, camera, people, light, law, toga, globe, target, rocket)"
                           class="w-full rounded-2xl border border-gray-200 bg-gray-50/70 py-2.5 pl-11 pr-4 text-xs font-medium text-gray-800 placeholder-gray-400 focus:border-[#1B365D] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1B365D]/10 transition-all">
                    <button type="button" x-show="searchQuery" @click="searchQuery = ''" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 text-xs">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </button>
                </div>

                <!-- Category Tabs -->
                <div class="flex flex-wrap items-center gap-1.5 pt-1 text-xs">
                    <button type="button" @click="activeCategory = 'all'"
                        :class="activeCategory === 'all' ? 'bg-[#1B365D] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        All Icons
                    </button>
                    <button type="button" @click="activeCategory = 'film'"
                        :class="activeCategory === 'film' ? 'bg-[#1B365D] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        🎬 Film & Media
                    </button>
                    <button type="button" @click="activeCategory = 'sdm'"
                        :class="activeCategory === 'sdm' ? 'bg-[#1B365D] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        👥 HR & Community
                    </button>
                    <button type="button" @click="activeCategory = 'inovasi'"
                        :class="activeCategory === 'inovasi' ? 'bg-[#1B365D] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        💡 Innovation & Creative
                    </button>
                    <button type="button" @click="activeCategory = 'edukasi'"
                        :class="activeCategory === 'edukasi' ? 'bg-[#1B365D] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        🎓 Education & Achievement
                    </button>
                    <button type="button" @click="activeCategory = 'hukum'"
                        :class="activeCategory === 'hukum' ? 'bg-[#1B365D] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        ⚖️ Law & Policy
                    </button>
                    <button type="button" @click="activeCategory = 'global'"
                        :class="activeCategory === 'global' ? 'bg-[#1B365D] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        🌍 Global & Business
                    </button>
                </div>
            </div>

            <!-- Icons Grid Scrollable -->
            <div class="flex-1 overflow-y-auto p-6 pt-3">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2.5">
                    <template x-for="item in filteredIcons" :key="item.code">
                        <button type="button" @click="selectIcon(item.code)"
                            :class="selectedIcon === item.code ? 'border-[#1B365D] bg-[#1B365D]/5 ring-2 ring-[#1B365D]/20' : 'border-gray-200 hover:border-[#1B365D]/40 hover:bg-gray-50/80'"
                            class="group flex flex-col items-center justify-center p-3.5 rounded-2xl border text-center transition-all cursor-pointer">
                            <div :class="selectedIcon === item.code ? 'text-[#1B365D] scale-110' : 'text-gray-600 group-hover:text-[#1B365D] group-hover:scale-110'"
                                 class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100/80 transition-all mb-2">
                                <i :class="item.code" class="text-xl"></i>
                            </div>
                            <span class="text-xs font-semibold text-gray-800 leading-snug line-clamp-1" x-text="item.name"></span>
                            <span class="text-[10px] text-gray-400 font-mono mt-0.5" x-text="item.code.replace('fa-solid ', '')"></span>
                        </button>
                    </template>
                </div>

                <!-- Empty State -->
                <div x-show="filteredIcons.length === 0" class="py-12 text-center">
                    <i class="fa-solid fa-magnifying-glass text-3xl text-gray-300 mb-2"></i>
                    <p class="text-xs font-medium text-gray-500">No icons match your search.</p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="border-t border-gray-100 px-6 py-3 bg-gray-50 flex items-center justify-between text-xs text-gray-500">
                <span>Selected icon: <strong class="text-gray-800 font-mono" x-text="selectedIcon || 'Not yet selected'"></strong></span>
                <button type="button" @click="openModal = false" class="rounded-xl px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200 transition-colors cursor-pointer">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
