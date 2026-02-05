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
                    {{-- ✅ 你可以换成图片：把 url(...) 改成你的图片路径 --}}
                    <div class="absolute inset-0 bg-[linear-gradient(135deg,#0ea5e9_0%,#2563eb_45%,#0b3a7a_100%)]">
                    </div>

                    {{-- 网格/线路装饰（不用图片也能做出科技感） --}}
                    <div class="absolute inset-0 opacity-30"
                        style="background-image:
                            linear-gradient(to right, rgba(255,255,255,0.15) 1px, transparent 1px),
                            linear-gradient(to bottom, rgba(255,255,255,0.15) 1px, transparent 1px);
                            background-size: 42px 42px;">
                    </div>

                    {{-- 轻微波浪/光斑 --}}
                    <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-white/15 blur-3xl"></div>
                    <div class="absolute -bottom-24 -right-24 w-80 h-80 rounded-full bg-cyan-300/20 blur-3xl"></div>

                    <div class="relative h-full p-10 flex flex-col justify-center text-white">
                        <div class="mb-4">
                            <img src="{{ asset('images/logo/extechstudio-white-logo.png') }}" alt="Extech Studio"
                                class="h-15 w-auto opacity-90">
                        </div>


                        <div class="mt-3">
                            <p class="text-sm font-semibold text-white/90">
                                Nice to see you again
                            </p>

                            <h1 class="mt-3 text-4xl font-extrabold tracking-tight leading-tight">
                                WELCOME BACK
                            </h1>

                            <p class="mt-5 text-sm leading-relaxed text-white/80 max-w-md">
                                Sign in to manage your projects, view analytics, and access your dashboard.
                            </p>
                        </div>

                        <div class="mt-10 flex items-center gap-3 text-white/80 text-xs">
                            <span class="inline-flex h-2 w-2 rounded-full bg-white/70"></span>
                            <span>Secure access • Fast • Modern UI</span>
                        </div>
                    </div>
                </div>

                {{-- =======================
                    RIGHT: Form
                    ======================= --}}
                <div class="relative p-7 sm:p-10">
                    {{-- 顶部细线装饰 --}}
                    <div
                        class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-[#15a5ed]/30 to-transparent">
                    </div>

                    <div class="max-w-sm mx-auto">
                        <div class="text-center mb-8">
                            {{-- <p class="text-sm font-semibold tracking-[0.25em] text-[#15a5ed] uppercase mb-2">
                                Login Account
                            </p> --}}
                            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">
                                Sign in to continue
                            </h2>
                            <p class="mt-2 text-sm text-gray-500">
                                Enter your email and password to access your account.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="space-y-5">
                            @csrf

                            {{-- Email --}}
                            <div>
                                <label for="email"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                                    Email ID
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-r bg-[#15a5ed]/70"></span>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        required autofocus placeholder="name@company.com"
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
                                    <input id="password" type="password" name="password" required
                                        autocomplete="current-password" placeholder="••••••••"
                                        class="w-full pl-5 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/40
                                            focus:bg-white focus:border-[#15a5ed] focus:ring-4 focus:ring-[#15a5ed]/20
                                            transition-all duration-200 outline-none text-gray-900 placeholder:text-gray-400" />
                                </div>
                                @error('password')
                                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Remember + Link --}}
                            <div class="flex items-center justify-between pt-1">
                                <label class="inline-flex items-center gap-2 text-sm text-gray-600">
                                    <input id="remember_me" type="checkbox" name="remember"
                                        class="rounded border-gray-300 text-[#15a5ed] focus:ring-[#15a5ed]/30">
                                    Keep me signed in
                                </label>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-sm font-semibold text-[#15a5ed] hover:text-[#118bc8] transition-colors">
                                        Forgot?
                                    </a>
                                @endif
                            </div>

                            {{-- Submit --}}
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center px-6 py-3.5 rounded-xl
                                    bg-gradient-to-r from-[#15a5ed] to-[#6dbae1]
                                    text-white shadow-lg shadow-[#15a5ed]/25
                                    hover:shadow-[#15a5ed]/40 hover:-translate-y-0.5 active:translate-y-0
                                    transition-all duration-200 text-base font-extrabold tracking-wide">
                                SIGN IN
                            </button>

                            {{-- Back --}}
                            <a href="{{ route('home') }}"
                                class="w-full inline-flex items-center justify-center px-5 py-3 rounded-xl
                                    border border-gray-200 text-gray-700 hover:bg-gray-50 hover:border-gray-300
                                    transition-all duration-200 text-sm font-semibold">
                                ← Back to Shop
                            </a>

                            {{-- Register --}}
                            @if (Route::has('register'))
                                <p class="text-center text-sm text-gray-600 pt-2">
                                    New here?
                                    <a href="{{ route('register') }}"
                                        class="text-[#15a5ed] font-extrabold hover:text-[#118bc8] transition-colors">
                                        Create an account
                                    </a>
                                </p>
                            @endif
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
