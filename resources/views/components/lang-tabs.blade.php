@props(['bahasas'])

<div class="mb-5 flex flex-wrap items-center gap-2">
    @foreach ($bahasas as $bahasa)
        @php
            $hasTabError = false;
            if (isset($errors) && $errors->any()) {
                foreach ($errors->keys() as $key) {
                    if (str_starts_with($key, "translations.{$bahasa->kode}")) {
                        $hasTabError = true;
                        break;
                    }
                }
            }
        @endphp
        <button type="button" @click="lang = @js($bahasa->kode)"
            :class="lang === @js($bahasa->kode) ? 'bg-[#520A18] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
            class="relative flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium transition-colors font-poppins">
            {{ strtoupper($bahasa->kode) }}
            <span class="hidden sm:inline">&middot; {{ $bahasa->nama }}</span>
            @if ($bahasa->is_default)
                <span class="rounded bg-[#E3DBAF] px-1.5 py-0.5 text-[10px] font-semibold text-[#520A18]">Default</span>
            @endif
            @if ($hasTabError)
                <span class="inline-block h-2 w-2 rounded-full bg-rose-500 ring-2 ring-white" title="Terdapat error pada bahasa ini"></span>
            @endif
        </button>
    @endforeach
</div>
