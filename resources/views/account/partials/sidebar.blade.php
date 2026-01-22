@php
    $user = $user ?? auth()->user();

    // Base class: Modular & Precise
    $itemBase =
        'group flex items-center gap-3 px-5 py-3 text-sm font-bold rounded-xl mx-3 mt-1.5 transition-all duration-300 relative overflow-hidden';

    // ✅ Tech blue active: Glass + Ring + Glow
    $activeClass = 'bg-[#15A5ED]/5 text-[#0B3A67] ring-1 ring-[#15A5ED]/30 shadow-[0_4px_12px_rgba(21,165,237,0.08)]';

    // ✅ Tech blue hover: Clean & Subtle
    $inactiveClass = 'text-slate-500 hover:bg-slate-50 hover:text-[#15A5ED]';
@endphp

<div
    class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] border border-slate-100 shadow-[0_20px_50px_rgba(0,0,0,0.04)] flex flex-col sticky top-28 overflow-hidden">

    {{-- Header: Secure Profile Interface --}}
    <div class="relative px-6 py-8 border-b border-slate-50 overflow-hidden">
        {{-- Technical Background Accents --}}
        <div class="absolute inset-0 opacity-[0.05]"
            style="background-image: radial-gradient(#15A5ED 0.5px, transparent 0.5px); background-size: 10px 10px;">
        </div>
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#15A5ED] via-[#15A5ED]/20 to-transparent">
        </div>

        <div class="relative flex items-center gap-4">
            {{-- Avatar Module --}}
            <div class="relative">
                <div
                    class="absolute -inset-1 rounded-2xl bg-gradient-to-tr from-[#15A5ED] to-cyan-400 opacity-20 blur-md">
                </div>
                <div
                    class="relative h-14 w-14 rounded-2xl bg-slate-900 flex items-center justify-center text-xl font-mono font-bold text-white shadow-xl ring-1 ring-white/20">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                    {{-- Corner Tech Detail --}}
                    <div class="absolute top-1 right-1 w-1.5 h-1.5 border-t border-r border-white/40"></div>
                </div>
                {{-- Dynamic Status LED --}}
                <div
                    class="absolute -bottom-1 -right-1 h-4 w-4 bg-emerald-500 border-[3px] border-white rounded-full shadow-sm">
                </div>
            </div>

            <div class="flex flex-col">
                <div class="flex items-center gap-2 mb-0.5">
                    <span
                        class="text-[9px] font-mono font-black text-[#15A5ED] uppercase tracking-[0.2em] px-1.5 py-0.5 bg-[#15A5ED]/10 rounded">
                        Authorized
                    </span>
                </div>
                <h3 class="text-base font-bold text-slate-900 truncate max-w-[130px] tracking-tight">
                    {{ $user->name }}
                </h3>
            </div>
        </div>
    </div>

    {{-- Navigation: Logic Modules --}}
    <nav class="flex-1 py-6">

        <a href="{{ route('account.index') }}"
            class="{{ $itemBase }} {{ request()->routeIs('account.index') ? $activeClass : $inactiveClass }}">
            @if (request()->routeIs('account.index'))
                <div class="absolute left-0 w-1 h-4 bg-[#15A5ED] rounded-r-full"></div>
            @endif
            <svg class="h-5 w-5 shrink-0 opacity-80 group-hover:scale-110 transition-transform"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>

            <span class="uppercase tracking-wider text-[11px]">Overview</span>
        </a>

        <a href="{{ route('account.orders.index') }}"
            class="{{ $itemBase }} {{ request()->routeIs('account.orders.*') ? $activeClass : $inactiveClass }}">
            @if (request()->routeIs('account.orders.*'))
                <div class="absolute left-0 w-1 h-4 bg-[#15A5ED] rounded-r-full"></div>
            @endif
            <svg class="h-5 w-5 shrink-0 opacity-80 group-hover:scale-110 transition-transform" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
            </svg>
            <span class="uppercase tracking-wider text-[11px]">My Orders</span>
        </a>

        <a href="{{ route('account.favorites.index') }}"
            class="{{ $itemBase }} {{ request()->routeIs('account.favorites.*') ? $activeClass : $inactiveClass }}">
            @if (request()->routeIs('account.favorites.*'))
                <div class="absolute left-0 w-1 h-4 bg-[#15A5ED] rounded-r-full"></div>
            @endif
            <svg class="h-5 w-5 shrink-0 opacity-80 group-hover:scale-110 transition-transform" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
            <span class="uppercase tracking-wider text-[11px]">My Wishlist</span>
        </a>

        <a href="{{ route('account.address.index') }}"
            class="{{ $itemBase }} {{ request()->routeIs('account.address.*') ? $activeClass : $inactiveClass }}">
            @if (request()->routeIs('account.address.*'))
                <div class="absolute left-0 w-1 h-4 bg-[#15A5ED] rounded-r-full"></div>
            @endif
            <svg class="h-5 w-5 shrink-0 opacity-80 group-hover:scale-110 transition-transform" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
            </svg>
            <span class="uppercase tracking-wider text-[11px]">Shipping Addresses</span>
        </a>

        <a href="{{ route('account.profile.edit') }}"
            class="{{ $itemBase }} {{ request()->routeIs('account.profile.*') ? $activeClass : $inactiveClass }}">
            @if (request()->routeIs('account.profile.*'))
                <div class="absolute left-0 w-1 h-4 bg-[#15A5ED] rounded-r-full"></div>
            @endif
            <svg class="h-5 w-5 shrink-0 opacity-80 group-hover:scale-110 transition-transform" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="uppercase tracking-wider text-[11px]">Profile Settings</span>
        </a>


        <div class="px-8 mt-6 mb-2">
            <div class="h-[1px] bg-slate-50 w-full relative">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-slate-200 to-transparent"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="mx-3 mt-2">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-5 py-3 text-[11px] font-bold uppercase tracking-widest rounded-xl text-slate-400 hover:text-red-500 hover:bg-red-50 transition-all duration-300">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1012.728 0M12 3v9" />
                </svg>
                <span>Sign_Out</span>
            </button>
        </form>

    </nav>

    {{-- Bottom Decorative Bar --}}
    <div class="bg-slate-50/50 px-6 py-3 border-t border-slate-50">
        <div class="flex items-center justify-between text-[11px] font-mono text-slate-300 uppercase tracking-widest">
            <span>System_v.4.1</span>
            <span class="flex items-center gap-1">
                <span class="w-1 h-1 bg-emerald-400 rounded-full animate-pulse"></span>
                Encrypted
            </span>
        </div>
    </div>
</div>
