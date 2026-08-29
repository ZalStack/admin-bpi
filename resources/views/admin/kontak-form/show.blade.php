@extends('layouts.app')

@section('title', 'Contact Message Details')

@section('content')
<div>
    <div class="page-header">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.kontak-form.index') }}">Contact Messages</a>
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Detail</span>
            </nav>
            <h1 class="page-title">Contact Message Details</h1>
            <p class="page-subtitle">Complete message information from {{ $form->nama }}</p>
        </div>
        <a href="{{ route('admin.kontak-form.index') }}" class="btn-outline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Message Card -->
            <div class="form-card">
                <h3 class="section-label">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                    Message Content
                </h3>

                <div class="rounded-xl border border-gray-100 bg-gray-50/50 p-5">
                    <p class="text-sm leading-relaxed text-gray-700 whitespace-pre-wrap">{{ $form->pesan }}</p>
                </div>
            </div>

            <!-- Subject Card -->
            <div class="form-card">
                <h3 class="section-label">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    Subject
                </h3>

                <div class="rounded-xl border border-gray-100 bg-gray-50/50 p-5">
                    <p class="text-sm font-medium text-gray-800">{{ $form->subjek }}</p>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <!-- Sender Info -->
            <div class="form-card">
                <h3 class="section-label">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Sender Information
                </h3>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Name</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $form->nama }}</p>
                    </div>
                    <div class="border-t border-gray-100 pt-4">
                        <p class="text-xs font-medium text-gray-500 mb-1">Email</p>
                        <a href="mailto:{{ $form->email }}" class="text-sm font-medium text-[#2B4E94] hover:underline">{{ $form->email }}</a>
                    </div>
                </div>
            </div>

            <!-- Status & Date -->
            <div class="form-card">
                <h3 class="section-label">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Status & Time
                </h3>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-2">Status</p>
                        <div class="flex flex-wrap gap-2">
                            <button onclick="updateStatus('read')" class="{{ $form->status == 'read' ? 'badge-active' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer text-xs">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                Read
                            </button>
                            <button onclick="updateStatus('pending')" class="{{ $form->status == 'pending' ? 'badge-warning' : 'badge-inactive' }} transition-transform hover:scale-105 cursor-pointer text-xs">
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                Pending
                            </button>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 pt-4">
                        <p class="text-xs font-medium text-gray-500 mb-1">Received on</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $form->created_at->format('d M Y, H:i') }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $form->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="border-t border-gray-100 pt-4">
                        <p class="text-xs font-medium text-gray-500 mb-1">Last updated</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $form->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="form-card">
                <h3 class="section-label">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    Action
                </h3>

                <div class="space-y-2">
                    <a href="mailto:{{ $form->email }}?subject=Re: {{ $form->subjek }}" class="btn-primary w-full justify-center text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Reply via Email
                    </a>
                    <form action="{{ route('admin.kontak-form.destroy', $form->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn w-full justify-center text-sm border border-rose-200 bg-white text-rose-600 hover:bg-rose-50 hover:border-rose-300 focus-visible:ring-rose-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function updateStatus(status) {
    fetch(`/admin/kontak-form/{{ $form->id }}/status/${status}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            window.location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
@endpush
@endsection
