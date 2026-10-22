@php
    $item = $item ?? null;
    $defaultSumber = $item
        ? ($item->shortlink_id ? 'shortlink' : 'url')
        : (count($shortlinks) > 0 ? 'shortlink' : 'url');
    $logoMode = old('logo_mode', $item->logo_mode ?? 'bpi');
@endphp

<div class="grid grid-cols-1 gap-6 lg:grid-cols-[minmax(0,1fr)_340px]"
    x-data="qrDesigner({
        shortlinks: @js($shortlinks),
        judul: @js(old('judul', $item->judul ?? '')),
        sumber: @js(old('sumber', $defaultSumber)),
        shortlinkId: @js(old('shortlink_id', $item->shortlink_id ?? ($selectedShortlink ?? ''))),
        urlTujuan: @js(old('url_tujuan', $item->url_tujuan ?? '')),
        fg: @js(old('warna_depan', $item->warna_depan ?? '#16336D')),
        bg: @js(old('warna_latar', $item->warna_latar ?? '#FFFFFF')),
        logoMode: @js($logoMode),
        logoUrl: @js($item && $item->logo_mode === 'upload' ? $item->logo_url : null),
        bpiLogoUrl: @js(asset('images/logo-bpi-qr.png')),
        caption: @js(old('caption', $item->caption ?? '')),
    })">

    {{-- ================= FORM ================= --}}
    <div class="space-y-5">
        <div>
            <label for="judul" class="form-label">Title <span class="text-rose-500">*</span></label>
            <input type="text" name="judul" id="judul" x-model="judul" class="form-input"
                placeholder="e.g.: Event Banner Annual Meeting 2026" maxlength="255" required>
            <p class="mt-1.5 text-xs text-gray-400">Internal label, also used as the download file name.</p>
            @error('judul')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="divider"></div>

        <h3 class="section-label">QR Content</h3>

        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
            <label class="flex cursor-pointer items-start gap-3 rounded-xl border p-3.5 transition"
                :class="sumber === 'shortlink' ? 'border-[#2B4E94] bg-[#2B4E94]/[0.04]' : 'border-gray-200 hover:border-gray-300'">
                <input type="radio" name="sumber" value="shortlink" x-model="sumber" class="mt-0.5 text-[#2B4E94] focus:ring-[#2B4E94]">
                <span>
                    <span class="block text-sm font-semibold text-gray-900">Shortlink <span class="text-[11px] font-semibold text-emerald-600">(recommended)</span></span>
                    <span class="block text-xs text-gray-500">Destination can be changed after printing, scans are counted.</span>
                </span>
            </label>
            <label class="flex cursor-pointer items-start gap-3 rounded-xl border p-3.5 transition"
                :class="sumber === 'url' ? 'border-[#2B4E94] bg-[#2B4E94]/[0.04]' : 'border-gray-200 hover:border-gray-300'">
                <input type="radio" name="sumber" value="url" x-model="sumber" class="mt-0.5 text-[#2B4E94] focus:ring-[#2B4E94]">
                <span>
                    <span class="block text-sm font-semibold text-gray-900">Custom URL</span>
                    <span class="block text-xs text-gray-500">URL is encoded directly: fixed after printing, scans not counted.</span>
                </span>
            </label>
        </div>
        @error('sumber')
            <p class="form-error">{{ $message }}</p>
        @enderror

        <div x-show="sumber === 'shortlink'">
            <label for="shortlink_id" class="form-label">Shortlink <span class="text-rose-500">*</span></label>
            @if(count($shortlinks) === 0)
                <div class="rounded-xl border border-amber-200 bg-amber-50 px-3.5 py-2.5 text-sm text-amber-800">
                    No shortlinks yet. <a href="{{ route('admin.shortlink.create') }}" class="font-semibold underline">Create a shortlink</a> first, or use a custom URL.
                </div>
            @else
                <select name="shortlink_id" id="shortlink_id" x-model="shortlinkId" class="form-select" :required="sumber === 'shortlink'">
                    <option value="">Select shortlink</option>
                    @foreach($shortlinks as $s)
                        <option value="{{ $s['id'] }}">{{ $s['short_url'] }}{{ $s['judul'] ? ' — '.$s['judul'] : '' }}{{ $s['status'] ? '' : ' (inactive)' }}</option>
                    @endforeach
                </select>
                <template x-if="selectedShortlink">
                    <div class="mt-2 space-y-1 text-xs text-gray-500">
                        <p>Redirects to: <span class="break-all text-gray-700" x-text="selectedShortlink.url_tujuan"></span></p>
                        <p x-show="!selectedShortlink.status" class="font-semibold text-rose-600">This shortlink is inactive: scans will show a "not found" page until it is activated.</p>
                    </div>
                </template>
            @endif
            @error('shortlink_id')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div x-show="sumber === 'url'" x-cloak>
            <label for="url_tujuan" class="form-label">Destination URL <span class="text-rose-500">*</span></label>
            <input type="url" name="url_tujuan" id="url_tujuan" x-model="urlTujuan" class="form-input"
                placeholder="https://example.com" maxlength="2048" :required="sumber === 'url'">
            @error('url_tujuan')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="divider"></div>

        <h3 class="section-label">Style</h3>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            @foreach([['warna_depan', 'fg', 'QR Color', 'fgSwatches'], ['warna_latar', 'bg', 'Background Color', 'bgSwatches']] as [$name, $model, $label, $swatches])
                <div>
                    <label for="{{ $name }}" class="form-label">{{ $label }} <span class="text-rose-500">*</span></label>
                    <div class="flex items-center gap-3">
                        <input type="color" x-model="{{ $model }}" class="h-10 w-12 cursor-pointer rounded-xl border border-gray-300 bg-white p-1 shadow-xs">
                        <input type="text" name="{{ $name }}" id="{{ $name }}" x-model="{{ $model }}"
                            class="form-input font-mono uppercase text-sm" maxlength="7" pattern="#[0-9A-Fa-f]{6}" required>
                    </div>
                    <div class="mt-2.5 flex flex-wrap gap-2">
                        <template x-for="c in {{ $swatches }}" :key="c.value">
                            <button type="button" @click="{{ $model }} = c.value" :title="c.label + ' (' + c.value + ')'"
                                :style="`background-color: ${c.value};`"
                                class="h-7 w-7 rounded-full border-2 shadow-xs transition hover:scale-110"
                                :class="{{ $model }}.toUpperCase() === c.value ? 'border-gray-900 ring-2 ring-gray-300 ring-offset-1' : 'border-gray-200'"></button>
                        </template>
                    </div>
                    @error($name)
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach
        </div>

        <div x-show="warning" x-cloak class="rounded-xl border border-amber-200 bg-amber-50 px-3.5 py-2.5 text-xs text-amber-800" x-text="warning"></div>

        <div>
            <span class="form-label">Center Logo</span>
            <div class="flex flex-wrap gap-2">
                @foreach(['bpi' => 'BPI Logo', 'upload' => 'Upload Logo', 'none' => 'No Logo'] as $value => $text)
                    <label class="flex cursor-pointer items-center gap-2 rounded-xl border px-3.5 py-2 text-sm font-medium transition"
                        :class="logoMode === '{{ $value }}' ? 'border-[#2B4E94] bg-[#2B4E94]/[0.04] text-[#2B4E94]' : 'border-gray-200 text-gray-700 hover:border-gray-300'">
                        <input type="radio" name="logo_mode" value="{{ $value }}" x-model="logoMode" class="text-[#2B4E94] focus:ring-[#2B4E94]">
                        {{ $text }}
                    </label>
                @endforeach
            </div>
            <div x-show="logoMode === 'upload'" x-cloak class="mt-3">
                <input type="file" name="logo" accept="image/png,image/jpeg,image/webp" class="form-file" @change="onLogoChange($event)">
                <p class="mt-1.5 text-xs text-gray-400">PNG (transparent recommended), JPG, or WEBP. Max 1MB.@if($item && $item->logo) Leave empty to keep the current logo.@endif</p>
            </div>
            @error('logo_mode')
                <p class="form-error">{{ $message }}</p>
            @enderror
            @error('logo')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="caption" class="form-label">Caption</label>
            <input type="text" name="caption" id="caption" x-model="caption" class="form-input"
                placeholder="e.g.: Scan to register" maxlength="60">
            <p class="mt-1.5 text-xs text-gray-400">Optional text below the code, max 60 characters.</p>
            @error('caption')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- ================= LIVE PREVIEW ================= --}}
    <div>
        <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-5 lg:sticky lg:top-24">
            <p class="mb-3 text-xs font-bold uppercase tracking-wider text-gray-700">Live Preview</p>
            <div class="rounded-xl bg-white p-3 ring-1 ring-gray-200">
                <canvas x-effect="render($el)" class="mx-auto h-auto w-full max-w-[300px]"></canvas>
            </div>
            <p class="mt-3 text-[11px] text-gray-500">Encoded content:</p>
            <p class="break-all font-mono text-xs text-gray-800" x-text="content || '-'"></p>
            <div class="mt-4 grid grid-cols-2 gap-2">
                <button type="button" class="btn-outline justify-center" @click="downloadPng()" :disabled="!content">PNG</button>
                <button type="button" class="btn-outline justify-center" @click="downloadSvg()" :disabled="!content">SVG</button>
            </div>
            <p class="mt-2 text-[11px] text-gray-400">Downloads are 1024px, ready for print.</p>
        </div>
    </div>
</div>
