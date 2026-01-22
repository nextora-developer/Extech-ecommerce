<x-app-layout>
    @section('title', $title ?? 'Returns & Refunds')

    <section class="bg-[#f7f7f9] min-h-screen pb-20">
        {{-- Header --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                <h2 class="text-xs font-bold uppercase tracking-[0.3em] text-[#15A5ED] mb-3">Customer Care</h2>
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 tracking-tight mb-4">Returns & Refunds</h1>
                <p class="text-base text-gray-500 max-w-2xl mx-auto leading-relaxed">
                    Not quite right? We're here to help. Our goal is to make your return process as smooth as your
                    purchase.
                </p>

                {{-- Anchor Navigation --}}
                <div class="mt-10 flex flex-wrap items-center justify-center gap-2">
                    @foreach ([['id' => 'eligibility', 'label' => 'Eligibility'], ['id' => 'process', 'label' => 'How to Return'], ['id' => 'refunds', 'label' => 'Refund Policy'], ['id' => 'exceptions', 'label' => 'Exclusions']] as $j)
                        <a href="#{{ $j['id'] }}"
                            class="inline-flex items-center px-4 py-2.5 rounded-2xl bg-white border border-gray-100 shadow-sm
                                  text-xs font-bold text-gray-700 hover:border-[#15A5ED]/60 hover:text-[#15A5ED] transition-all">
                            {{ $j['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">

            {{-- Section: Eligibility --}}
            <div id="eligibility" class="scroll-mt-24">
                <div class="bg-white border border-gray-100 rounded-[2.5rem] p-8 shadow-sm">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Return Eligibility</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ([['t' => 'Original Condition', 'd' => 'Items must be unworn, unwashed, and with all original tags attached.'], ['t' => 'Packaging', 'd' => 'Must include the original box and protective materials.'], ['t' => 'Timeframe', 'd' => 'Request within 7 days of receiving your parcel.'], ['t' => 'Proof of Purchase', 'd' => 'Order ID or digital receipt must be presented.']] as $rule)
                            <div class="flex gap-4">
                                <div
                                    class="mt-1 shrink-0 w-5 h-5 rounded-full bg-green-50 text-green-600 flex items-center justify-center">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="4">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900">{{ $rule['t'] }}</h4>
                                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">{{ $rule['d'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Section: Process --}}
            <div id="process" class="scroll-mt-24 space-y-6">
                <h3 class="text-2xl font-bold text-gray-900 px-4">How to Request a Return</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ([['t' => '1. Contact Support', 'd' => 'Message us on WhatsApp with your Order ID and photos of the item.'], ['t' => '2. Pack & Ship', 'd' => 'Once approved, pack your item securely and send it back to our hub.'], ['t' => '3. Quality Check', 'd' => 'We inspect the item within 48 hours of arrival to verify its condition.']] as $step)
                        <div class="bg-white border border-gray-100 p-6 rounded-3xl">
                            <h4 class="text-sm font-bold text-[#15A5ED] mb-2">{{ $step['t'] }}</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">{{ $step['d'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Section: Refunds --}}
            <div id="refunds"
                class="scroll-mt-24 bg-gray-900 rounded-[2.5rem] p-10 text-white shadow-xl relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold mb-4">Refund Policy</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-8 max-w-xl">
                        Once your return is inspected and approved, your refund will be processed back to your original
                        payment method.
                    </p>

                    <div class="inline-flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/10">
                        <div
                            class="w-10 h-10 rounded-full bg-[#15A5ED]/20 flex items-center justify-center text-[#15A5ED]">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-white uppercase tracking-widest">Processing Time</p>
                            <p class="text-xs text-gray-400">Typically 5–10 business days depending on your bank.</p>
                        </div>
                    </div>
                </div>

                {{-- Decorative element --}}
                <div class="absolute right-0 top-0 -mr-16 -mt-16 w-64 h-64 bg-[#15A5ED]/10 rounded-full blur-3xl"></div>
            </div>

            {{-- Section: Exceptions (Added because your nav has it) --}}
            <div id="exceptions" class="scroll-mt-24">
                <div class="bg-white border border-gray-100 rounded-[2.5rem] p-8 shadow-sm">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Exclusions</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-6">
                        Some items may not be eligible for return or refund due to hygiene, safety, or licensing
                        reasons.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ([['t' => 'Used / Washed Items', 'd' => 'Items that show signs of wear, washing, or damage caused by the customer.'], ['t' => 'Missing Packaging', 'd' => 'Items returned without original box, tags, or included accessories.'], ['t' => 'Late Requests', 'd' => 'Requests made after the return window may be declined.'], ['t' => 'Non-returnable Products', 'd' => 'Certain categories (if listed at purchase) may be non-returnable.']] as $ex)
                            <div class="rounded-2xl bg-[#f7f7f9] border border-gray-100 p-5">
                                <p class="text-xs font-black uppercase tracking-widest text-[#15A5ED]">
                                    {{ $ex['t'] }}</p>
                                <p class="text-sm text-gray-600 mt-2 leading-relaxed">{{ $ex['d'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
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
