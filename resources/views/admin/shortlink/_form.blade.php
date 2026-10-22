@php
    $item = $item ?? null;
@endphp

<div class="space-y-5" x-data="{ kode: @js(old('kode', $item->kode ?? '')) }">
    <div>
        <label for="url_tujuan" class="form-label">Destination URL <span class="text-rose-500">*</span></label>
        <input type="url" name="url_tujuan" id="url_tujuan" value="{{ old('url_tujuan', $item->url_tujuan ?? '') }}"
            class="form-input" placeholder="https://example.com/very/long/page?utm_source=..." maxlength="2048" required>
        <p class="mt-1.5 text-xs text-gray-400">The full address visitors are redirected to. It can be changed anytime without changing the short link.</p>
        @error('url_tujuan')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="kode" class="form-label">
            Short Code @if($item)<span class="text-rose-500">*</span>@endif
        </label>
        <div class="flex items-stretch overflow-hidden rounded-xl border border-gray-300/80 bg-white focus-within:border-[#520A18] focus-within:ring-[3px] focus-within:ring-[#520A18]/10">
            <span class="flex items-center border-r border-gray-200 bg-gray-50 px-3 font-mono text-sm text-gray-500 whitespace-nowrap">{{ $baseUrl }}/</span>
            <input type="text" name="kode" id="kode" x-model="kode"
                @input="kode = kode.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '')"
                class="w-full border-0 px-3 py-2.5 font-mono text-sm text-gray-900 focus:outline-none focus:ring-0"
                placeholder="{{ $item ? '' : 'leave empty to auto-generate' }}" maxlength="50" @if($item) required @endif>
        </div>
        <p class="mt-1.5 text-xs text-gray-400">3–50 characters: lowercase letters, numbers, and hyphens (e.g. <span class="font-mono">annual-report-2026</span>).</p>
        @if($item && ($item->qrcodes_count > 0 || $item->jumlah_klik > 0))
            <div class="mt-2 rounded-xl border border-amber-200 bg-amber-50 px-3.5 py-2.5 text-xs text-amber-800">
                This link has been used ({{ number_format($item->jumlah_klik) }} clicks{{ $item->qrcodes_count > 0 ? ', '.$item->qrcodes_count.' QR code(s)' : '' }}).
                Changing the code will break links and printed QR codes that use the old code.
            </div>
        @endif
        @error('kode')
            <p class="form-error">{{ $message }}</p>
        @enderror
        <p class="mt-2 text-sm text-gray-600" x-show="kode.length > 0" x-cloak>
            Short URL: <span class="font-mono font-semibold text-[#2B4E94]">{{ $baseUrl }}/<span x-text="kode"></span></span>
        </p>
    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-[1fr_auto]">
        <div>
            <label for="judul" class="form-label">Title / Note</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul', $item->judul ?? '') }}"
                class="form-input" placeholder="e.g.: Annual Report 2026 (internal label)" maxlength="255">
            @error('judul')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="form-label">Status</label>
            <div class="flex h-[46px] items-center rounded-xl border border-gray-300 bg-gray-50/60 px-3.5">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="status" value="1" class="form-checkbox" @checked(old('status', $item->status ?? true))>
                    <span class="text-sm font-medium text-gray-700">Active</span>
                </label>
            </div>
        </div>
    </div>
</div>
