<header>
    <div class="flex items-center gap-3">
        <h2 class="text-lg font-semibold text-[#0A0A0C]">
            {{ __('Profile Information') }}
        </h2>

        @if ($user->is_verified)
            <span
                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full
                       text-[11px] font-bold uppercase tracking-wider
                       bg-emerald-100 text-emerald-700 border border-emerald-200">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Verified
            </span>
        @else
            <span
                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full
                       text-[11px] font-bold uppercase tracking-wider
                       bg-gray-100 text-gray-500 border border-gray-200">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Unverified
            </span>
        @endif
    </div>

    <p class="mt-1 text-sm text-gray-500">
        {{ __("Update your account's profile information and email address.") }}
    </p>

    <div class="mt-4 rounded-xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-800">
        <strong class="font-semibold">Notice:</strong>
        For security and verification purposes, identity information can only be submitted once.
        Subsequent changes require administrator verification.
    </div>
</header>

<form id="send-verification" method="post" action="{{ route('verification.send') }}" class="mt-4">
    @csrf
</form>

@php
    $isAdmin = auth()->check() && auth()->user()->is_admin;

    $lockName = !$isAdmin && filled($user->name);
    $lockPhone = !$isAdmin && filled($user->phone);
    $lockEmail = !$isAdmin && filled($user->email);

    $lockIcNumber = !$isAdmin && filled($user->ic_number);
    $lockBirthDate = !$isAdmin && filled($user->birth_date);
    $lockIcImage = !$isAdmin && filled($user->ic_image);
@endphp

<form method="post" action="{{ route('account.profile.update') }}" enctype="multipart/form-data"
    class="mt-5 space-y-5">
    @csrf
    @method('patch')

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div>
            <label for="name" class="block text-sm text-gray-500 mb-1">
                {{ __('Full Name') }}
            </label>

            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                {{ $lockName ? 'readonly' : '' }}
                class="w-full rounded-xl border-gray-200 text-base text-gray-900 px-3 py-3
                       focus:border-[#15A5ED] focus:ring-[#15A5ED]/30
                       {{ $lockName ? 'bg-gray-100 text-gray-500 cursor-not-allowed' : '' }}" />

            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="ic_number" class="block text-sm text-gray-500 mb-1">
                {{ __('IC Number') }}
            </label>

            <input id="ic_number" name="ic_number" type="text" value="{{ old('ic_number', $user->ic_number) }}"
                placeholder="e.g. 990101-01-1234" {{ $lockIcNumber ? 'readonly' : '' }}
                class="w-full rounded-xl border-gray-200 text-base text-gray-900 px-3 py-3
                       focus:border-[#15A5ED] focus:ring-[#15A5ED]/30
                       {{ $lockIcNumber ? 'bg-gray-100 text-gray-500 cursor-not-allowed' : '' }}" />

            @error('ic_number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="birth_date" class="block text-sm text-gray-500 mb-1">
                {{ __('Birth Date') }}
            </label>

            <input id="birth_date" name="birth_date" type="date"
                value="{{ old('birth_date', optional($user->birth_date)->format('Y-m-d')) }}"
                {{ $lockBirthDate ? 'readonly' : '' }}
                class="w-full rounded-xl border-gray-200 text-base px-3 py-3 text-gray-900
                       focus:border-[#15A5ED] focus:ring-[#15A5ED]/30
                       {{ $lockBirthDate ? 'bg-gray-100 text-gray-500 cursor-not-allowed' : '' }}" />

            @error('birth_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="phone" class="block text-sm text-gray-500 mb-1">
                {{ __('Phone Number') }}
            </label>

            <input id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}"
                placeholder="e.g. 0182222507" {{ $lockPhone ? 'readonly' : '' }}
                class="w-full rounded-xl border-gray-200 text-base text-gray-900 px-3 py-3
                       focus:border-[#15A5ED] focus:ring-[#15A5ED]/30
                       {{ $lockPhone ? 'bg-gray-100 text-gray-500 cursor-not-allowed' : '' }}" />

            @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm text-gray-500 mb-1">
                {{ __('Email') }}
            </label>

            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                {{ $lockEmail ? 'readonly' : '' }}
                class="w-full rounded-xl border-gray-200 text-base text-gray-900 px-3 py-3
                       focus:border-[#15A5ED] focus:ring-[#15A5ED]/30
                       {{ $lockEmail ? 'bg-gray-100 text-gray-500 cursor-not-allowed' : '' }}" />

            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-gray-700 space-y-1">
                    <p>
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline font-medium text-[#15A5ED] hover:text-[#0F8DD1] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#15A5ED]/50 text-sm">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
    </div>

    @php
        $isAdmin = auth()->user()->is_admin ?? false;
        $hasIc = !empty($user->ic_image);
        $isVerified = $user->is_verified ?? false;

        // 🔥 逻辑
        $lockIcImage = !$isAdmin && $hasIc;

        // 🔥 状态
        if ($hasIc && !$isVerified) {
            $status = 'pending';
        } elseif ($hasIc && $isVerified) {
            $status = 'verified';
        } else {
            $status = 'none';
        }
    @endphp

    <div x-data="{
        preview: null,
        fileChosen(event) {
            const file = event.target.files[0];
            if (!file) return;
            if (this.preview) URL.revokeObjectURL(this.preview);
            this.preview = URL.createObjectURL(file);
        },
        clearPreview() {
            if (this.preview) URL.revokeObjectURL(this.preview);
            this.preview = null;
            this.$refs.fileInput.value = '';
        }
    }" class="space-y-2">

        {{-- Label --}}
        <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-gray-700">
                IC Image
            </label>
        </div>

        <div class="flex flex-col md:flex-row gap-5 items-center md:items-start">

            {{-- Preview --}}
            <div class="relative group w-40 h-28 flex-shrink-0">

                <div
                    class="w-full h-full rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 overflow-hidden flex items-center justify-center transition group-hover:border-[#15A5ED]/50">

                    {{-- Preview --}}
                    <template x-if="preview">
                        <img :src="preview" class="w-full h-full object-cover">
                    </template>

                    {{-- Existing --}}
                    <template x-if="!preview">
                        @if ($hasIc)
                            <img src="{{ asset('storage/' . $user->ic_image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex flex-col items-center text-gray-400">
                                
                                <svg class="w-8 h-8 mb-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>

                                <span class="text-[10px] uppercase font-semibold">No Image</span>
                            </div>
                        @endif
                    </template>
                </div>

                {{-- ❌ Clear --}}
                <button x-show="preview" @click="clearPreview()" type="button" @disabled($lockIcImage)
                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow hover:bg-red-600 disabled:opacity-50">
                    ✕
                </button>
            </div>

            {{-- Controls --}}
            <div class="flex-1 w-full">

                {{-- Upload --}}
                @if (!$lockIcImage)
                    <input type="file" name="ic_image" x-ref="fileInput" accept="image/*" @change="fileChosen"
                        class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-[#15A5ED]/10 file:text-[#15A5ED]
                    hover:file:bg-[#15A5ED]/20 cursor-pointer">

                    <p class="text-xs text-gray-400 mt-2">
                        JPG, PNG, WEBP (Max 4MB)
                    </p>
                @endif

                <div class="mt-3 rounded-xl bg-white shadow-sm overflow-hidden">

                    {{-- 🔥 LOCK STATE --}}
                    @if ($lockIcImage)
                        <div class="flex items-center gap-2 px-3 py-2 bg-amber-50 border-b border-amber-100">
                            <div class="p-1 rounded-md bg-amber-100 text-amber-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>

                            <span class="text-[11px] font-bold uppercase tracking-wider text-amber-700">
                                Submission Locked
                            </span>
                        </div>
                    @endif

                    {{-- 🔥 FILE INFO --}}
                    @if ($hasIc)
                        <div class="flex items-center justify-between px-3 py-2.5">

                            {{-- Left --}}
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-7 h-7 rounded-md bg-[#15A5ED]/10 flex items-center justify-center text-[#15A5ED]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 0115.9 6h.1a5 5 0 011 9.9M15 13l-3 3m0 0l-3-3m3 3V8" />
                                    </svg>
                                </div>

                                <div class="flex flex-col leading-tight">
                                    <span class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold">
                                        Stored Document
                                    </span>
                                    <span class="text-xs font-bold text-gray-700">
                                        IC Uploaded
                                    </span>
                                </div>
                            </div>

                            {{-- Right Actions --}}
                            <div class="flex items-center gap-2">

                                {{-- View --}}
                                <a href="{{ asset('storage/' . $user->ic_image) }}" target="_blank"
                                    class="flex items-center gap-1 px-2.5 py-1.5 rounded-md text-xs font-bold
                    text-gray-600 bg-gray-50 hover:bg-[#15A5ED]/10 hover:text-[#15A5ED]
                    transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View
                                </a>

                                {{-- Download --}}
                                <a href="{{ asset('storage/' . $user->ic_image) }}" download
                                    class="flex items-center gap-1 px-2.5 py-1.5 rounded-md text-xs font-bold
                    text-gray-600 bg-gray-50 hover:bg-[#15A5ED]/10 hover:text-[#15A5ED]
                    transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Error --}}
                @error('ic_image')
                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex items-center gap-4 pt-3">
        <button type="submit"
            class="px-7 py-3 rounded-full bg-[#15A5ED] text-white text-base font-semibold shadow hover:bg-[#0F8DD1] transition">
            {{ __('Save') }}
        </button>

        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-[#15A5ED]">
                {{ __('Saved.') }}
            </p>
        @endif
    </div>
</form>
