<x-guest-layout>
    @if (session('status'))
        <div class="max-w-5xl mx-auto mb-6 px-4 py-3 rounded-xl bg-sky-50 text-sky-900 border border-sky-200 text-sm">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-2 text-[#15a5ed]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ session('status') }}
            </div>
        </div>
    @endif

    <div class="min-h-[calc(100vh-6rem)] flex items-center justify-center px-4 py-10">
        <div
            class="w-full max-w-5xl overflow-hidden rounded-[2rem] bg-white border border-black/10 shadow-[0_30px_90px_-45px_rgba(0,0,0,0.35)]">

            <div class="grid grid-cols-1 lg:grid-cols-2">
                {{-- =======================
                    LEFT: Visual / Welcome
                    ======================= --}}
                <div class="relative hidden lg:block">
                    <div class="absolute inset-0 bg-[linear-gradient(135deg,#0ea5e9_0%,#2563eb_45%,#0b3a7a_100%)]"></div>

                    <div class="absolute inset-0 opacity-30"
                        style="background-image:
                            linear-gradient(to right, rgba(255,255,255,0.15) 1px, transparent 1px),
                            linear-gradient(to bottom, rgba(255,255,255,0.15) 1px, transparent 1px);
                            background-size: 42px 42px;">
                    </div>

                    <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-white/15 blur-3xl"></div>
                    <div class="absolute -bottom-24 -right-24 w-80 h-80 rounded-full bg-cyan-300/20 blur-3xl"></div>

                    <div class="relative h-full p-10 flex flex-col justify-center text-white">
                        <div class="mb-4">
                            <img src="{{ asset('images/logo/extechstudio-white-logo.png') }}" alt="Extech Studio"
                                class="h-14 w-auto opacity-90">
                        </div>

                        <div class="mt-3">
                            <p class="text-sm font-semibold text-white/90">
                                Start your journey with us
                            </p>

                            <h1 class="mt-3 text-4xl font-extrabold tracking-tight leading-tight">
                                CREATE ACCOUNT
                            </h1>

                            <p class="mt-5 text-sm leading-relaxed text-white/80 max-w-md">
                                Create an account to manage your projects, access tools, and unlock your dashboard.
                            </p>
                        </div>

                        <div class="mt-10 flex items-center gap-3 text-white/80 text-xs">
                            <span class="inline-flex h-2 w-2 rounded-full bg-white/70"></span>
                            <span>Secure signup • Fast • Modern UI</span>
                        </div>
                    </div>
                </div>

                {{-- =======================
                    RIGHT: Form
                    ======================= --}}
                <div class="relative p-7 sm:p-10">
                    <div
                        class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-[#15a5ed]/30 to-transparent">
                    </div>

                    <div class="max-w-sm mx-auto">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">
                                Create your account
                            </h2>
                            <p class="mt-2 text-sm text-gray-500">
                                Fill in your details to get started.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="space-y-5">
                            @csrf

                            {{-- Name --}}
                            <div>
                                <label for="name"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                                    Full Name
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-r bg-[#15a5ed]/70"></span>
                                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                        placeholder="John Doe"
                                        class="w-full pl-5 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/40
                                            focus:bg-white focus:border-[#15a5ed] focus:ring-4 focus:ring-[#15a5ed]/20
                                            transition-all duration-200 outline-none text-gray-900 placeholder:text-gray-400" />
                                </div>
                                @error('name')
                                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                                    Email ID
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-r bg-[#15a5ed]/70"></span>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                        placeholder="name@company.com"
                                        class="w-full pl-5 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/40
                                            focus:bg-white focus:border-[#15a5ed] focus:ring-4 focus:ring-[#15a5ed]/20
                                            transition-all duration-200 outline-none text-gray-900 placeholder:text-gray-400" />
                                </div>
                                @error('email')
                                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div>
                                <label for="password"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                                    Password
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-r bg-[#15a5ed]/70"></span>
                                    <input id="password" type="password" name="password" required autocomplete="new-password"
                                        placeholder="••••••••"
                                        class="w-full pl-5 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/40
                                            focus:bg-white focus:border-[#15a5ed] focus:ring-4 focus:ring-[#15a5ed]/20
                                            transition-all duration-200 outline-none text-gray-900 placeholder:text-gray-400" />
                                </div>
                                @error('password')
                                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div>
                                <label for="password_confirmation"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                                    Confirm Password
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-r bg-[#15a5ed]/70"></span>
                                    <input id="password_confirmation" type="password" name="password_confirmation" required
                                        placeholder="••••••••"
                                        class="w-full pl-5 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/40
                                            focus:bg-white focus:border-[#15a5ed] focus:ring-4 focus:ring-[#15a5ed]/20
                                            transition-all duration-200 outline-none text-gray-900 placeholder:text-gray-400" />
                                </div>
                            </div>

                            {{-- Submit --}}
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center px-6 py-3.5 rounded-xl
                                    bg-gradient-to-r from-[#15a5ed] to-[#6dbae1]
                                    text-white shadow-lg shadow-[#15a5ed]/25
                                    hover:shadow-[#15a5ed]/40 hover:-translate-y-0.5 active:translate-y-0
                                    transition-all duration-200 text-base font-extrabold tracking-wide">
                                CREATE ACCOUNT
                            </button>

                            {{-- Back --}}
                            <a href="{{ route('home') }}"
                                class="w-full inline-flex items-center justify-center px-5 py-3 rounded-xl
                                    border border-gray-200 text-gray-700 hover:bg-gray-50 hover:border-gray-300
                                    transition-all duration-200 text-sm font-semibold">
                                ← Back to Shop
                            </a>

                            {{-- Login --}}
                            <p class="text-center text-sm text-gray-600 pt-2">
                                Already have an account?
                                <a href="{{ route('login') }}"
                                    class="text-[#15a5ed] font-extrabold hover:text-[#118bc8] transition-colors">
                                    Sign in instead
                                </a>
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
