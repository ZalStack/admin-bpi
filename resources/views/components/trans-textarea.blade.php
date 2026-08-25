@props([
    'field',
    'label',
    'kode',
    'required' => false,
    'rows' => 4,
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
    <textarea name="translations[{{ $kode }}][{{ $field }}]" rows="{{ $rows }}"
        placeholder="{{ $placeholder }}" class="form-textarea">{{ $value }}</textarea>
    @error($errorKey)
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>
