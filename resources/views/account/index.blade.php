<x-app-layout>
    <div class="bg-[#F4F8FD] min-h-screen py-6 md:py-10">
        <div class="max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="hidden sm:flex items-center uppercase space-x-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-[#15a5ed] transition-colors">Home</a>

                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>

                <span class="text-gray-900 font-medium">Account Overview</span>
            </nav>

            <div class="sm:hidden flex items-center justify-center relative mb-6">
                {{-- Back Button --}}
                <a href="{{ route('home') }}" class="absolute left-0 p-2 text-gray-500 hover:text-[#15A5ED] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>

                {{-- Title --}}
                <h1 class="text-lg font-bold text-gray-900">
                    Account Overview
                </h1>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                {{-- Left sidebar --}}
                <aside class="hidden md:block lg:col-span-1">
                    @include('account.partials.sidebar')
                </aside>


                {{-- Right Content --}}
                <main class="lg:col-span-3 space-y-8">


                    {{-- Points Wallet Section --}}
                    <section
                        class="relative overflow-hidden rounded-[2rem] border border-[#15A5ED]/10 bg-[linear-gradient(135deg,#0f172a_0%,#0b3a67_45%,#15A5ED_100%)] shadow-[0_20px_60px_rgba(21,165,237,0.18)] min-h-[260px]">
                        <div class="absolute inset-0 opacity-20"
                            style="background-image:
        linear-gradient(to right, rgba(255,255,255,0.12) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255,255,255,0.12) 1px, transparent 1px);
        background-size: 30px 30px;">
                        </div>

                        <div
                            class="absolute -top-10 -right-10 w-32 h-32 md:w-40 md:h-40 rounded-full bg-white/10 blur-3xl">
                        </div>
                        <div
                            class="absolute -bottom-10 -left-10 w-36 h-36 md:w-48 md:h-48 rounded-full bg-cyan-300/20 blur-3xl">
                        </div>

                        <div class="relative p-5 sm:p-6 md:p-8">
                            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                                {{-- Left: Main Wallet --}}
                                <div class="w-full max-w-xl">
                                    <div
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white/80 text-[10px] sm:text-[11px] font-bold uppercase tracking-[0.18em] mb-4">
                                        <span class="w-2 h-2 rounded-full bg-cyan-300 animate-pulse"></span>
                                        Points Wallet
                                    </div>

                                    <h2
                                        class="text-white text-3xl sm:text-4xl md:text-5xl font-black tracking-tight leading-none">
                                        {{ number_format($currentPoints, 2) }}
                                        <span
                                            class="text-cyan-200 text-base sm:text-lg md:text-xl font-bold align-middle">PTS</span>
                                    </h2>

                                    <p class="mt-3 text-sm sm:text-[15px] text-white/75 leading-relaxed max-w-md">
                                        This is your current available point balance. You can use your points during
                                        checkout for order
                                        redemption.
                                    </p>

                                    <div class="mt-6 flex flex-col sm:flex-row sm:flex-wrap gap-3">
                                        <a href="{{ route('account.referral.index') }}"
                                            class="inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-white text-[#0B3A67] font-bold text-sm hover:bg-cyan-50 transition-all shadow-lg w-full sm:w-auto">
                                            Open Referral Center
                                        </a>

                                        <span
                                            class="inline-flex items-center justify-center px-5 py-3 rounded-2xl border border-white/15 bg-white/5 text-white/80 text-sm font-semibold w-full sm:w-auto">
                                            RM1 = 1 Point
                                        </span>
                                    </div>
                                </div>

                                {{-- Right: Mini Stats --}}
                                <div class="w-full lg:w-auto">
                                    <div class="grid grid-cols-3 gap-2 sm:gap-3 lg:min-w-[360px]">
                                        <div
                                            class="rounded-2xl bg-white/10 border border-white/10 px-4 sm:px-5 py-4 sm:py-5 backdrop-blur-md shadow-[inset_0_1px_0_rgba(255,255,255,0.08)]">
                                            <p
                                                class="text-[10px] uppercase tracking-widest font-bold text-white/45 mb-2">
                                                Total Orders
                                            </p>
                                            <p class="text-xl sm:text-2xl font-black text-white leading-none">
                                                {{ $stats['orders'] }}
                                            </p>
                                        </div>

                                        <div
                                            class="rounded-2xl bg-white/10 border border-white/10 px-4 sm:px-5 py-4 sm:py-5 backdrop-blur-md shadow-[inset_0_1px_0_rgba(255,255,255,0.08)]">
                                            <p
                                                class="text-[10px] uppercase tracking-widest font-bold text-white/45 mb-2">
                                                Total Wishlist
                                            </p>
                                            <p class="text-xl sm:text-2xl font-black text-white leading-none">
                                                {{ $stats['favorites'] }}
                                            </p>
                                        </div>

                                        <div
                                            class="rounded-2xl bg-white/10 border border-white/10 px-4 sm:px-5 py-4 sm:py-5 backdrop-blur-md shadow-[inset_0_1px_0_rgba(255,255,255,0.08)]">
                                            <p
                                                class="text-[10px] uppercase tracking-widest font-bold text-white/45 mb-2">
                                                Total Addresses
                                            </p>
                                            <p class="text-xl sm:text-2xl font-black text-white leading-none">
                                                {{ $stats['addresses'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>

                    {{-- Point Transactions --}}
                    <section>
                        <div class="flex items-center justify-between mb-5 px-2">
                            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <span class="w-1.5 h-6 bg-[#15A5ED] rounded-full"></span>
                                Point Transactions
                            </h2>

                            {{-- <a href="{{ route('account.referral.index') }}"
                                class="text-sm font-bold text-[#15A5ED] hover:text-[#6DBAE1] flex items-center gap-1 group transition-colors">
                                View Referral Center
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a> --}}
                        </div>

                        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                            @forelse ($recentPointLogs as $log)
                                @php
                                    $isIn = $log->direction === 'in';
                                    $typeLabel = match ($log->type) {
                                        'commission' => 'Commission Earned',
                                        'redeem' => 'Points Redeemed',
                                        'admin_adjustment' => 'Admin Adjustment',
                                        default => ucfirst($log->type),
                                    };
                                @endphp

                                <div
                                    class="px-5 py-4 border-b border-gray-100 last:border-b-0 hover:bg-gray-50/60 transition-all">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-11 h-11 rounded-2xl flex items-center justify-center border
                                                {{ $isIn ? 'bg-emerald-50 border-emerald-100 text-emerald-600' : 'bg-rose-50 border-rose-100 text-rose-600' }}">
                                                @if ($isIn)
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path d="M7 17L17 7M17 7H9M17 7V15" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path d="M17 17L7 7M7 7H15M7 7V15" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                @endif
                                            </div>

                                            <div>
                                                <div class="text-sm font-bold text-gray-900">
                                                    {{ $typeLabel }}
                                                </div>
                                                <div class="text-xs text-gray-500 mt-1">
                                                    {{ $log->remark ?: 'Point activity' }} •
                                                    {{ $log->created_at->format('M d, Y h:i A') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <div
                                                class="text-sm font-black {{ $isIn ? 'text-emerald-600' : 'text-rose-600' }}">
                                                {{ $isIn ? '+' : '-' }}{{ number_format($log->points, 2) }} pts
                                            </div>
                                            <div
                                                class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mt-1">
                                                {{ $log->direction }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="bg-white rounded-3xl border border-dashed border-gray-200 p-12 text-center">
                                    <div
                                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 text-gray-300 mb-4">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <h3 class="text-gray-900 font-bold">No point transactions yet</h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Your commission earnings and point redemptions will appear here.
                                    </p>
                                </div>
                            @endforelse

                            @if ($recentPointLogs instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                <div class="mt-6">
                                    {{ $recentPointLogs->withQueryString()->links('vendor.pagination.shop-minimal') }} </div>
                            @endif
                        </div>
                    </section>

                    {{-- Latest Orders Section --}}
                    <section>
                        <div class="flex items-center justify-between mb-5 px-2">
                            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <span class="w-1.5 h-6 bg-[#15A5ED] rounded-full"></span>
                                Recent Orders
                            </h2>

                            <a href="{{ route('account.orders.index') }}"
                                class="text-sm font-bold text-[#15A5ED] hover:text-[#6DBAE1] flex items-center gap-1 group transition-colors">
                                View History
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>

                        </div>

                        <div class="space-y-3">
                            @forelse ($latestOrders as $order)
                                <a href="{{ route('account.orders.show', $order) }}"
                                    class="group block bg-white rounded-2xl border border-gray-100 p-4 hover:border-[#15A5ED]/40 hover:shadow-md hover:shadow-[#15A5ED]/10 transition-all duration-300">

                                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                                        {{-- Order Image --}}
                                        @php
                                            $firstItem = $order->items->first();
                                            $thumb =
                                                $firstItem && $firstItem->product && $firstItem->product->image
                                                    ? asset('storage/' . $firstItem->product->image)
                                                    : null;
                                        @endphp

                                        <div
                                            class="w-16 h-16 rounded-xl overflow-hidden bg-gray-50 border border-gray-100 flex-shrink-0">
                                            @if ($thumb)
                                                <img src="{{ $thumb }}"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                                    alt="">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-300">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Order Main Info --}}
                                        <div class="flex-1">
                                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                                <span
                                                    class="text-sm font-bold text-gray-900">#{{ $order->order_no }}</span>
                                                <span
                                                    class="text-xs text-gray-400 font-medium">{{ $order->created_at->format('M d, Y') }}</span>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-1 line-clamp-1">
                                                {{ $order->items->count() }}
                                                item{{ $order->items->count() > 1 ? 's' : '' }} • Delivering to
                                                {{ $order->shipping_city ?? 'Registered Address' }}
                                            </p>
                                        </div>

                                        {{-- Status & Total --}}
                                        <div
                                            class="flex items-center justify-between sm:justify-end gap-6 sm:text-right">
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'bg-amber-50 text-amber-700 border border-amber-200',
                                                    'paid' =>
                                                        'bg-emerald-50 text-emerald-700 border border-emerald-200',
                                                    'processing' =>
                                                        'bg-indigo-50 text-indigo-700 border border-indigo-200',
                                                    'shipped' => 'bg-blue-50 text-blue-700 border border-blue-200',
                                                    'completed' =>
                                                        'bg-emerald-50 text-emerald-700 border border-emerald-200',
                                                    'cancelled' => 'bg-gray-50 text-gray-600 border border-gray-200',
                                                    'failed' => 'bg-rose-50 text-rose-700 border border-rose-200',
                                                ];
                                            @endphp

                                            <span
                                                class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-tighter border {{ $statusClasses[$order->status] ?? 'bg-gray-50' }}">
                                                {{ $order->status }}
                                            </span>

                                            <div class="text-sm font-black text-gray-900">
                                                RM {{ number_format($order->total, 2) }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div
                                    class="bg-white rounded-3xl border border-dashed border-gray-200 p-12 text-center">
                                    <div
                                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 text-gray-300 mb-4">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <h3 class="text-gray-900 font-bold">No orders found</h3>
                                    <p class="text-sm text-gray-500 mt-1">When you buy something, it will appear here.
                                    </p>
                                    <a href="{{ route('shop.index') }}"
                                        class="mt-6 inline-flex items-center px-6 py-2.5
                                                bg-black text-white text-sm font-bold rounded-xl
                                                transition-all duration-300 ease-out
                                                hover:bg-black hover:text-white
                                                hover:-translate-y-0.5 hover:scale-[1.03]
                                                hover:shadow-xl hover:shadow-gray/30">
                                        Start Shopping
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </section>
                </main>

            </div>
        </div>
    </div>
</x-app-layout>
