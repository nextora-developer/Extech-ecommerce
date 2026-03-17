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
        <div class="bg-white border border-[#D4AF37]/18 rounded-2xl p-6 shadow-[0_18px_40px_rgba(0,0,0,0.06)]">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-100 pb-6">
                <div class="flex items-center gap-4">
                    <div
                        class="h-14 w-14 rounded-2xl bg-[#D4AF37]/10 border border-[#D4AF37]/20 flex items-center justify-center text-[#8f6a10] font-bold text-xl uppercase">
                        {{ substr($agent->user->name ?? 'A', 0, 1) }}
                    </div>

                    <div>
                        <p class="font-bold text-gray-900 text-lg leading-tight">
                            {{ $agent->user->name ?? 'Unknown User' }}
                        </p>
                        <div class="flex items-center gap-2 mt-1 flex-wrap">
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-100 uppercase tracking-wider">
                                Agent
                            </span>

                            @if ($agent->status === 'active')
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-wider">
                                    Active
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-100 uppercase tracking-wider">
                                    Suspended
                                </span>
                            @endif

                            @if ($agent->user?->is_verified)
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-wider">
                                    Verified User
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 flex-wrap">
                    @if ($agent->status === 'active')
                        <form action="{{ route('admin.agents.suspend', $agent) }}" method="POST"
                            onsubmit="return confirm('Suspend this agent?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 rounded-xl bg-amber-50 text-amber-700 border border-amber-200 font-bold hover:bg-amber-500 hover:text-white transition">
                                Suspend Agent
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.agents.activate', $agent) }}" method="POST"
                            onsubmit="return confirm('Activate this agent?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold hover:bg-emerald-600 hover:text-white transition">
                                Activate Agent
                            </button>
                        </form>
                    @endif

                    @if ($agent->user)
                        <form action="{{ route('admin.users.remove-agent', $agent->user) }}" method="POST"
                            onsubmit="return confirm('Remove this user as agent?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 rounded-xl bg-rose-50 text-rose-700 border border-rose-200 font-bold hover:bg-rose-600 hover:text-white transition">
                                Revoke Agent
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 text-sm">
                <div class="rounded-xl bg-gray-50/80 border border-gray-100 px-4 py-3">
                    <p class="text-xs uppercase font-bold tracking-widest text-gray-400 mb-1">Agent Code</p>
                    <p class="text-gray-900 font-mono font-bold">{{ $agent->agent_code ?? '—' }}</p>
                </div>

                <div class="rounded-xl bg-gray-50/80 border border-gray-100 px-4 py-3">
                    <p class="text-xs uppercase font-bold tracking-widest text-gray-400 mb-1">Approved By</p>
                    <p class="text-gray-900 font-semibold">{{ $agent->approver->name ?? '—' }}</p>
                </div>

                <div class="rounded-xl bg-gray-50/80 border border-gray-100 px-4 py-3">
                    <p class="text-xs uppercase font-bold tracking-widest text-gray-400 mb-1">Approved At</p>
                    <p class="text-gray-900 font-semibold">{{ $agent->approved_at?->format('d M Y H:i') ?? '—' }}</p>
                </div>

                <div class="rounded-xl bg-gray-50/80 border border-gray-100 px-4 py-3">
                    <p class="text-xs uppercase font-bold tracking-widest text-gray-400 mb-1">Created</p>
                    <p class="text-gray-900 font-semibold">{{ $agent->created_at?->format('d M Y H:i') ?? '—' }}</p>
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
                                                @case('pending') bg-amber-100 text-amber-700 @break
                                                @case('paid') bg-emerald-100 text-emerald-700 @break
                                                @case('processing') bg-blue-100 text-blue-700 @break
                                                @case('shipped') bg-indigo-100 text-indigo-700 @break
                                                @case('completed') bg-emerald-100 text-emerald-700 @break
                                                @case('cancelled') bg-red-100 text-red-600 @break
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

        {{-- Notes --}}
        <div class="bg-white border border-[#D4AF37]/18 rounded-2xl p-6 shadow-[0_18px_40px_rgba(0,0,0,0.06)]">
            <h2 class="font-bold text-gray-900 mb-4">Internal Notes</h2>

            <div class="rounded-xl bg-gray-50/80 border border-gray-100 px-4 py-4 text-sm text-gray-600">
                {{ $agent->notes ?: 'No notes added yet.' }}
            </div>
        </div>
    </div>
@endsection
