@extends('layouts.app')

@section('title', 'Role Management')

@section('content')
@php
    $roleBadge = [
        'super_admin' => 'bg-[#520A18]/[0.06] text-[#520A18] ring-[#520A18]/15',
        'admin' => 'bg-[#2B4E94]/[0.08] text-[#2B4E94] ring-[#2B4E94]/15',
        'editor' => 'bg-emerald-50 text-emerald-700 ring-emerald-200/70',
    ];
    $roleChip = [
        'super_admin' => 'text-[#520A18] ring-[#520A18]/10',
        'admin' => 'text-[#2B4E94] ring-[#2B4E94]/10',
        'editor' => 'text-emerald-700 ring-emerald-700/10',
    ];
    $roleDot = [
        'super_admin' => 'bg-[#520A18]',
        'admin' => 'bg-[#2B4E94]',
        'editor' => 'bg-emerald-600',
    ];
@endphp
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Role Management</span>
            </nav>
            <h1 class="page-title">Role Management</h1>
            <p class="page-subtitle">Manage CMS accounts and assign the Admin or Editor role</p>
            <div class="mt-3 flex flex-wrap gap-2">
                @foreach($roleLabels as $role => $label)
                    <span class="inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold ring-1 shadow-sm {{ $roleChip[$role] }}">
                        <span class="h-1.5 w-1.5 rounded-full {{ $roleDot[$role] }}"></span>
                        {{ $roleCounts[$role] }} {{ $label }}
                    </span>
                @endforeach
            </div>
        </div>
        <a href="{{ route('admin.role-management.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add User
        </a>
    </div>

    <div class="mb-5 grid grid-cols-1 gap-3 md:grid-cols-2">
        <div class="rounded-xl border border-[#2B4E94]/15 bg-[#2B4E94]/[0.04] px-4 py-3 text-sm text-gray-700">
            <p class="font-semibold text-[#2B4E94]">Admin</p>
            <p class="mt-0.5 text-xs text-gray-500">Manages all website content: banner, homepage, about, partners, programs, projects, contact, menu, footer, languages, shortlinks, QR codes, and news.</p>
        </div>
        <div class="rounded-xl border border-emerald-200/70 bg-emerald-50/50 px-4 py-3 text-sm text-gray-700">
            <p class="font-semibold text-emerald-700">Editor</p>
            <p class="mt-0.5 text-xs text-gray-500">Manages news only: articles, news categories, tags, and news galleries.</p>
        </div>
    </div>

    @if($items->isEmpty())
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <h3 class="empty-title">No users yet</h3>
            <p class="empty-desc">Start by adding a new Admin or Editor.</p>
        </div>
    @else
        <div class="table-container">
            <div class="table-scroll">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th class="th">#</th>
                            <th class="th">User</th>
                            <th class="th">Role</th>
                            <th class="th hidden md:table-cell">Created</th>
                            <th class="th text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($items as $index => $item)
                            @php
                                $roles = $item->roles->pluck('name');
                                $isSuperAdmin = $roles->contains('super_admin');
                            @endphp
                            <tr class="tr-hover">
                                <td class="td text-gray-500 font-mono text-xs">{{ $index + 1 }}</td>
                                <td class="td">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#E3DBAF] to-[#CAB988] text-xs font-bold uppercase text-[#520A18]">
                                            {{ mb_substr($item->name, 0, 2) }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-semibold text-gray-900">
                                                {{ $item->name }}
                                                @if($item->id === auth()->id())
                                                    <span class="ml-1 text-xs font-medium text-gray-400">(You)</span>
                                                @endif
                                            </p>
                                            <p class="text-xs text-gray-500">{{ $item->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="td">
                                    <div class="flex flex-wrap gap-1.5">
                                        @forelse($roles as $role)
                                            <span class="badge {{ $roleBadge[$role] ?? 'bg-gray-50 text-gray-600 ring-gray-200' }}">
                                                {{ $roleLabels[$role] ?? $role }}
                                            </span>
                                        @empty
                                            <span class="badge-warning">No role</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="td hidden md:table-cell text-gray-500">
                                    {{ $item->created_at?->format('d M Y') ?? '-' }}
                                </td>
                                <td class="td text-right">
                                    @if($isSuperAdmin)
                                        <span class="inline-flex items-center gap-1 text-xs font-medium text-gray-400" title="Super admin accounts cannot be changed from this menu">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                            Protected
                                        </span>
                                    @else
                                        <div class="flex items-center justify-end gap-1.5">
                                            <a href="{{ route('admin.role-management.edit', $item->id) }}" class="icon-btn-edit" title="Edit">
                                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.role-management.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this user? They will no longer be able to log in to the CMS.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="icon-btn-delete" title="Delete">
                                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
