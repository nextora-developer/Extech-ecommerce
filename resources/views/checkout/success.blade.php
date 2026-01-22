<x-app-layout>
    <section class="bg-[#FAF9F6] min-h-screen flex items-center justify-center py-20 px-4">
        <div class="w-full max-w-xl animate-in fade-in slide-in-from-bottom-4 duration-700">

            {{-- Card --}}
            <div
                class="bg-white rounded-[2rem] border border-gray-100 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.08)] p-10 sm:p-14 text-center relative overflow-hidden">

                {{-- Subtle Background Accent --}}
                <div
                    class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[#15a5ed]/40 to-transparent">
                </div>

                {{-- Icon --}}
                <div class="flex justify-center mb-8">
                    <div class="relative">
                        <div class="absolute inset-0 rounded-full bg-[#15a5ed] blur-xl opacity-10 animate-pulse"></div>
                        <div
                            class="relative w-20 h-20 rounded-full bg-white border border-[#15a5ed]/20 flex items-center justify-center shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#15a5ed]" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Title --}}
                <h1 class="text-3xl sm:text-4xl font-serif font-medium text-gray-900 mb-3">
                    Order Confirmed
                </h1>

                <p class="text-gray-500 font-light leading-relaxed mb-10 max-w-sm mx-auto">
                    Thank you for your purchase. We've received your order and we're getting it ready for shipment.
                </p>

                {{-- Order Info Table Style --}}
                <div class="text-left mb-10">
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-100 border-y border-gray-50">
                            <li class="py-4 flex items-center justify-between">
                                <span class="text-sm text-gray-400 uppercase tracking-widest">Order Number</span>
                                <span class="text-sm font-medium text-gray-900 tracking-wide">
                                    {{ $order->order_no ?? '#' . $order->id }}
                                </span>
                            </li>
                            <li class="py-4 flex items-center justify-between">
                                <span class="text-sm text-gray-400 uppercase tracking-widest">Amount Paid</span>
                                <span class="text-sm font-semibold text-gray-900">
                                    RM {{ number_format($order->total ?? 0, 2) }}
                                </span>
                            </li>
                            <li class="py-4 flex items-center justify-between">
                                <span class="text-sm text-gray-400 uppercase tracking-widest">Status</span>
                                <span
                                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $order->status === 'paid' ? 'text-emerald-700 bg-emerald-50' : 'text-amber-700 bg-amber-50' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- 黑色按钮：不改 --}}
                    <a href="{{ route('account.orders.show', $order) }}"
                        class="group relative flex justify-center items-center rounded-full bg-[#1a1a1a] px-6 py-4 text-sm font-semibold text-white transition-all hover:bg-black active:scale-[0.98]">
                        View Details
                    </a>

                    {{-- 白色按钮：只改 hover 金色 -> 蓝色 --}}
                    <a href="{{ route('shop.index') }}"
                        class="flex justify-center items-center rounded-full bg-white px-6 py-4 text-sm font-semibold text-gray-600 border border-gray-200 transition-all hover:border-[#15a5ed]/50 hover:text-[#15a5ed] active:scale-[0.98]">
                        Return to Shop
                    </a>
                </div>
            </div>

            {{-- Footer Note --}}
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-400 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Check your email for the receipt.
                </p>
            </div>
        </div>
    </section>
</x-app-layout>
