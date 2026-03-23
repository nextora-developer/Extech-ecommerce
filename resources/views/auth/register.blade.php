<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#EEF3F1] text-[#111111]">
    <div class="min-h-screen flex items-center justify-center px-4 py-6 sm:px-6 lg:px-10">
        <div class="w-full max-w-7xl">
            <div class="grid grid-cols-1 lg:grid-cols-[1.05fr_1fr] gap-6 lg:gap-8 items-stretch">

                {{-- =========================================
                    LEFT SIDE
                ========================================== --}}
                <div class="flex items-center">
                    <div class="w-full max-w-md px-2 sm:px-4 lg:px-8">
                        {{-- Logo --}}
                        <div class="mb-14">
                            <a href="/" class="inline-flex items-center gap-3">
                                <img src="{{ asset('images/logo/extechstudio-icon.png') }}" alt="Extech Studio Logo"
                                    class="h-10 w-auto object-contain">

                                <span class="text-xl font-semibold tracking-tight text-black">
                                    Extech Studio
                                </span>
                            </a>
                        </div>

                        @if (session('status'))
                            <div
                                class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- Heading --}}
                        <div class="mb-8">
                            <h1
                                class="text-[2rem] sm:text-[2.15rem] leading-tight font-semibold tracking-tight text-[#111111]">
                                Create Account
                            </h1>
                            <p class="mt-2 text-sm text-[#6B7280]">
                                Please enter your details below
                            </p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="space-y-4">
                            @csrf

                            {{-- Name --}}
                            <div>
                                <label for="name" class="sr-only">Full Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                    placeholder="Full Name"
                                    class="w-full h-14 rounded-2xl border border-[#E5E7EB] bg-white px-5 text-sm text-[#111111] placeholder:text-[#9CA3AF] outline-none transition focus:border-black/20 focus:ring-4 focus:ring-black/5">
                                @error('name')
                                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="sr-only">Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    placeholder="Email"
                                    class="w-full h-14 rounded-2xl border border-[#E5E7EB] bg-white px-5 text-sm text-[#111111] placeholder:text-[#9CA3AF] outline-none transition focus:border-black/20 focus:ring-4 focus:ring-black/5">
                                @error('email')
                                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Referral Code --}}
                            <div>
                                <label for="referral_code" class="sr-only">Referral Code</label>
                                <input id="referral_code" type="text" name="referral_code"
                                    value="{{ old('referral_code', $referralCode ?? request('ref')) }}"
                                    placeholder="Referral Code (Optional)"
                                    class="w-full h-14 rounded-2xl border border-[#E5E7EB] bg-white px-5 text-sm text-[#111111] placeholder:text-[#9CA3AF] outline-none transition focus:border-black/20 focus:ring-4 focus:ring-black/5">
                                @error('referral_code')
                                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div>
                                <label for="password" class="sr-only">Password</label>
                                <div class="relative">
                                    <input id="password" type="password" name="password" required
                                        autocomplete="new-password" placeholder="Password"
                                        class="w-full h-14 rounded-2xl border border-[#E5E7EB] bg-white pl-5 pr-12 text-sm text-[#111111] placeholder:text-[#9CA3AF] outline-none transition focus:border-black/20 focus:ring-4 focus:ring-black/5">

                                    <button type="button"
                                        onclick="const p=document.getElementById('password'); p.type = p.type === 'password' ? 'text' : 'password';"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6B7280] hover:text-[#111111]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 12s3.6-6 9-6 9 6 9 6-3.6 6-9 6-9-6-9-6Z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div>
                                <label for="password_confirmation" class="sr-only">Confirm Password</label>
                                <div class="relative">
                                    <input id="password_confirmation" type="password" name="password_confirmation" required
                                        autocomplete="new-password" placeholder="Confirm Password"
                                        class="w-full h-14 rounded-2xl border border-[#E5E7EB] bg-white pl-5 pr-12 text-sm text-[#111111] placeholder:text-[#9CA3AF] outline-none transition focus:border-black/20 focus:ring-4 focus:ring-black/5">

                                    <button type="button"
                                        onclick="const p=document.getElementById('password_confirmation'); p.type = p.type === 'password' ? 'text' : 'password';"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6B7280] hover:text-[#111111]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 12s3.6-6 9-6 9 6 9 6-3.6 6-9 6-9-6-9-6Z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Register --}}
                            <button type="submit"
                                class="w-full h-14 rounded-2xl bg-[#0A0A0A] text-sm font-semibold text-white shadow-[0_10px_25px_rgba(0,0,0,0.12)] transition hover:bg-black/90">
                                Create account
                            </button>

                            {{-- Divider --}}
                            <div class="relative py-2">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-[#E5E7EB]"></div>
                                </div>
                                <div class="relative flex justify-center">
                                    <span class="bg-[#EEF3F1] px-4 text-xs text-[#9CA3AF]">or</span>
                                </div>
                            </div>

                            {{-- Continue Shopping --}}
                            {{-- <button type="button" onclick="window.location='{{ route('shop.index') }}'"
                                class="w-full h-14 rounded-2xl border border-[#D1D5DB] bg-white
           text-sm font-semibold text-[#111111]
           flex items-center justify-center gap-3
           transition hover:bg-gray-50 active:scale-[0.99]">

                                <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                                </svg>

                                <span>Continue Shopping</span>
                            </button> --}}

                            {{-- Login --}}
                            <p class="pt-2 text-center text-sm text-[#9CA3AF]">
                                Already have an account?
                                <a href="{{ route('login') }}" class="font-semibold text-[#111111] hover:underline">
                                    Sign in
                                </a>
                            </p>
                        </form>
                    </div>
                </div>

                {{-- =========================================
                    RIGHT SIDE
                ========================================== --}}
                <div class="hidden lg:block">
                    <div
                        class="relative h-full min-h-[760px] overflow-hidden rounded-[2rem] bg-[#0C0A12] shadow-[0_20px_60px_rgba(0,0,0,0.18)] border border-white/5">

                        {{-- Background pattern --}}
                        <div class="absolute inset-0 opacity-[0.08]"
                            style="background-image:
                                linear-gradient(to right, rgba(255,255,255,0.12) 1px, transparent 1px),
                                linear-gradient(to bottom, rgba(255,255,255,0.12) 1px, transparent 1px);
                                background-size: 48px 48px;">
                        </div>

                        {{-- Glow --}}
                        <div
                            class="absolute left-1/2 top-28 h-72 w-72 -translate-x-1/2 rounded-full bg-violet-500/20 blur-[120px]">
                        </div>
                        <div class="absolute right-16 bottom-24 h-40 w-40 rounded-full bg-emerald-400/20 blur-[90px]">
                        </div>

                        {{-- Decorative shapes --}}
                        <div
                            class="absolute top-24 left-24 h-12 w-12 rotate-12 rounded-2xl bg-gradient-to-br from-violet-200 to-violet-500 opacity-90 shadow-[0_0_30px_rgba(139,92,246,0.45)]">
                        </div>
                        <div
                            class="absolute bottom-36 right-16 h-20 w-20 rounded-full border-[14px] border-emerald-300/90 shadow-[0_0_40px_rgba(110,231,183,0.35)]">
                        </div>
                        <div class="absolute left-20 bottom-40 h-3 w-3 rotate-12 border-2 border-lime-300"></div>
                        <div class="absolute right-24 top-28 h-3 w-3 rotate-12 border-2 border-yellow-300"></div>

                        <div
                            class="relative z-10 flex h-full flex-col items-center justify-center px-10 py-14 text-center">
                            {{-- Hexagon frame --}}
                            <div class="relative mb-14 flex items-center justify-center">
                                <div
                                    class="absolute h-[430px] w-[360px] rounded-[2.5rem] border border-cyan-300/20 bg-white/[0.02] backdrop-blur-[2px] [clip-path:polygon(25%_6%,75%_6%,100%_50%,75%_94%,25%_94%,0_50%)]">
                                </div>
                                <div
                                    class="absolute h-[430px] w-[360px] [clip-path:polygon(25%_6%,75%_6%,100%_50%,75%_94%,25%_94%,0_50%)] border border-cyan-300/60 shadow-[0_0_35px_rgba(94,234,212,0.25)]">
                                </div>

                                {{-- Illustration placeholder --}}
                                <div class="relative z-10 flex flex-col items-center">
                                    <img src="{{ asset('images/login-cover.png') }}" alt="Register Visual"
                                        class="h-[350px] w-auto object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.45)]">
                                </div>
                            </div>

                            {{-- Bottom text --}}
                            <div class="max-w-md">
                                <h2 class="text-[2rem] font-semibold tracking-tight text-white">
                                    Create Your Account. Start Instantly.
                                </h2>
                                <p class="mt-3 text-sm leading-6 text-white/60">
                                    Join now to enjoy faster checkout, instant access to digital products,
                                    and a seamless shopping experience anytime, anywhere.
                                </p>
                            </div>

                            {{-- Dots --}}
                            <div class="mt-10 flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-white/40"></span>
                                <span class="h-2 w-2 rounded-full bg-white"></span>
                                <span class="h-2 w-2 rounded-full bg-white/40"></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- =========================================
                    MOBILE RIGHT CARD
                ========================================== --}}
                {{-- <div class="lg:hidden">
                    <div
                        class="relative overflow-hidden rounded-[2rem] bg-[#0C0A12] px-6 py-10 text-center shadow-[0_20px_60px_rgba(0,0,0,0.18)]">
                        <div class="absolute inset-0 opacity-[0.08]"
                            style="background-image:
                                linear-gradient(to right, rgba(255,255,255,0.12) 1px, transparent 1px),
                                linear-gradient(to bottom, rgba(255,255,255,0.12) 1px, transparent 1px);
                                background-size: 40px 40px;">
                        </div>

                        <div class="relative z-10">
                            <img src="{{ asset('images/login-cover.png') }}" alt="Register Visual"
                                class="mx-auto h-64 w-auto object-contain">

                            <h2 class="mt-6 text-2xl font-semibold text-white">
                                Create Your Account. Start Instantly.
                            </h2>

                            <p class="mt-2 text-sm text-white/60 max-w-md mx-auto">
                                Join now and enjoy a smoother digital shopping experience.
                            </p>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</body>

</html>