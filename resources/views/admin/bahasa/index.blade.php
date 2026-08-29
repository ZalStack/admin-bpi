@extends('layouts.app')

@section('title', 'Language Settings')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Language Settings</span>
            </nav>
            <h1 class="page-title">Language Settings</h1>
            <p class="page-subtitle">Manage languages available on the website</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <div class="table-container">
                <div class="table-scroll">
                    <table class="table" x-data="{ editing: null }">
                        <thead class="thead">
                            <tr>
                                <th class="th">Code</th>
                                <th class="th">Name</th>
                                <th class="th hidden sm:table-cell">Status</th>
                                <th class="th text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($items as $bahasa)
                                <tr class="tr-hover" x-show="editing !== '{{ $bahasa->kode }}'">
                                    <td class="td">
                                        <span class="inline-flex items-center rounded-lg bg-[#2B4E94]/10 px-2.5 py-1 font-mono text-xs font-bold uppercase text-[#2B4E94]">{{ $bahasa->kode }}</span>
                                    </td>
                                    <td class="td font-medium text-gray-900">
                                        {{ $bahasa->nama }}
                                        @if ($bahasa->is_default)
                                            <span class="ml-2 inline-flex items-center rounded-full bg-[#97763A]/15 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-[#97763A]">Default</span>
                                        @endif
                                    </td>
                                    <td class="td hidden sm:table-cell">
                                        <button onclick="toggleBahasa('{{ $bahasa->kode }}')" class="{{ $bahasa->aktif ? 'badge-active' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer" {{ $bahasa->is_default ? 'disabled title="The default language cannot be deactivated or deleted"' : '' }}>
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            {{ $bahasa->aktif ? 'Active' : 'Inactive' }}
                                        </button>
                                    </td>
                                    <td class="td text-right">
                                        <div class="flex items-center justify-end gap-1.5">
                                            @unless ($bahasa->is_default)
                                                <form action="{{ route('admin.bahasa.set-default', $bahasa->kode) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="icon-btn-gold !h-8 !w-8" title="Set as Default">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endunless
                                            <button type="button" class="icon-btn-edit !h-8 !w-8" title="Edit" @click="editing = editing === '{{ $bahasa->kode }}' ? null : '{{ $bahasa->kode }}'">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            @unless ($bahasa->is_default)
                                                <form action="{{ route('admin.bahasa.destroy', $bahasa->kode) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this language? All translations in this language will also be deleted.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="icon-btn-delete !h-8 !w-8" title="Delete">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endunless
                                        </div>
                                    </td>
                                </tr>
                                <tr x-show="editing === '{{ $bahasa->kode }}'" x-cloak>
                                    <td colspan="4" class="td bg-gray-50/60">
                                        <form action="{{ route('admin.bahasa.update', $bahasa->kode) }}" method="POST" class="flex flex-wrap items-end gap-3 p-2">
                                            @csrf
                                            @method('PUT')
                                            <div class="flex-1 min-w-[200px]">
                                                <label class="form-label">Language Name *</label>
                                                <input type="text" name="nama" value="{{ old('nama', $bahasa->nama) }}" class="form-input" required>
                                                @error('nama')
                                                    <p class="form-error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <label class="flex h-[46px] items-center gap-2 cursor-pointer">
                                                <input type="hidden" name="aktif" value="0">
                                                <input type="checkbox" name="aktif" value="1" {{ old('aktif', $bahasa->aktif) ? 'checked' : '' }} class="form-checkbox" {{ $bahasa->is_default ? 'checked disabled' : '' }}>
                                                <span class="text-sm font-medium text-gray-700">Active</span>
                                            </label>
                                            <button type="submit" class="btn-primary">Save</button>
                                            <button type="button" class="btn-outline" @click="editing = null">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div>
            <div class="form-card">
                <h3 class="section-label">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Language
                </h3>

                <form action="{{ route('admin.bahasa.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="kode" class="form-label">Code *</label>
                        <input type="text" name="kode" id="kode" value="{{ old('kode') }}" class="form-input font-mono uppercase" placeholder="e.g.: jp" maxlength="5" required>
                        <p class="mt-1.5 text-xs text-gray-400">ISO code 2-5 characters, e.g.: id, en, jp.</p>
                        @error('kode')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nama" class="form-label">Language Name *</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-input" placeholder="e.g.: Japan" required>
                        @error('nama')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="aktif" value="0">
                            <input type="checkbox" name="aktif" value="1" checked class="form-checkbox">
                            <span class="text-sm font-medium text-gray-700">Active immediately</span>
                        </label>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center">Add</button>
                </form>
            </div>

            <div class="mt-4 rounded-xl border border-blue-100 bg-blue-50/60 p-4 text-xs leading-relaxed text-gray-600">
                <p class="font-semibold text-[#2B4E94]">Note:</p>
                <ul class="mt-1.5 list-disc space-y-1 pl-4">
                    <li>The default language cannot be deactivated or deleted.</li>
                    <li>Deleting a language will remove all translations in that language.</li>
                    <li>Main content is stored neutrally; translations are filled per language tab on each CMS page.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleBahasa(kode) {
    fetch(`/admin/bahasa/${kode}/toggle-status`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
    })
    .then(res => res.json().then(data => ({ ok: res.ok, data })))
    .then(({ ok, data }) => {
        if (!ok) {
            alert(data.message || 'Failed to change language status.');
            return;
        }
        window.location.reload();
    })
    .catch(() => alert('Network error occurred.'));
}
</script>
@endpush
@endsection
