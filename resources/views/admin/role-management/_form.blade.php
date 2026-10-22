@php
    $item = $item ?? null;
    $roleDescriptions = [
        'admin' => 'All website content, tools, languages, and news.',
        'editor' => 'News only: articles, categories, tags, and galleries.',
    ];
    $currentRole = old('role', $item?->roles->pluck('name')->first() ?? 'editor');
@endphp

<div class="space-y-5">
    <div class="input-group">
        <div>
            <label for="name" class="form-label">Name <span class="text-rose-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $item->name ?? '') }}"
                class="form-input" placeholder="e.g.: Siti Rahma" maxlength="255" required autocomplete="off">
            @error('name')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email" class="form-label">Email <span class="text-rose-500">*</span></label>
            <input type="email" name="email" id="email" value="{{ old('email', $item->email ?? '') }}"
                class="form-input" placeholder="name@bpi.com" maxlength="255" required autocomplete="off">
            <p class="mt-1.5 text-xs text-gray-400">Used to log in to the CMS.</p>
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label class="form-label">Role <span class="text-rose-500">*</span></label>
        <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
            @foreach($roles as $value => $label)
                <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-gray-300/80 bg-white px-4 py-3 transition hover:border-[#520A18]/40 has-[:checked]:border-[#520A18] has-[:checked]:bg-[#520A18]/[0.03] has-[:checked]:ring-[3px] has-[:checked]:ring-[#520A18]/10">
                    <input type="radio" name="role" value="{{ $value }}" class="mt-0.5 h-4 w-4 border-gray-300 text-[#520A18] focus:ring-[#520A18]" @checked($currentRole === $value) required>
                    <span>
                        <span class="block text-sm font-semibold text-gray-900">{{ $label }}</span>
                        <span class="block text-xs text-gray-500">{{ $roleDescriptions[$value] ?? '' }}</span>
                    </span>
                </label>
            @endforeach
        </div>
        @error('role')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="input-group">
        <div>
            <label for="password" class="form-label">
                Password @unless($item)<span class="text-rose-500">*</span>@endunless
            </label>
            <input type="password" name="password" id="password" class="form-input"
                placeholder="{{ $item ? 'Leave empty to keep the current password' : 'Minimum 8 characters' }}"
                autocomplete="new-password" @unless($item) required @endunless>
            @error('password')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password_confirmation" class="form-label">
                Confirm Password @unless($item)<span class="text-rose-500">*</span>@endunless
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input"
                placeholder="Repeat the password" autocomplete="new-password" @unless($item) required @endunless>
        </div>
    </div>
    @if($item)
        <p class="-mt-2 text-xs text-gray-400">Fill in only if you want to reset this user's password.</p>
    @endif
</div>
