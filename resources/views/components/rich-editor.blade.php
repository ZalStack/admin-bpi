@props([
    'field',
    'label',
    'kode',
    'required' => false,
    'placeholder' => 'Tulis konten lengkap...',
    'item' => null,
    'height' => '240px',
])

@php
$errorKey = "translations.{$kode}.{$field}";
$value = old($errorKey, $item?->translationFor($kode)?->{$field} ?? '');
$editorId = "quill-editor-{$kode}-{$field}";
$inputId = "quill-input-{$kode}-{$field}";
@endphp

<div class="rich-editor-wrapper" x-data="{}" x-init="
    $nextTick(() => {
        if (typeof Quill !== 'undefined' && !document.getElementById('{{ $editorId }}').__quill) {
            const quill = new Quill('#{{ $editorId }}', {
                theme: 'snow',
                placeholder: '{{ addslashes($placeholder) }}',
                modules: {
                    toolbar: [
                        [{ 'header': [2, 3, 4, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['blockquote', 'link', 'clean']
                    ]
                }
            });
            document.getElementById('{{ $editorId }}').__quill = quill;

            // Set initial content
            const inputEl = document.getElementById('{{ $inputId }}');
            if (inputEl && inputEl.value) {
                quill.root.innerHTML = inputEl.value;
            }

            // Sync on change
            quill.on('text-change', () => {
                const html = quill.root.innerHTML;
                inputEl.value = (html === '<p><br></p>' || html.trim() === '') ? '' : html;
            });

            // Sync before form submission
            const form = inputEl.closest('form');
            if (form) {
                form.addEventListener('submit', () => {
                    const html = quill.root.innerHTML;
                    inputEl.value = (html === '<p><br></p>' || html.trim() === '') ? '' : html;
                });
            }
        }
    })
">
    <label class="form-label mb-1.5 flex items-center justify-between">
        <span>
            {{ $label }} @if ($required)<span class="text-rose-500">*</span>@endif
            <span class="text-xs font-normal text-gray-400">({{ strtoupper($kode) }})</span>
        </span>
        <span class="text-[11px] font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full ring-1 ring-emerald-200/50">Rich Text Editor</span>
    </label>

    <div class="quill-container rounded-2xl border border-gray-200 bg-white overflow-hidden shadow-sm transition-all focus-within:border-[#97763A] focus-within:ring-2 focus-within:ring-[#97763A]/20">
        <div id="{{ $editorId }}" style="min-height: {{ $height }};" class="quill-editor-body text-sm font-poppins"></div>
    </div>

    <!-- Hidden input holding actual HTML for POST -->
    <textarea name="translations[{{ $kode }}][{{ $field }}]" id="{{ $inputId }}" class="hidden">{{ $value }}</textarea>

    @error($errorKey)
        <p class="form-error mt-1.5">{{ $message }}</p>
    @enderror
</div>
