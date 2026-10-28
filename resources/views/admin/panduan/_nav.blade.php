{{-- Daftar bab panduan per grup. $grups dari PanduanController, $aktif = slug bab yang dibuka. --}}
<nav class="space-y-5 text-sm">
    @foreach($grups as $grup => $babs)
        <div>
            <p class="px-3 pb-1.5 text-[0.65rem] font-bold uppercase tracking-[0.15em] text-[#5876B0]">{{ $grup }}</p>
            <ul class="space-y-0.5">
                @foreach($babs as $item)
                    <li>
                        <a href="{{ route('admin.panduan.show', $item['slug']) }}"
                           class="block rounded-lg px-3 py-1.5 transition-colors {{ ($aktif ?? null) === $item['slug'] ? 'bg-[#520A18] font-semibold text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            {{ $item['judul'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</nav>
