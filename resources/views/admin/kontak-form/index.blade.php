@extends('layouts.app')

@section('title', 'Contact Messages')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Contact Messages</span>
            </nav>
            <h1 class="page-title">Contact Messages</h1>
            <p class="page-subtitle">Manage messages received from the contact form</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-xs font-semibold text-[#520A18] ring-1 ring-[#520A18]/10 shadow-sm">
                <span class="h-1.5 w-1.5 rounded-full bg-[#520A18]"></span>
                {{ $forms->count() }} Messages
            </div>
        </div>
    </div>

    @if($forms->isEmpty())
        <div class="empty-state">
            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <h3 class="empty-title">No messages yet</h3>
            <p class="empty-desc">No messages have been received from the contact form.</p>
        </div>
    @else
        <div class="table-container">
            <div class="table-scroll">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th class="th">Name</th>
                            <th class="th hidden md:table-cell">Email</th>
                            <th class="th hidden sm:table-cell">Subject</th>
                            <th class="th hidden md:table-cell">Status</th>
                            <th class="th hidden lg:table-cell">Date</th>
                            <th class="th text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach($forms as $form)
                            <tr class="tr-hover">
                                <td class="td font-medium text-gray-800">{{ $form->nama }}</td>
                                <td class="td hidden md:table-cell text-sm text-gray-600">{{ $form->email }}</td>
                                <td class="td hidden sm:table-cell text-sm text-gray-600">{{ Str::limit($form->subjek, 30) }}</td>
                                <td class="td hidden md:table-cell">
                                    <span class="{{ $form->status == 'read' ? 'badge-active' : ($form->status == 'pending' ? 'badge-warning' : 'badge-inactive') }}">
                                        {{ ucfirst($form->status) }}
                                    </span>
                                </td>
                                <td class="td hidden lg:table-cell text-sm text-gray-500">{{ $form->created_at->format('d/m/Y H:i') }}</td>
                                <td class="td text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.kontak-form.show', $form->id) }}" class="icon-btn-view" title="Detail">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.kontak-form.destroy', $form->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon-btn-delete" title="Delete">
                                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
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
