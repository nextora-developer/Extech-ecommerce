@extends('admin.layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">Agent Profile</h1>
            <p class="text-sm text-gray-500 mt-1">Detailed overview of agent access and linked user account.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.agents.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-gray-200
                text-sm font-semibold text-gray-600 hover:bg-gray-50 transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span>Back to Agents</span>
            </a>

            {{-- @if ($agent->user)
                <a href="{{ route('admin.users.show', $agent->user) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#D4AF37]/15 border border-[#D4AF37]/30
                    text-[#8f6a10] font-bold hover:bg-[#D4AF37]/20 transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <span>View Linked User</span>
                </a>
            @endif --}}
        </div>
    </div>

    <div class="space-y-6">
        {{-- Overview --}}
        <div class="space-y-6">
            {{-- Agent Profile & Action Header --}}
            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-[0_20px_50px_rgba(0,0,0,0.04)]">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <div class="flex items-center gap-5">
                        <div class="relative">
                            <div
                                class="h-20 w-20 rounded-2xl bg-gradient-to-br from-[#D4AF37] to-[#B8860B] flex items-center justify-center text-white font-black text-2xl shadow-xl shadow-[#D4AF37]/20">
                                {{ substr($agent->user->name ?? 'A', 0, 1) }}
                            </div>
                            @if ($agent->status === 'active')
                                <span class="absolute -bottom-1 -right-1 flex h-6 w-6">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span
                                        class="relative inline-flex rounded-full h-6 w-6 bg-emerald-500 border-4 border-white"></span>
                                </span>
                            @endif
                        </div>

                        <div>
                            <h1 class="text-2xl font-black text-gray-900 tracking-tight">
                                {{ $agent->user->name ?? 'Unknown User' }}</h1>
                            <div class="flex flex-wrap items-center gap-2 mt-1.5">
                                <span
                                    class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-100 text-sky-700 border border-sky-200 uppercase tracking-widest">Agent</span>

                                @if ($agent->status === 'active')
                                    <span
                                        class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 border border-emerald-200 uppercase tracking-widest">Active
                                        Status</span>
                                @else
                                    <span
                                        class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 border border-amber-200 uppercase tracking-widest">Suspended</span>
                                @endif

                                @if ($agent->user?->is_verified)
                                    <span
                                        class="flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-gray-900 text-white uppercase tracking-widest">
                                        <svg class="w-3 h-3 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.64.304 1.24.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Verified
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex flex-wrap items-center gap-3 bg-gray-50/50 p-4 rounded-[1.5rem] border border-gray-200/60 backdrop-blur-sm">

                        {{-- Status Action: Activate/Suspend --}}
                        @if ($agent->status === 'active')
                            <form action="{{ route('admin.agents.suspend', $agent) }}" method="POST"
                                onsubmit="return confirm('Suspend this agent?')">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white border border-amber-200 text-amber-700 font-bold text-sm hover:bg-amber-600 hover:text-white hover:border-amber-600 transition-all shadow-sm group">

                                    <svg class="w-4 h-4 text-amber-500 group-hover:text-white transition-colors"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>

                                    Suspend Agent
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.agents.activate', $agent) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-sm hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200/50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Activate Agent
                                </button>
                            </form>
                        @endif

                        {{-- Utility Action: Adjust Points --}}
                        <button type="button"
                            onclick="document.getElementById('adjustPointsModal').classList.remove('hidden')"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 font-bold text-sm hover:bg-sky-50 hover:text-sky-700 hover:border-sky-200 transition-all shadow-sm">
                            <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Adjust Points
                        </button>

                        {{-- Danger Action: Revoke --}}
                        @if ($agent->user)
                            <div class="h-6 w-[1px] bg-gray-200 mx-1 hidden sm:block"></div> {{-- Visual Divider --}}

                            <form action="{{ route('admin.users.remove-agent', $agent->user) }}" method="POST"
                                onsubmit="return confirm('Remove this user as agent?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-rose-50 text-rose-700 border border-rose-100 font-bold text-sm hover:bg-rose-600 hover:text-white transition-all group">
                                    <svg class="w-4 h-4 text-rose-500 group-hover:text-white transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Revoke Role
                                </button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Stats and Info Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Administrative Details --}}
                <div class="lg:col-span-2 bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 mb-6">Administrative Meta</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-y-8 gap-x-4">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Agent Code</p>
                            <p class="text-gray-900 font-mono font-black bg-gray-50 px-2 py-1 rounded inline-block">
                                {{ $agent->agent_code ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Referral Code</p>
                            <p class="text-gray-900 font-mono font-black border-b-2 border-[#D4AF37]/30 inline-block">
                                {{ $agent->referral_code ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Approved By</p>
                            <p class="text-gray-900 font-bold flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                                {{ $agent->approver->name ?? 'System' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Approved At</p>
                            <p class="text-gray-900 font-semibold">{{ $agent->approved_at?->format('d M Y, H:i') ?? '—' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Registration Date
                            </p>
                            <p class="text-gray-900 font-semibold">{{ $agent->created_at?->format('d M Y') ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Account Linked
                            </p>
                            <p class="text-gray-900 font-semibold">{{ $agent->user->email ?? 'No Email' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Financial Performance --}}
                <div class="bg-gray-900 rounded-3xl p-6 text-white relative overflow-hidden shadow-xl shadow-gray-200">
                    <div class="absolute -right-8 -top-8 h-32 w-32 bg-[#D4AF37]/10 rounded-full blur-2xl"></div>
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 mb-6">Financial Summary</h3>

                    <div class="space-y-6">
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Current Balance</p>
                            <div class="flex items-baseline gap-2">
                                <p class="text-3xl font-black text-sky-400">
                                    {{ number_format($agent->current_points ?? 0, 2) }}</p>
                                <span class="text-xs text-sky-400/60 font-bold uppercase">Points</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Earned
                                    RM</p>
                                <p class="text-xl font-black text-emerald-400">RM
                                    {{ number_format($agent->total_earned_rm ?? 0, 2) }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Linked User --}}
        <div class="bg-white border border-[#D4AF37]/18 rounded-2xl p-6 shadow-[0_18px_40px_rgba(0,0,0,0.06)]">
            <div class="flex items-center justify-between mb-5">
                <h2 class="font-bold text-gray-900">Linked User Account</h2>
            </div>

            @if ($agent->user)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 text-sm">
                    <div class="rounded-xl bg-gray-50/80 border border-gray-100 px-4 py-3">
                        <p class="text-xs uppercase font-bold tracking-widest text-gray-400 mb-1">Name</p>
                        <p class="text-gray-900 font-semibold">{{ $agent->user->name ?? '—' }}</p>
                    </div>

                    <div class="rounded-xl bg-gray-50/80 border border-gray-100 px-4 py-3">
                        <p class="text-xs uppercase font-bold tracking-widest text-gray-400 mb-1">Email</p>
                        <p class="text-gray-900 font-semibold">{{ $agent->user->email ?? '—' }}</p>
                    </div>

                    <div class="rounded-xl bg-gray-50/80 border border-gray-100 px-4 py-3">
                        <p class="text-xs uppercase font-bold tracking-widest text-gray-400 mb-1">Phone</p>
                        <p class="text-gray-900 font-semibold">{{ $agent->user->phone ?? '—' }}</p>
                    </div>

                    <div class="rounded-xl bg-gray-50/80 border border-gray-100 px-4 py-3">
                        <p class="text-xs uppercase font-bold tracking-widest text-gray-400 mb-1">Account Status</p>
                        <p class="text-gray-900 font-semibold">
                            {{ $agent->user->is_active ? 'Active' : 'Inactive' }}
                            @if ($agent->user->is_verified)
                                · Verified
                            @endif
                        </p>
                    </div>
                </div>
            @else
                <div class="py-10 text-center border-2 border-dashed border-gray-100 rounded-2xl">
                    <p class="text-sm text-gray-400 italic">Linked user not found.</p>
                </div>
            @endif
        </div>

        {{-- Referral Performance --}}
        <div class="bg-white border border-gray-100 rounded-[2rem] p-6 md:p-8 shadow-[0_20px_50px_rgba(0,0,0,0.04)]">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-xl font-black text-gray-900 tracking-tight">Referral Performance</h2>
                    <p class="text-xs text-gray-400 font-medium mt-1 uppercase tracking-widest">Growth & Conversion Metrics
                    </p>
                </div>
                <div class="h-10 w-10 rounded-xl bg-[#D4AF37]/10 flex items-center justify-center text-[#8f6a10]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
                {{-- Referred Users --}}
                <div
                    class="group p-5 rounded-3xl bg-indigo-50/30 border border-indigo-100/50 hover:bg-indigo-50 transition-all">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="p-2 rounded-lg bg-indigo-100 text-indigo-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M17 20h5V4H2v16h5m10 0v-4a3 3 0 10-6 0v4m6 0H7" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-indigo-400">Referral</span>
                    </div>
                    <p class="text-3xl font-black text-indigo-900 leading-none">{{ $referredUsersCount }}</p>
                    <p class="text-xs font-bold text-indigo-600/60 mt-2 uppercase">Total Referred</p>
                </div>

                {{-- Successful Orders --}}
                <div
                    class="group p-5 rounded-3xl bg-amber-50/30 border border-amber-100/50 hover:bg-amber-50 transition-all">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="p-2 rounded-lg bg-amber-100 text-amber-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-amber-500">Total Orders</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <p class="text-3xl font-black text-amber-900 leading-none">{{ $successfulReferralOrders }}</p>
                        <span class="text-[10px] font-bold text-amber-600 bg-white px-1.5 py-0.5 rounded shadow-sm">
                            {{ $referredUsersCount > 0 ? round(($successfulReferralOrders / $referredUsersCount) * 100, 1) : 0 }}%
                            Conv.
                        </span>
                    </div>
                    <p class="text-xs font-bold text-amber-600/60 mt-2 uppercase">Successful Orders</p>
                </div>

                {{-- Current Points --}}
                <div class="group p-5 rounded-3xl bg-sky-50/30 border border-sky-100/50 hover:bg-sky-50 transition-all">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="p-2 rounded-lg bg-sky-100 text-sky-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-sky-500">Redeemable</span>
                    </div>
                    <p class="text-3xl font-black text-sky-900 leading-none">
                        {{ number_format($agent->current_points ?? 0, 2) }}</p>
                    <p class="text-xs font-bold text-sky-600/60 mt-2 uppercase">Available Points</p>
                </div>

                {{-- Total Commission --}}
                <div
                    class="group p-5 rounded-3xl bg-emerald-50/40 border border-emerald-100/50 hover:bg-emerald-50 transition-all">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="p-2 rounded-lg bg-emerald-100 text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-emerald-500">Earnings</span>
                    </div>
                    <div class="flex items-baseline gap-1">
                        <span class="text-lg font-black text-emerald-700">RM</span>
                        <p class="text-3xl font-black text-emerald-900 leading-none">
                            {{ number_format($agent->total_earned_rm ?? 0, 2) }}</p>
                    </div>
                    <p class="text-xs font-bold text-emerald-600/60 mt-2 uppercase">Total Commission</p>
                </div>
            </div>
        </div>

        {{-- Recent Orders --}}
        <div class="bg-white border border-[#D4AF37]/18 rounded-2xl p-6 shadow-[0_18px_40px_rgba(0,0,0,0.06)]">
            <div class="flex items-center justify-between mb-5">
                <h2 class="font-bold text-gray-900">Recent Orders</h2>
                <span class="text-xs font-bold text-gray-300 uppercase tracking-widest">
                    @if ($recentOrders->count())
                        Last {{ $recentOrders->count() }} Orders
                    @else
                        No Orders Yet
                    @endif
                </span>
            </div>

            @if ($recentOrders->count())
                <div class="flex-1 -mx-3">
                    <ul class="divide-y divide-gray-100">
                        @foreach ($recentOrders as $order)
                            <li class="px-3 py-3 flex items-center justify-between gap-4">
                                <div>
                                    <div class="flex items-center gap-2 text-sm font-semibold text-gray-900">
                                        <span>Order #{{ $order->order_no }}</span>

                                        <span
                                            class="text-[10px] px-2 py-0.5 rounded-full
                                            @switch($order->status)
                                                  @case('pending') bg-amber-50 text-amber-700 border border-amber-200 @break
                                        @case('paid') bg-emerald-50 text-emerald-700 border border-emerald-200 @break
                                        @case('processing') bg-indigo-50 text-indigo-700 border border-indigo-200 @break
                                        @case('shipped') bg-blue-50 text-blue-700 border border-blue-200 @break
                                        @case('completed') bg-emerald-50 text-emerald-700 border border-emerald-200 @break
                                        @case('cancelled') bg-gray-50 text-gray-600 border border-gray-200 @break
                                        @case('failed') bg-rose-50 text-rose-700 border border-rose-200 @break
                                        @default bg-gray-100 text-gray-500
                                            @endswitch">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>

                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                        @if ($order->items_count ?? false)
                                            · {{ $order->items_count }} item(s)
                                        @endif
                                    </p>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="text-right">
                                        <div class="text-sm font-bold text-gray-900">
                                            RM {{ number_format($order->total, 2) }}
                                        </div>
                                        @if ($order->payment_method_name ?? null)
                                            <div class="text-[11px] text-gray-400">
                                                {{ $order->payment_method_name }}
                                            </div>
                                        @endif
                                    </div>

                                    <a href="{{ route('admin.orders.show', $order) }}"
                                        class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200
                                        text-xs font-semibold text-gray-700 hover:border-[#D4AF37]/60 hover:text-[#8f6a10] transition">
                                        View
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div
                    class="flex flex-col items-center justify-center text-center space-y-3 py-10 border-2 border-dashed border-gray-50 rounded-2xl bg-gray-50/30">
                    <div class="p-3 bg-white rounded-full shadow-sm border border-gray-100 text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-500">No orders found</p>
                        <p class="text-xs text-gray-400 max-w-xs mx-auto mt-1">
                            This agent's linked user has not placed any orders yet.
                        </p>
                    </div>
                </div>
            @endif
        </div>

        {{-- Recent Commission History --}}
        <div class="bg-white border border-[#D4AF37]/18 rounded-2xl p-6 shadow-[0_18px_40px_rgba(0,0,0,0.06)]">
            <div class="flex items-center justify-between mb-5">
                <h2 class="font-bold text-gray-900">Recent Point History</h2>
                <span class="text-xs font-bold text-gray-300 uppercase tracking-widest">
                    @if ($recentPointLogs->count())
                        Last {{ $recentPointLogs->count() }} Records
                    @else
                        No Point History Yet
                    @endif
                </span>
            </div>

            @if ($recentPointLogs->count())
                <div class="flex-1 -mx-3">
                    <ul class="divide-y divide-gray-100">
                        @foreach ($recentPointLogs as $log)
                            @php
                                $isIn = $log->direction === 'in';

                                $typeLabel = match ($log->type) {
                                    'commission' => 'Commission Earned',
                                    'redeem' => 'Points Redeemed',
                                    'admin_adjustment' => 'Admin Adjustment',
                                    default => ucfirst($log->type),
                                };

                                $badgeClass = $isIn ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700';

                                $pointsClass = $isIn ? 'text-sky-600' : 'text-rose-600';
                            @endphp

                            <li class="px-3 py-3 flex items-center justify-between gap-4">
                                <div>
                                    <div class="flex items-center gap-2 text-sm font-semibold text-gray-900 flex-wrap">
                                        <span>{{ $typeLabel }}</span>

                                        <span class="text-[10px] px-2 py-0.5 rounded-full {{ $badgeClass }}">
                                            {{ strtoupper($log->direction) }}
                                        </span>
                                    </div>

                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $log->created_at?->format('d M Y, H:i') ?? '—' }}
                                    </p>

                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $log->remark ?: 'No description available.' }}
                                    </p>

                                    @if ($log->reference_type && $log->reference_id)
                                        <p class="text-xs text-gray-400 mt-1">
                                            Ref: {{ $log->reference_type }} #{{ $log->reference_id }}
                                        </p>
                                    @endif
                                </div>

                                <div class="text-right">
                                    <div class="text-sm font-bold {{ $pointsClass }}">
                                        {{ $isIn ? '+' : '-' }}{{ number_format($log->points, 2) }} pts
                                    </div>
                                    <div class="text-[11px] text-gray-400 font-semibold">
                                        {{ ucfirst($log->type) }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div
                    class="flex flex-col items-center justify-center text-center space-y-3 py-10 border-2 border-dashed border-gray-50 rounded-2xl bg-gray-50/30">
                    <div class="p-3 bg-white rounded-full shadow-sm border border-gray-100 text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-500">No point records found</p>
                        <p class="text-xs text-gray-400 max-w-xs mx-auto mt-1">
                            Point earnings and redemptions will appear here automatically.
                        </p>
                    </div>
                </div>
            @endif
        </div>

        {{-- Notes --}}
        <div class="bg-white border border-[#D4AF37]/18 rounded-2xl p-6 shadow-[0_18px_40px_rgba(0,0,0,0.06)]">
            <h2 class="font-bold text-gray-900 mb-4">Internal Notes</h2>

            <div class="rounded-xl bg-gray-50/80 border border-gray-100 px-4 py-4 text-sm text-gray-600">
                {{ $agent->notes ?: 'No notes added yet.' }}
            </div>
        </div>
    </div>

    {{-- Adjust Points Modal --}}
    <div id="adjustPointsModal" class="hidden fixed inset-0 z-50">
        <div class="absolute inset-0 bg-black/40"
            onclick="document.getElementById('adjustPointsModal').classList.add('hidden')"></div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-lg bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-black text-gray-900">Adjust Agent Points</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Current Balance: <span
                                class="font-bold text-sky-600">{{ number_format($agent->current_points ?? 0, 2) }}
                                pts</span>
                        </p>
                    </div>

                    <button type="button" onclick="document.getElementById('adjustPointsModal').classList.add('hidden')"
                        class="w-10 h-10 rounded-full hover:bg-gray-100 text-gray-400 hover:text-gray-700 transition">
                        ✕
                    </button>
                </div>

                <form method="POST" action="{{ route('admin.agents.adjust-points', $agent) }}" class="p-6 space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs uppercase tracking-widest font-bold text-gray-400 mb-2">
                            Adjustment Type
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            <label
                                class="rounded-2xl border border-gray-200 px-4 py-3 cursor-pointer hover:border-emerald-300 transition">
                                <input type="radio" name="direction" value="in" class="mr-2" checked>
                                <span class="font-bold text-emerald-700">Add Points</span>
                            </label>

                            <label
                                class="rounded-2xl border border-gray-200 px-4 py-3 cursor-pointer hover:border-rose-300 transition">
                                <input type="radio" name="direction" value="out" class="mr-2">
                                <span class="font-bold text-rose-700">Deduct Points</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest font-bold text-gray-400 mb-2">
                            Points Amount
                        </label>
                        <input type="number" name="points" min="0.01" step="0.01" value="{{ old('points') }}"
                            class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-black focus:border-[#D4AF37] focus:ring-[#D4AF37]/30"
                            placeholder="Enter points amount" required>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest font-bold text-gray-400 mb-2">
                            Remark
                        </label>
                        <textarea name="remark" rows="4"
                            class="w-full rounded-2xl border border-gray-200 px-4 py-3 text-black focus:border-[#D4AF37] focus:ring-[#D4AF37]/30 resize-none"
                            placeholder="Example: Bonus reward / Manual correction / Point deduction for adjustment" required>{{ old('remark') }}</textarea>
                    </div>

                    @if ($errors->has('adjust_points'))
                        <div class="rounded-2xl bg-rose-50 border border-rose-100 px-4 py-3 text-sm text-rose-700">
                            {{ $errors->first('adjust_points') }}
                        </div>
                    @endif

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button"
                            onclick="document.getElementById('adjustPointsModal').classList.add('hidden')"
                            class="px-5 py-3 rounded-2xl border border-gray-200 text-gray-700 font-bold hover:bg-gray-50 transition">
                            Cancel
                        </button>

                        <button type="submit"
                            class="px-5 py-3 rounded-2xl bg-[#D4AF37] text-white font-bold hover:bg-[#c89d1c] transition shadow-sm">
                            Save Adjustment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
