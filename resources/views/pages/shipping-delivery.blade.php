<x-app-layout>
    @section('title', $title ?? 'Shipping & Delivery')

    <section class="bg-[#f7f7f9] min-h-screen pb-20">
        {{-- Header --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                <h2 class="text-xs font-bold uppercase tracking-[0.3em] text-[#15A5ED] mb-3">Logistics & Logistics</h2>
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 tracking-tight mb-4">Shipping & Delivery</h1>
                <p class="text-base text-gray-500 max-w-2xl mx-auto leading-relaxed">
                    We partner with reliable couriers to ensure your orders arrive safely and on time. Here is
                    everything you need to know about our shipping process.
                </p>

                {{-- Fast Nav --}}
                <div class="mt-10 flex flex-wrap items-center justify-center gap-2">
                    @foreach ([['id' => 'processing', 'label' => 'Processing'], ['id' => 'rates', 'label' => 'Rates & Zones'], ['id' => 'eta', 'label' => 'Delivery Time'], ['id' => 'tracking', 'label' => 'Tracking']] as $j)
                        <a href="#{{ $j['id'] }}"
                            class="inline-flex items-center px-4 py-2 rounded-2xl bg-white border border-gray-100 shadow-sm
                                  text-xs font-bold text-gray-600 hover:border-[#15A5ED]/60 hover:text-[#15A5ED] transition-all">
                            {{ $j['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10">

            {{-- Section: Processing Time --}}
            <div id="processing" class="scroll-mt-24 bg-white border border-gray-100 rounded-[2.5rem] p-8 shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Order Journey</h3>

                <div class="relative flex flex-col md:flex-row justify-between gap-8 md:gap-4">
                    {{-- Timeline Logic --}}
                    @foreach ([['t' => 'Order Placed', 'd' => 'Payment confirmed instantly.'], ['t' => 'Processing', 'd' => '1-3 business days to pack.'], ['t' => 'Shipped', 'd' => 'Handed over to our courier.']] as $index => $step)
                        <div class="flex-1 relative">
                            <div class="flex items-center gap-4 md:block">
                                <div
                                    class="w-10 h-10 rounded-full bg-[#15A5ED]/10 flex items-center justify-center text-[#15A5ED] font-bold text-sm mb-3">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">{{ $step['t'] }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">{{ $step['d'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Section: Rates --}}
            <div id="rates" class="scroll-mt-24 bg-white border border-gray-100 rounded-[2.5rem] p-8 shadow-sm">
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900">Shipping Rates & Zones</h3>
                    <p class="text-sm text-gray-500 mt-1">Calculated based on volumetric weight and destination.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ([['t' => 'West Malaysia', 'p' => 'From RM8.00', 'd' => 'Fastest land delivery.'], ['t' => 'East Malaysia', 'p' => 'From RM15.00', 'd' => 'Air freight via PosLaju/J&T.'], ['t' => 'Digital Product', 'p' => 'Free of Charge', 'd' => 'Available at our HQ (By Appt).']] as $c)
                        <div
                            class="rounded-3xl bg-[#f7f7f9] border border-gray-100 p-6 hover:border-[#15A5ED]/30 transition-all">
                            <p class="text-xs font-bold text-[#15A5ED] uppercase tracking-wider">{{ $c['t'] }}</p>
                            <p class="text-2xl font-black text-gray-900 mt-2">{{ $c['p'] }}</p>
                            <p class="text-xs text-gray-500 mt-3 leading-relaxed">{{ $c['d'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Section: ETA --}}
            <div id="eta" class="scroll-mt-24 bg-white border border-gray-100 rounded-[2.5rem] p-8 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="max-w-md">
                        <h3 class="text-xl font-bold text-gray-900">Estimated Delivery Time</h3>
                        <p class="text-sm text-gray-600 mt-3 leading-relaxed">
                            Once shipped, West Malaysia orders typically arrive in <strong>2-4 days</strong>, while East
                            Malaysia takes <strong>5-9 business days</strong>.
                        </p>
                    </div>
                    <div class="shrink-0 flex -space-x-2">
                        {{-- Mockup of courier partner logos --}}
                        @foreach (range(1, 3) as $i)
                            <div
                                class="w-12 h-12 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-400">
                                LOGO
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Section: Tracking --}}
            <div id="tracking" class="scroll-mt-24 bg-gray-900 rounded-[2.5rem] p-8 text-white shadow-xl">
                <div class="flex flex-col md:flex-row gap-8 items-center">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold">Real-time Tracking</h3>
                        <p class="text-gray-400 text-sm mt-4 leading-relaxed">
                            Check your parcel's status directly from your dashboard or via the link sent to your email.
                            We update our tracking data every 6 hours.
                        </p>
                    </div>
                    <a href="{{ route('account.orders.index') ?? '#' }}"
                        class="px-8 py-4 rounded-2xl bg-[#15A5ED] hover:bg-[#0E8CCB] text-white font-bold transition-all shadow-lg shadow-[#15A5ED]/20">
                        Track My Order
                    </a>
                </div>
            </div>

            {{-- Contact Support --}}
            <div id="issues"
                class="scroll-mt-24 rounded-[2.5rem] border-2 border-dashed border-gray-200 p-10 text-center">
                <h3 class="text-xl font-bold text-gray-900">Missing or Damaged Parcel?</h3>
                <p class="text-sm text-gray-500 mt-2 mb-8 max-w-lg mx-auto">
                    Don't worry. If your order is significantly delayed or arrives in poor condition, our logistics team
                    will investigate immediately.
                </p>
                <a href="https://wa.me/601156898898" target="_blank"
                    class="inline-flex items-center justify-center gap-3 px-8 py-3 rounded-xl bg-white border border-gray-200 text-sm font-bold text-gray-700 hover:bg-gray-50 transition-all">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                    Chat with Logistics Team
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
