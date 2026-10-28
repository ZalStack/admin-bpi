{{-- Toggle bahasa guide. $bahasa = bahasa aktif, $t = teks antarmuka (lihat Panduan::TEKS). --}}
<div class="inline-flex items-center rounded-xl border border-gray-200 bg-white p-1 shadow-sm print:hidden" role="group" aria-label="{{ $t['bahasa_panduan'] }}">
    @foreach(\App\Support\Panduan::BAHASA as $kode => $label)
        <a href="{{ request()->fullUrlWithQuery(['lang' => $kode]) }}"
           @if($kode === $bahasa) aria-current="true" @endif
           class="rounded-lg px-3 py-1.5 text-sm font-semibold transition-colors {{ $kode === $bahasa ? 'bg-[#520A18] text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-800' }}">
            {{ $label }}
        </a>
    @endforeach
</div>
