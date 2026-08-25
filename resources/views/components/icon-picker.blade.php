@props([
    'name' => 'icon',
    'value' => '',
    'label' => 'Icon',
    'required' => false,
])

@php
$icons = [
    // Perfilman & Media
    ['code' => 'fa-solid fa-clapperboard', 'name' => 'Papan Film / Clapperboard', 'category' => 'film', 'tags' => 'film movie clapperboard bioskop sinema syuting'],
    ['code' => 'fa-solid fa-video', 'name' => 'Kamera Video', 'category' => 'film', 'tags' => 'video camera rekaman syuting movie'],
    ['code' => 'fa-solid fa-film', 'name' => 'Rol Film', 'category' => 'film', 'tags' => 'film movie roll sinema bioskop'],
    ['code' => 'fa-solid fa-camera', 'name' => 'Kamera Foto', 'category' => 'film', 'tags' => 'kamera foto photo gambar picture'],
    ['code' => 'fa-solid fa-tv', 'name' => 'Televisi / Layar', 'category' => 'film', 'tags' => 'tv televisi layar screen monitor'],
    ['code' => 'fa-solid fa-play', 'name' => 'Tombol Play', 'category' => 'film', 'tags' => 'play putar video tonton'],
    ['code' => 'fa-solid fa-headphones', 'name' => 'Audio / Headphone', 'category' => 'film', 'tags' => 'audio suara headphone musik sound'],
    ['code' => 'fa-solid fa-photo-film', 'name' => 'Media Perfilman', 'category' => 'film', 'tags' => 'media film galeri foto'],

    // Inovasi & Ide Kreatif
    ['code' => 'fa-solid fa-lightbulb', 'name' => 'Lampu Ide & Inovasi', 'category' => 'inovasi', 'tags' => 'lampu ide inovasi kreatif pikiran solusi gagas'],
    ['code' => 'fa-solid fa-sparkles', 'name' => 'Kreativitas / Bintang', 'category' => 'inovasi', 'tags' => 'bintang kilau kreatif unggul prestasi inovasi'],
    ['code' => 'fa-solid fa-rocket', 'name' => 'Roket & Akselerasi', 'category' => 'inovasi', 'tags' => 'roket cepat akselerasi luncur terbang maju'],
    ['code' => 'fa-solid fa-star', 'name' => 'Bintang / Nilai Utama', 'category' => 'inovasi', 'tags' => 'bintang star favorit utama nilai rating'],
    ['code' => 'fa-solid fa-leaf', 'name' => 'Daun & Keberlanjutan', 'category' => 'inovasi', 'tags' => 'daun eco green hijau lingkungan lestari keberlanjutan sustainability'],
    ['code' => 'fa-solid fa-puzzle-piece', 'name' => 'Puzzle / Kolaborasi', 'category' => 'inovasi', 'tags' => 'puzzle bagian integrasi sinergi solusi'],

    // SDM & Komunitas
    ['code' => 'fa-solid fa-users', 'name' => 'Komunitas / Asosiasi', 'category' => 'sdm', 'tags' => 'orang orang-banyak users sdm komunitas asosiasi sineas kelompok masyarakat'],
    ['code' => 'fa-solid fa-user-group', 'name' => 'Grup / Tim Kerja', 'category' => 'sdm', 'tags' => 'grup tim kerja anggota organisasi squad'],
    ['code' => 'fa-solid fa-handshake', 'name' => 'Kemitraan & Kerjasama', 'category' => 'sdm', 'tags' => 'jabat tangan handshake mitra partner kerjasama kolaborasi sinergi'],
    ['code' => 'fa-solid fa-hand-holding-heart', 'name' => 'Apresiasi & Dukungan', 'category' => 'sdm', 'tags' => 'hati peduli kasih apresiasi sosial bantuan support'],
    ['code' => 'fa-solid fa-heart', 'name' => 'Passion & Semangat', 'category' => 'sdm', 'tags' => 'hati suka cinta passion minat'],

    // Pendidikan & Sertifikasi
    ['code' => 'fa-solid fa-graduation-cap', 'name' => 'Toga & Pendidikan SDM', 'category' => 'edukasi', 'tags' => 'toga wisuda sekolah kuliah pendidikan edukasi pelatihan sertifikasi sdm gelar'],
    ['code' => 'fa-solid fa-book-open', 'name' => 'Buku / Riset & Kajian', 'category' => 'edukasi', 'tags' => 'buku baca riset penelitian ilmu pengetahuan studi arsip'],
    ['code' => 'fa-solid fa-award', 'name' => 'Penghargaan & Festival', 'category' => 'edukasi', 'tags' => 'piala medali award juara apresiasi festival nominasi'],
    ['code' => 'fa-solid fa-certificate', 'name' => 'Sertifikasi Profesi', 'category' => 'edukasi', 'tags' => 'sertifikat izin lisensi standar kelayakan'],

    // Hukum & Regulasi
    ['code' => 'fa-solid fa-gavel', 'name' => 'Palu Sidang & Regulasi', 'category' => 'hukum', 'tags' => 'palu sidang hukum advokasi regulasi kebijakan undang-undang aturan'],
    ['code' => 'fa-solid fa-scale-balanced', 'name' => 'Timbangan Keadilan', 'category' => 'hukum', 'tags' => 'timbangan hukum adil regulasi hak kekayaan cipta'],
    ['code' => 'fa-solid fa-shield-halved', 'name' => 'Perlindungan & Hak Cipta', 'category' => 'hukum', 'tags' => 'tameng perisai lindung aman proteksi hak cipta security'],
    ['code' => 'fa-solid fa-file-lines', 'name' => 'Dokumen & Kebijakan', 'category' => 'hukum', 'tags' => 'dokumen surat kertas naskah kebijakan berkas'],

    // Bisnis & Global
    ['code' => 'fa-solid fa-globe', 'name' => 'Pasar Global / Internasional', 'category' => 'global', 'tags' => 'dunia bola bumi global internasional luar negeri ekspor pasar'],
    ['code' => 'fa-solid fa-bullseye', 'name' => 'Target & Sasaran', 'category' => 'global', 'tags' => 'target panah sasaran capaian tujuan roadmap misi'],
    ['code' => 'fa-solid fa-chart-line', 'name' => 'Pertumbuhan Industri', 'category' => 'global', 'tags' => 'grafik naik tumbuh ekonomi bisnis tren perkembangan'],
    ['code' => 'fa-solid fa-building-columns', 'name' => 'Institusi / Kelembagaan', 'category' => 'global', 'tags' => 'gedung pilar bank lembaga kementerian bpi institusi pemerintah'],
    ['code' => 'fa-solid fa-link', 'name' => 'Koneksi & Koordinasi', 'category' => 'global', 'tags' => 'rantai link tautan hubung relasi koordinasi jejaring'],
    ['code' => 'fa-solid fa-briefcase', 'name' => 'Bisnis & Profesionalisme', 'category' => 'global', 'tags' => 'tas koper kerja bisnis industri profesi komersial'],
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
                placeholder="Pilih atau ketik icon..."
                class="form-input pr-10 font-mono text-xs text-gray-700">
        </div>

        <!-- Button to open Visual Picker -->
        <button type="button" @click="openModal = true"
            class="inline-flex h-[46px] items-center gap-2 rounded-xl bg-[#1B365D] px-4 text-xs font-semibold text-white shadow-sm hover:bg-[#132847] transition-all hover:scale-[1.02] cursor-pointer">
            <i class="fa-solid fa-shapes text-sm text-[#F6E4AC]"></i>
            <span>Pilih Icon</span>
        </button>
    </div>

    <p class="mt-1 text-[11px] text-gray-400">
        Klik tombol <strong>"Pilih Icon"</strong> untuk memilih icon secara visual tanpa perlu menghafal kode.
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
                        <h3 class="text-base font-bold text-gray-900">Pilih Icon Secara Visual</h3>
                        <p class="text-xs text-gray-500">Klik salah satu icon di bawah untuk memasukkannya ke formulir</p>
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
                           placeholder="Cari icon... (contoh: film, kamera, orang, lampu, hukum, toga, dunia, target, roket)"
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
                        Semua Icon
                    </button>
                    <button type="button" @click="activeCategory = 'film'"
                        :class="activeCategory === 'film' ? 'bg-[#1B365D] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        ?? Perfilman & Media
                    </button>
                    <button type="button" @click="activeCategory = 'sdm'"
                        :class="activeCategory === 'sdm' ? 'bg-[#1B365D] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        ?? SDM & Komunitas
                    </button>
                    <button type="button" @click="activeCategory = 'inovasi'"
                        :class="activeCategory === 'inovasi' ? 'bg-[#1B365D] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        ?? Inovasi & Kreatif
                    </button>
                    <button type="button" @click="activeCategory = 'edukasi'"
                        :class="activeCategory === 'edukasi' ? 'bg-[#1B365D] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        ?? Edukasi & Prestasi
                    </button>
                    <button type="button" @click="activeCategory = 'hukum'"
                        :class="activeCategory === 'hukum' ? 'bg-[#1B365D] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        ?? Hukum & Kebijakan
                    </button>
                    <button type="button" @click="activeCategory = 'global'"
                        :class="activeCategory === 'global' ? 'bg-[#1B365D] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="rounded-xl px-3 py-1.5 font-medium transition-colors cursor-pointer">
                        ?? Global & Bisnis
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
                    <p class="text-xs font-medium text-gray-500">Tidak ada icon yang cocok dengan pencarian Anda.</p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="border-t border-gray-100 px-6 py-3 bg-gray-50 flex items-center justify-between text-xs text-gray-500">
                <span>Icon terpilih: <strong class="text-gray-800 font-mono" x-text="selectedIcon || 'Belum dipilih'"></strong></span>
                <button type="button" @click="openModal = false" class="rounded-xl px-4 py-2 font-semibold text-gray-700 hover:bg-gray-200 transition-colors cursor-pointer">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
