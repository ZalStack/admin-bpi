@props([
    'field',
    'label',
    'kode',
    'required' => false,
    'type' => 'text',
    'placeholder' => '',
    'item' => null,
])

@php
$errorKey = "translations.{$kode}.{$field}";
$value = old($errorKey, $item?->translationFor($kode)?->{$field} ?? '');
@endphp

<div>
    <label class="form-label">
        {{ $label }} @if ($required)<span class="text-red-500">*</span>@endif
        <span class="text-xs font-normal text-gray-400">({{ strtoupper($kode) }})</span>
    </label>
    <input type="{{ $type }}" name="translations[{{ $kode }}][{{ $field }}]" value="{{ $value }}"
        placeholder="{{ $placeholder }}" class="form-input">
    @error($errorKey)
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>
