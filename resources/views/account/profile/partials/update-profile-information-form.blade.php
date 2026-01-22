<header>
    <h2 class="text-lg font-semibold text-[#0A0A0C]">
        {{ __('Profile Information') }}
    </h2>

    <p class="mt-1 text-sm text-gray-500">
        {{ __("Update your account's profile information and email address.") }}
    </p>
</header>

{{-- 用于重发验证邮件 --}}
<form id="send-verification" method="post" action="{{ route('verification.send') }}" class="mt-4">
    @csrf
</form>

<form method="post" action="{{ route('account.profile.update') }}" class="mt-5 space-y-5">
    @csrf
    @method('patch')

    {{-- Name + IC --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm text-gray-500 mb-1">
                {{ __('Name') }}
            </label>

            <input name="name" type="text" value="{{ old('name', $user->name) }}" required
                class="w-full rounded-xl border-gray-200 text-base px-3 py-3
                       focus:border-[#15A5ED] focus:ring-[#15A5ED]/30"
                placeholder="Enter your full name" />
        </div>

        <div>
            <label class="block text-sm text-gray-500 mb-1">
                {{ __('IC Number') }}
            </label>

            <input name="ic_number" type="text" value="{{ old('ic_number', $user->ic_number) }}"
                class="w-full rounded-xl border-gray-200 text-base px-3 py-3
                       focus:border-[#15A5ED] focus:ring-[#15A5ED]/30"
                placeholder="e.g. 990101-01-1234" />
        </div>
    </div>

    {{-- Phone + Email --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm text-gray-500 mb-1">
                {{ __('Phone Number') }}
            </label>

            <input name="phone" type="text" value="{{ old('phone', $user->phone) }}"
                class="w-full rounded-xl border-gray-200 text-base px-3 py-3
                       focus:border-[#15A5ED] focus:ring-[#15A5ED]/30"
                placeholder="e.g. 0182222507" />
        </div>

        <div>
            <label class="block text-sm text-gray-500 mb-1">
                {{ __('Email') }}
            </label>

            <input name="email" type="email" value="{{ old('email', $user->email) }}" required
                class="w-full rounded-xl border-gray-200 text-base px-3 py-3
                       focus:border-[#15A5ED] focus:ring-[#15A5ED]/30"
                placeholder="Enter your email address" />

            {{-- 未验证邮箱 --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-gray-700 space-y-1">
                    <p>
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline font-medium text-[#15A5ED]
                                   hover:text-[#0F8DD1]
                                   focus:outline-none focus:ring-2 focus:ring-offset-2
                                   focus:ring-[#15A5ED]/50 text-sm">
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

    {{-- Buttons --}}
    <div class="flex items-center gap-4 pt-3">
        <button type="submit"
            class="px-7 py-3 rounded-full bg-[#15A5ED] text-white
                   text-base font-semibold shadow
                   hover:bg-[#0F8DD1] transition">
            {{ __('Save') }}
        </button>

        @if (session('status') === 'profile-updated')
            <p class="text-sm text-[#15A5ED]">
                {{ __('Saved.') }}
            </p>
        @endif
    </div>
</form>
