{{-- ✅ FUTURISTIC MINIMALIST OVERLAY --}}
<nav x-data="{ mobileSearchOpen: false }" class="sticky top-0 z-[100] bg-black border-b border-white/10 px-4 py-3">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between h-16 sm:h-20">

            {{-- LOGO --}}
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo/extechstudio-white-logo.png') }}"
                        class="h-10 sm:h-10 hover:brightness-125 transition" />
                </a>

                {{-- DESKTOP NAV --}}
                <div class="hidden lg:flex items-center gap-1">
                    @php
                        $link = 'relative px-4 py-2 text-xs font-black uppercase tracking-[0.15em] transition';
                    @endphp

                    <a href="{{ route('home') }}"
                        class="{{ $link }} {{ request()->routeIs('home') ? 'text-white' : 'text-gray-300 hover:text-white' }}">
                        Home
                        @if (request()->routeIs('home'))
                            <span
                                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1 h-1 bg-[#15A5ED] rounded-full shadow-[0_0_8px_#15A5ED]"></span>
                        @endif
                    </a>

                    <a href="{{ route('shop.index') }}"
                        class="{{ $link }} {{ request()->routeIs('shop.*') ? 'text-white' : 'text-gray-300 hover:text-white' }}">
                        Shop
                        @if (request()->routeIs('shop.*'))
                            <span
                                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1 h-1 bg-[#15A5ED] rounded-full shadow-[0_0_8px_#15A5ED]"></span>
                        @endif
                    </a>

                    {{-- MORE --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open=!open" @click.outside="open=false"
                            class="{{ $link }} flex items-center gap-1 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg">
                            More
                            <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div x-cloak x-show="open"
                            class="absolute left-0 mt-4 w-52 bg-[#0a0a0a] border border-white/10 rounded-2xl shadow-[0_20px_40px_rgba(0,0,0,0.7)] p-2">

                            <a href="{{ route('how-to-order') }}"
                                class="block px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:bg-[#15A5ED] hover:text-white rounded-lg">
                                How to Order
                            </a>

                            <a href="{{ route('faq') }}"
                                class="block px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:bg-[#15A5ED] hover:text-white rounded-lg">
                                FAQ
                            </a>

                            <a href="{{ route('agents.index') }}"
                                class="block px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:bg-[#15A5ED] hover:text-white rounded-lg">
                                Verify Agent
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEARCH --}}
            <div class="hidden md:flex flex-1 justify-center max-w-md mx-4">
                <form method="GET" action="{{ route('shop.index') }}" class="w-full relative group">
                    <input type="text" name="q" value="{{ request('q') }}"
                        class="w-full bg-white/[0.06] border border-white/10 text-sm tracking-wider py-2.5 px-5 rounded-lg
                               text-white placeholder:text-gray-500
                               focus:ring-1 focus:ring-[#15A5ED] focus:bg-white/[0.08] transition"
                        placeholder="SEARCH PRODUCTS...">

                    <button type="submit"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#15A5ED]">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="m21 21-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" />
                        </svg>
                    </button>
                </form>
            </div>

            {{-- ACTIONS --}}
            <div class="flex items-center gap-2 sm:gap-3">

                {{-- MOBILE SEARCH ICON --}}
                <button type="button" @click="mobileSearchOpen = true"
                    class="md:hidden p-2 text-gray-300 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" />
                    </svg>
                </button>

                {{-- CART --}}
                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-300 hover:text-white transition">

                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                    @php $count = auth()->user()?->cart?->items?->count() ?? 0; @endphp

                    @if ($count > 0)
                        <span class="absolute -top-1 -right-1 flex h-5 w-5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#15A5ED] opacity-60"></span>
                            <span
                                class="relative inline-flex items-center justify-center
                                         h-5 min-w-[20px] px-1 rounded-full
                                         bg-[#15A5ED] text-white text-[10px] font-bold
                                         shadow-[0_0_10px_#15A5ED]">
                                {{ $count > 99 ? '99+' : $count }}
                            </span>
                        </span>
                    @endif
                </a>

                {{-- USER / LOGIN --}}
                @auth
                    <div x-data="{ open: false }" class="relative hidden sm:block">
                        <button @click="open = !open"
                            class="ml-2 h-10 w-10 border border-white/10 flex items-center justify-center hover:border-[#15A5ED] transition-colors">
                            <span class="text-[10px] font-black text-white uppercase">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                        </button>

                        <div x-cloak x-show="open" @click.outside="open = false" x-transition
                            class="absolute right-0 mt-4 w-60 bg-[#0a0a0a] border border-white/10 rounded-2xl p-4 shadow-2xl">
                            <div class="mb-4 pb-2 border-b border-white/10">
                                <p class="text-[10px] text-gray-500 uppercase tracking-tighter">Authorized User</p>
                                <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                            </div>

                            <div class="space-y-1">
                                <a href="{{ route('account.index') }}"
                                    class="block py-2 text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-[#15A5ED]">
                                    Dashboard
                                </a>
                                <a href="{{ route('account.orders.index') }}"
                                    class="block py-2 text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-[#15A5ED]">
                                    Orders
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left py-2 text-[10px] font-bold uppercase tracking-widest text-red-500">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="ml-2 hidden sm:inline-flex px-6 py-2 border border-white text-[10px] font-black uppercase tracking-[0.2em] hover:bg-white hover:text-black transition-all">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </div>

    {{-- MOBILE SEARCH PANEL --}}
    <div x-cloak x-show="mobileSearchOpen" x-transition.opacity
        class="md:hidden fixed inset-0 z-[120] bg-black/95 px-4 py-4">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center gap-3">
                <form method="GET" action="{{ route('shop.index') }}" class="flex-1 relative">
                    <input type="text" name="q" value="{{ request('q') }}" autofocus
                        class="w-full bg-white/[0.06] border border-white/10 text-sm tracking-wider py-3 pl-4 pr-12 rounded-xl
                               text-white placeholder:text-gray-500
                               focus:ring-1 focus:ring-[#15A5ED] focus:bg-white/[0.08] transition"
                        placeholder="SEARCH PRODUCTS...">

                    <button type="submit"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#15A5ED]">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="m21 21-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" />
                        </svg>
                    </button>
                </form>

                <button type="button" @click="mobileSearchOpen = false"
                    class="shrink-0 h-11 w-11 flex items-center justify-center rounded-xl border border-white/10 text-gray-300 hover:text-white hover:border-white/20 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

{{-- ✅ MOBILE BOTTOM TABS (MUST be OUTSIDE nav) --}}
<div class="sm:hidden" x-data="{ openMoreSheet: false, openProfileSheet: false }">

    <div
        class="fixed bottom-0 inset-x-0 z-[60] border-t border-white/5 bg-slate-950/90 backdrop-blur-xl shadow-[0_-10px_40px_rgba(0,0,0,0.4)] pb-safe">
        <div class="max-w-md mx-auto px-2">
            <div class="grid grid-cols-4 gap-1 py-3">
                @php
                    // Base class: Clean & Geometric
                    $tabBase =
                        'relative flex flex-col items-center justify-center gap-1.5 py-1 rounded-xl transition-all duration-300 group';

                    // Active: Tech Blue Glow & Text
                    $tabActive = 'text-[#15A5ED]';

                    // Inactive: Dimmed Slate
                    $tabInactive = 'text-slate-500 hover:text-slate-300';

                    $isMoreActive = request()->routeIs('how-to-order') || request()->routeIs('faq');
                    $isProfileActive = request()->routeIs('account.*');
                @endphp

                {{-- Home Tab --}}
                <a href="{{ route('home') }}"
                    class="{{ $tabBase }} {{ request()->routeIs('home') ? $tabActive : $tabInactive }}">
                    @if (request()->routeIs('home'))
                        <div
                            class="absolute -top-3 left-1/2 -translate-x-1/2 w-8 h-1 bg-[#15A5ED] rounded-b-full shadow-[0_0_15px_rgba(21,165,237,0.8)]">
                        </div>
                    @endif
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-active:scale-90 transition-transform"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75V19.5A2.25 2.25 0 006.75 21.75h3.75v-6a2.25 2.25 0 012.25-2.25h.5A2.25 2.25 0 0115.5 15.75v6h3.75A2.25 2.25 0 0021.75 19.5V9.75" />
                    </svg>
                    <span class="text-[9px] font-mono font-bold uppercase tracking-[0.1em]">Home</span>
                </a>

                {{-- Shop Tab --}}
                <a href="{{ route('shop.index') }}"
                    class="{{ $tabBase }} {{ request()->routeIs('shop.*') ? $tabActive : $tabInactive }}">
                    @if (request()->routeIs('shop.*'))
                        <div
                            class="absolute -top-3 left-1/2 -translate-x-1/2 w-8 h-1 bg-[#15A5ED] rounded-b-full shadow-[0_0_15px_rgba(21,165,237,0.8)]">
                        </div>
                    @endif

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                    <span class="text-[9px] font-mono font-bold uppercase tracking-[0.1em]">Shop</span>
                </a>

                {{-- More Tab --}}
                <button type="button" @click="openMoreSheet = true"
                    class="{{ $tabBase }} {{ $isMoreActive ? $tabActive : $tabInactive }}">
                    @if ($isMoreActive)
                        <div
                            class="absolute -top-3 left-1/2 -translate-x-1/2 w-8 h-1 bg-[#15A5ED] rounded-b-full shadow-[0_0_15px_rgba(21,165,237,0.8)]">
                        </div>
                    @endif
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-active:scale-90 transition-transform"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <span class="text-[9px] font-mono font-bold uppercase tracking-[0.1em]">More</span>
                </button>

                {{-- Profile Tab --}}
                <button type="button" @click="openProfileSheet = true"
                    class="{{ $tabBase }} {{ $isProfileActive ? $tabActive : $tabInactive }}">
                    @if ($isProfileActive)
                        <div
                            class="absolute -top-3 left-1/2 -translate-x-1/2 w-8 h-1 bg-[#15A5ED] rounded-b-full shadow-[0_0_15px_rgba(21,165,237,0.8)]">
                        </div>
                    @endif
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 group-active:scale-90 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{-- Small online indicator dot --}}
                        <span
                            class="absolute -top-0.5 -right-0.5 w-2 h-2 bg-emerald-500 rounded-full border-2 border-slate-950"></span>
                    </div>
                    <span class="text-[9px] font-mono font-bold uppercase tracking-[0.1em]">Account</span>
                </button>
            </div>
        </div>
    </div>

    {{-- More Sheet --}}
    <div x-cloak x-show="openMoreSheet" class="fixed inset-0 z-[70] flex items-end justify-center"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        {{-- Backdrop with blur --}}
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" @click="openMoreSheet = false"></div>

        {{-- Sheet Content --}}
        <div class="relative w-full max-w-lg p-4 mb-4" x-show="openMoreSheet"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-full">

            <div
                class="rounded-[2.5rem] border border-white/10 bg-slate-900 shadow-[0_-20px_50px_rgba(0,0,0,0.5)] overflow-hidden relative">

                {{-- Decorative Tech Accent --}}
                <div
                    class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[#15A5ED]/40 to-transparent">
                </div>

                {{-- Header: Module Title --}}
                <div class="px-6 pt-6 pb-4 flex items-center justify-between border-b border-white/5">
                    <div>
                        <div class="flex items-center gap-2 mb-0.5">
                            <span class="w-1 h-1 bg-[#15A5ED] rounded-full animate-pulse"></span>
                            <p class="text-[10px] font-mono font-black text-[#15A5ED] uppercase tracking-[0.2em]">
                                System_Resources</p>
                        </div>
                        <p class="text-lg font-bold text-white tracking-tight">More</p>
                    </div>

                    <button @click="openMoreSheet = false"
                        class="h-10 w-10 rounded-2xl bg-white/5 text-slate-400 hover:text-white hover:bg-white/10 transition-all grid place-items-center border border-white/5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Navigation Grid --}}
                <div class="p-4 space-y-1.5">
                    @php
                        $links = [
                            ['route' => 'how-to-order', 'label' => 'How to Order', 'sub' => 'Step-by-step guidance'],
                            ['route' => 'faq', 'label' => 'FAQ', 'sub' => 'System documentation'],
                            ['route' => 'home', 'label' => 'Chat', 'sub' => 'Live human assistance'],
                            ['route' => 'agents.index', 'label' => 'Verify Agents', 'sub' => 'Check Agent'],
                        ];
                    @endphp

                    @foreach ($links as $link)
                        <a href="{{ $link['route'] != 'home' ? route($link['route']) : '#' }}"
                            @click="openMoreSheet = false"
                            class="group flex items-center justify-between px-5 py-4 rounded-[1.5rem] bg-white/[0.02] border border-white/5 hover:bg-[#15A5ED]/10 hover:border-[#15A5ED]/30 transition-all duration-300">
                            <div class="flex flex-col">
                                <span
                                    class="text-xs font-mono font-bold text-white group-hover:text-[#15A5ED] transition-colors uppercase tracking-widest">
                                    {{ $link['label'] }}
                                </span>
                                <span class="text-[10px] text-slate-500 mt-0.5 font-medium">
                                    {{ $link['sub'] }}
                                </span>
                            </div>
                            <div
                                class="h-8 w-8 rounded-lg bg-white/5 flex items-center justify-center text-slate-500 group-hover:bg-[#15A5ED] group-hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Footer Stat --}}
                <div
                    class="px-8 py-4 bg-black/40 flex justify-between items-center text-[8px] font-mono text-slate-500 uppercase tracking-[0.3em]">
                    <span>Status: Secure</span>
                    <span>ID: {{ rand(1000, 9999) }}-X</span>
                </div>
            </div>
        </div>
    </div>
    {{-- Profile Sheet --}}
    <div x-cloak x-show="openProfileSheet" class="fixed inset-0 z-[70] flex items-end justify-center"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" @click="openProfileSheet = false"></div>

        {{-- Sheet Content --}}
        <div class="relative w-full max-w-lg p-4 mb-4" x-show="openProfileSheet"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-full">

            <div
                class="rounded-[2.5rem] border border-white/10 bg-slate-900 shadow-[0_-20px_50px_rgba(0,0,0,0.5)] overflow-hidden relative">

                {{-- Tech Accent Header --}}
                <div class="px-6 pt-6 pb-5 flex items-center justify-between border-b border-white/5 bg-white/[0.01]">
                    <div>
                        <div class="flex items-center gap-2 mb-0.5">
                            <span
                                class="w-2 h-2 bg-emerald-500 rounded-full shadow-[0_0_8px_rgba(16,185,129,0.6)]"></span>
                            <p class="text-[10px] font-mono font-black text-slate-400 uppercase tracking-[0.2em]">
                                Auth_Status: Verified</p>
                        </div>
                        <p class="text-lg font-bold text-white tracking-tight">
                            @auth {{ explode(' ', auth()->user()->name)[0] }}'s Account
                            @else
                            Identity Access @endauth
                        </p>
                    </div>

                    <button @click="openProfileSheet = false"
                        class="h-10 w-10 rounded-2xl bg-white/5 text-slate-400 hover:text-white border border-white/5 transition-all grid place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="p-3">
                    @auth
                        {{-- Navigation Commands --}}
                        <div class="grid grid-cols-1 gap-1">
                            @php
                                $navItems = [
                                    [
                                        'route' => 'account.index',
                                        'label' => 'DASHBOARD',
                                        'icon' => 'M4 6h16M4 12h16M4 18h7',
                                    ],
                                    [
                                        'route' => 'account.orders.index',
                                        'label' => 'MY ORDERS',
                                        'icon' =>
                                            'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                                    ],
                                    [
                                        'route' => 'account.favorites.index',
                                        'label' => 'MY WISHLIST',
                                        'icon' =>
                                            'M4.318 6.318a5.5 5.5 0 017.778 0L12 6.586l-.096-.097a5.5 5.5 0 117.778 7.778L12 21.192l-7.682-7.682a5.5 5.5 0 010-7.192z',
                                    ],
                                    [
                                        'route' => 'account.referral.index',
                                        'label' => 'REFERRAL CENTER',
                                        'icon' =>
                                            'M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z',
                                    ],
                                    [
                                        'route' => 'account.profile.edit',
                                        'label' => 'PROFILE SETTINGS',
                                        'icon' =>
                                            'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z',
                                    ],
                                    [
                                        'route' => 'account.address.index',
                                        'label' => 'SHIPPING ADDRESSES',
                                        'icon' =>
                                            'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z',
                                    ],
                                ];
                            @endphp

                            @foreach ($navItems as $item)
                                <a href="{{ route($item['route']) }}" @click="openProfileSheet = false"
                                    class="group flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-white/[0.03] transition-all">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-slate-400 group-hover:text-[#15A5ED] group-hover:bg-[#15A5ED]/10 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="{{ $item['icon'] }}" />
                                        </svg>
                                    </div>
                                    <span
                                        class="text-xs font-mono font-bold text-slate-300 group-hover:text-white tracking-widest">{{ $item['label'] }}</span>
                                    <span class="ml-auto text-slate-600 group-hover:text-[#15A5ED] transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </a>
                            @endforeach

                            <div class="my-2 border-t border-white/5"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full group flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-rose-500/5 transition-all">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-rose-500/10 flex items-center justify-center text-rose-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                    </div>
                                    <span
                                        class="text-xs font-mono font-bold text-rose-400 uppercase tracking-widest">Sign_Out</span>
                                </button>
                            </form>
                        </div>
                    @else
                        {{-- Guest Actions --}}
                        <div class="p-3 space-y-3">
                            <a href="{{ route('login') }}" @click="openProfileSheet = false"
                                class="w-full flex items-center justify-center gap-3 px-6 py-4 rounded-2xl bg-[#15A5ED] text-white text-[11px] font-mono font-black uppercase tracking-[0.2em] hover:shadow-[0_0_20px_rgba(21,165,237,0.4)] transition-all">
                                <span>Login</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    stroke-width="3">
                                    <path d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                            <a href="{{ route('register') }}" @click="openProfileSheet = false"
                                class="w-full flex items-center justify-center px-6 py-4 rounded-2xl border border-white/10 text-[11px] font-mono font-black text-slate-300 uppercase tracking-[0.2em] hover:bg-white/5 transition-all">
                                Register
                            </a>
                        </div>
                    @endauth
                </div>

                {{-- Security Footer --}}
                <div class="px-8 py-3 bg-black/40 border-t border-white/5 flex justify-center">
                    <div
                        class="flex items-center gap-4 text-[7px] font-mono text-slate-600 uppercase tracking-[0.4em]">
                        <span>Encrypted</span>
                        <span class="w-1 h-1 bg-slate-800 rounded-full"></span>
                        <span>No_Third_Party_Access</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- ✅ IMPORTANT: add bottom padding so content won't be covered by bottom tabs --}}
{{-- Put this in your main layout wrapper (recommended) --}}
{{-- <div class="pb-24 sm:pb-0">{{ $slot }}</div> --}}
