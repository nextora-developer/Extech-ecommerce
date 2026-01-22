<x-app-layout>
    <section class="bg-[#f7f7f9] min-h-screen pb-20">

        {{-- Header / Hero --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 text-center">
                <h2 class="text-xs font-bold uppercase tracking-[0.4em] text-[#15A5ED] mb-4">Customer Guide</h2>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 tracking-tight mb-6">
                    How to Order
                </h1>
                <p class="text-base sm:text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
                    A seamless shopping experience from start to finish. Follow our simple 6-step guide to secure your
                    favorite items.
                </p>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">

            {{-- Steps Section --}}
            <div id="steps" class="scroll-mt-24 mb-24">
                <div class="flex items-end justify-between gap-6 mb-10">
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Simple Steps</h3>
                        <p class="text-gray-500 mt-2">Follow these steps to complete your purchase smoothly.</p>
                    </div>

                    <span
                        class="hidden sm:inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold
                               bg-white border border-[#15A5ED]/30 text-[#15A5ED] shadow-sm">
                        6 Steps Process
                    </span>
                </div>

                @php
                    $steps = [
                        [
                            'title' => 'Browse & Choose Items',
                            'desc' => 'Explore categories, view product details, and select your preferred variants.',
                            'tip' => 'Use filters and search to find items faster.',
                            'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z',
                        ],
                        [
                            'title' => 'Add to Cart',
                            'desc' =>
                                'Click “Add to Cart”. Review your items, update quantities, and apply any valid vouchers.',
                            'tip' => 'Check for minimum spend requirements on vouchers.',
                            'icon' =>
                                'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
                        ],
                        [
                            'title' => 'Checkout',
                            'desc' => 'Proceed to checkout. Securely enter your contact details and shipping address.',
                            'tip' => 'Create an account to save addresses for next time.',
                            'icon' =>
                                'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                        ],
                        [
                            'title' => 'Shipping Method (For Pyhsical Product)',
                            'desc' => 'Select the best shipping option available for your location and urgency.',
                            'tip' => 'Shipping fees are calculated based on weight and zone.',
                            'icon' =>
                                'M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 012-2m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4',
                        ],
                        [
                            'title' => 'Secure Payment',
                            'desc' => 'Choose between Online Transfer or Direct Payment to complete your order.',
                            'tip' => 'Wait for the "Payment Successful" screen before exiting.',
                            'icon' =>
                                'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                        ],
                        [
                            'title' => 'Order Updates',
                            'desc' => 'You’ll receive an email confirmation. We will provide tracking info once dispatched.',
                            'tip' => 'Track your parcel live via the "My Orders" dashboard.',
                            'icon' =>
                                'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                        ],
                    ];
                @endphp

                <div class="relative">
                    {{-- Vertical Line --}}
                    <div
                        class="hidden md:block absolute left-[2.25rem] top-4 bottom-4 w-px bg-gradient-to-b from-gray-200 via-gray-200 to-transparent">
                    </div>

                    <div class="space-y-8">
                        @foreach ($steps as $i => $s)
                            <div class="relative flex flex-col md:flex-row gap-6 group">
                                {{-- Icon Container --}}
                                <div class="shrink-0 relative z-10">
                                    <div
                                        class="w-16 h-16 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center
                                               group-hover:border-[#15A5ED]/50 transition-colors duration-300">
                                        <div class="w-12 h-12 rounded-xl bg-[#15A5ED]/10 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#15A5ED]"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['icon'] }}" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                {{-- Content Card --}}
                                <div
                                    class="flex-1 bg-white border border-gray-100 rounded-[2rem] p-6 sm:p-8 shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                        <h4 class="text-xl font-bold text-gray-900">
                                            {{ $i + 1 }}. {{ $s['title'] }}
                                        </h4>

                                        <span
                                            class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider
                                                   bg-[#f7f7f9] border border-gray-100 text-gray-400">
                                            Stage {{ $i + 1 }}
                                        </span>
                                    </div>

                                    <p class="text-gray-600 leading-relaxed mb-6">
                                        {{ $s['desc'] }}
                                    </p>

                                    {{-- Pro tip (blue tech) --}}
                                    <div class="flex items-start gap-3 p-4 rounded-2xl bg-[#EAF6FF] border border-[#15A5ED]/20">
                                        <span class="text-[#15A5ED] mt-0.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>

                                        <p class="text-sm text-slate-700/90">
                                            <span class="font-bold text-slate-900">Pro tip:</span> {{ $s['tip'] }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Smooth Scroll --}}
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', (e) => {
                const id = a.getAttribute('href');
                if (!id || id.length < 2) return;
                const el = document.querySelector(id);
                if (!el) return;

                e.preventDefault();
                el.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                history.replaceState(null, '', id);
            });
        });
    </script>
</x-app-layout>
