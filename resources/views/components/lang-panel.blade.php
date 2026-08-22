@props(['kode'])

<div x-show="lang === @js($kode)" {{ $attributes }}>
    {{ $slot }}
</div>
