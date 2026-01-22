<x-app-layout>
    @section('title', $title ?? 'Terms & Conditions')

    <section class="bg-[#FAF9F6] min-h-screen pb-20">
        {{-- Header --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                <h2 class="text-xs font-bold uppercase tracking-[0.4em] text-[#8f6a10] mb-3">Agreement</h2>
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 tracking-tight mb-4">Terms & Conditions</h1>
                <p class="text-base text-gray-500 max-w-2xl mx-auto leading-relaxed">
                    Please read these terms carefully before using our store. By placing an order, you agree to be bound
                    by the guidelines below.
                </p>

                {{-- Anchor Navigation --}}
                <div class="mt-10 flex flex-wrap items-center justify-center gap-2">
                    @php
                        $nav = [
                            ['id' => 'general', 'label' => 'General'],
                            ['id' => 'orders', 'label' => 'Orders'],
                            ['id' => 'payment', 'label' => 'Payment'],
                            ['id' => 'delivery', 'label' => 'Delivery'],
                            ['id' => 'returns', 'label' => 'Returns'],
                            ['id' => 'liability', 'label' => 'Liability'],
                        ];
                    @endphp
                    @foreach ($nav as $item)
                        <a href="#{{ $item['id'] }}"
                            class="inline-flex items-center px-4 py-2 rounded-2xl bg-white border border-gray-200
                                   text-xs font-bold text-gray-600 hover:border-[#D4AF37] hover:text-[#8f6a10] shadow-sm transition-all">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
            @php
                $sections = [
                    [
                        'id' => 'general',
                        'title' => '1. General Usage',
                        'gist' => 'By browsing this site, you agree to follow our rules.',
                        'body' =>
                            'These Terms and Conditions govern the use of this website and the purchase of any products from it. We reserve the right to amend these terms at any time without prior notice. Continued use of the site constitutes acceptance of the new terms.',
                    ],
                    [
                        'id' => 'orders',
                        'title' => '2. Order Contract',
                        'gist' => 'An order is only confirmed once we accept it.',
                        'body' =>
                            'All orders are subject to stock availability and price confirmation. We reserve the right to refuse or cancel any order for reasons including, but not limited to: product availability, errors in description/pricing, or suspected fraudulent activity.',
                    ],
                    [
                        'id' => 'payment',
                        'title' => '3. Payment Terms',
                        'gist' => 'Secure payment is required upfront.',
                        'body' =>
                            'Prices are shown in local currency. Payment must be cleared in full before an order is processed for shipping. We use third-party encrypted gateways to ensure your transaction data remains secure.',
                    ],
                    [
                        'id' => 'delivery',
                        'title' => '4. Shipping & Delivery',
                        'gist' => 'Timelines are estimates, not guarantees.',
                        'body' =>
                            'While we strive to meet all delivery timelines, we are not responsible for delays caused by third-party couriers, customs clearance, or incorrect address information provided by the customer.',
                    ],
                    [
                        'id' => 'returns',
                        'title' => '5. Returns & Refunds',
                        'gist' => 'Specific conditions apply for returns.',
                        'body' =>
                            'Our returns policy is limited to defective or incorrect items. Please notify us within 24-48 hours of receipt if there is an issue. Items must be in original packaging with tags intact.',
                    ],
                    [
                        'id' => 'liability',
                        'title' => '6. Limitation of Liability',
                        'gist' => 'Our total responsibility is limited to your order value.',
                        'body' =>
                            'We shall not be liable for any indirect, incidental, or consequential damages resulting from the use of our products. Our total liability to you for any claim shall not exceed the amount paid for the specific order in question.',
                    ],
                ];
            @endphp

            @foreach ($sections as $sec)
                <div id="{{ $sec['id'] }}"
                    class="scroll-mt-24 bg-white border border-gray-100 rounded-[2rem] p-8 shadow-sm group hover:border-[#D4AF37]/30 transition-colors">
                    <div class="flex flex-col md:flex-row md:items-start gap-6">
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $sec['title'] }}</h3>

                            {{-- The Gist Badge --}}
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-[#FAF9F6] border border-gray-100 mb-4">
                                <span class="text-[10px] font-black uppercase text-[#8f6a10]">The Gist:</span>
                                <span class="text-xs font-medium text-gray-600">{{ $sec['gist'] }}</span>
                            </div>

                            <p class="text-sm text-gray-500 leading-relaxed">
                                {{ $sec['body'] }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Acceptance Footer --}}
            <div class="bg-gray-900 rounded-[2rem] p-8 text-center text-white shadow-xl">
                <h3 class="text-lg font-bold mb-2">Questions about our Terms?</h3>
                <p class="text-gray-400 text-sm mb-6">If something isn't clear, we're happy to explain our policies
                    further.</p>
                <a href="https://wa.me/601156898898"
                    class="inline-flex items-center justify-center px-8 py-3 rounded-xl bg-[#D4AF37] text-white font-bold hover:bg-[#8f6a10] transition-all">
                    Contact Legal Support
                </a>
            </div>
        </div>
    </section>

    <script>
        // Smooth scroll implementation
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', (e) => {
                const id = a.getAttribute('href');
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
