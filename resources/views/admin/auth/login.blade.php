<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login | Secure Access</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-[#faf9f6] text-gray-900">
    <div class="w-full max-w-5xl px-4 py-10">

        {{-- Error Banner --}}
        @if ($errors->any())
            <div class="mb-6 px-4 py-3 rounded-xl bg-red-50 text-red-700 border border-red-200 text-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ $errors->first() }}
                </div>
            </div>
        @endif

        <div
            class="w-full overflow-hidden rounded-[2rem] bg-white border border-black/10 shadow-[0_30px_90px_-45px_rgba(0,0,0,0.35)]">
            <div class="grid grid-cols-1 lg:grid-cols-2">

                {{-- =======================
                    LEFT: Visual / Welcome (BLUE like user login)
                    ======================= --}}
                <div class="relative hidden lg:block">
                    {{-- Blue gradient background --}}
                    <div class="absolute inset-0 bg-[linear-gradient(135deg,#0ea5e9_0%,#2563eb_45%,#0b3a7a_100%)]">
                    </div>

                    {{-- Grid overlay --}}
                    <div class="absolute inset-0 opacity-30"
                        style="background-image:
                            linear-gradient(to right, rgba(255,255,255,0.15) 1px, transparent 1px),
                            linear-gradient(to bottom, rgba(255,255,255,0.15) 1px, transparent 1px);
                            background-size: 42px 42px;">
                    </div>

                    {{-- Glow --}}
                    <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-white/15 blur-3xl"></div>
                    <div class="absolute -bottom-24 -right-24 w-80 h-80 rounded-full bg-cyan-300/20 blur-3xl"></div>

                    <div class="relative h-full p-10 flex flex-col justify-center text-white">
                        {{-- Logo --}}
                        <div class="mb-4">
                            <img src="{{ asset('images/logo/extechstudio-white-logo.png') }}" alt="Extech Studio"
                                class="h-14 w-auto opacity-90">
                        </div>

                        <div class="mt-3">
                            <p class="text-sm font-semibold text-white/90">
                                Restricted access area
                            </p>

                            <h1 class="mt-3 text-4xl font-extrabold tracking-tight leading-tight">
                                ADMIN PORTAL
                            </h1>

                            <p class="mt-5 text-sm leading-relaxed text-white/80 max-w-md">
                                Secure authentication for administrators to manage system operations and internal tools.
                            </p>
                        </div>

                        <div class="mt-10 flex items-center gap-3 text-white/80 text-xs">
                            <span class="inline-flex h-2 w-2 rounded-full bg-white/70"></span>
                            <span>Secure access • Audit ready • Admin only</span>
                        </div>
                    </div>
                </div>

                {{-- =======================
                    RIGHT: Form (same style as user login)
                    ======================= --}}
                <div class="relative p-7 sm:p-10">
                    {{-- Top line --}}
                    <div
                        class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-[#15a5ed]/30 to-transparent">
                    </div>

                    <div class="max-w-sm mx-auto">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">
                                Sign in to admin
                            </h2>
                            <p class="mt-2 text-sm text-gray-500">
                                Enter your admin credentials to continue.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
                            @csrf

                            {{-- Email --}}
                            <div>
                                <label for="email"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                                    Admin Email
                                </label>

                                <div class="relative">
                                    <span
                                        class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-10 rounded-r bg-[#15a5ed]/70"></span>

                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        required autofocus placeholder="admin@internal.com"
                                        class="w-full pl-5 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50/40
                                            focus:bg-white focus:border-[#15a5ed] focus:ring-4 focus:ring-[#15a5ed]/20
                                            transition-all duration-200 outline-none text-gray-900 placeholder:text-gray-400" />
                                </div>
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
                            </div>

                            {{-- Remember + Exit --}}
                            <div class="flex items-center justify-between pt-1">
                                <label class="inline-flex items-center gap-2 text-sm text-gray-600">
                                    <input id="remember_me" type="checkbox" name="remember"
                                        class="rounded border-gray-300 text-[#15a5ed] focus:ring-[#15a5ed]/30">
                                    Keep me signed in
                                </label>
                            </div>

                            {{-- Submit --}}
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center px-6 py-3.5 rounded-xl
                                    bg-gradient-to-r from-[#15a5ed] to-[#6dbae1]
                                    text-white shadow-lg shadow-[#15a5ed]/25
                                    hover:shadow-[#15a5ed]/40 hover:-translate-y-0.5 active:translate-y-0
                                    transition-all duration-200 text-base font-extrabold tracking-wide">
                                AUTHORIZE ACCESS
                            </button>

                            {{-- Back to Shop --}}
                            <a href="{{ route('home') }}"
                                class="w-full inline-flex items-center justify-center px-5 py-3 rounded-xl
                                    border border-gray-200 text-gray-700 hover:bg-gray-50 hover:border-gray-300
                                    transition-all duration-200 text-sm font-semibold">
                                ← Back to Shop
                            </a>
                        </form>

                        {{-- Footer --}}
                        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400">
                                Admin System • Secure Layer Active
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
