<x-app-layout>
    @section('title', $title ?? 'Refunds & Cancellations')

    <section class="bg-[#f7f7f9] min-h-screen pb-20">
        {{-- Header --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                <h2 class="text-xs font-bold uppercase tracking-[0.3em] text-[#15A5ED] mb-3">Customer Care</h2>
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 tracking-tight mb-4">Refunds & Cancellations</h1>
                <p class="text-base text-gray-500 max-w-2xl mx-auto leading-relaxed">
                    Because we mainly provide digital products and services, refund and cancellation requests are
                    handled
                    based on the type of order and its processing status.
                </p>

                {{-- Anchor Navigation --}}
                <div class="mt-10 flex flex-wrap items-center justify-center gap-2">
                    @foreach ([['id' => 'eligibility', 'label' => 'Eligibility'], ['id' => 'process', 'label' => 'Request Process'], ['id' => 'refunds', 'label' => 'Refund Policy'], ['id' => 'exceptions', 'label' => 'Exclusions']] as $j)
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
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Refund Eligibility</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ([['t' => 'Undelivered Order', 'd' => 'A refund may be considered if payment was successful but the product or service was not delivered at all.'], ['t' => 'Duplicate Payment', 'd' => 'If you were charged more than once for the same order, the duplicate charge may be reviewed for refund.'], ['t' => 'Unfulfilled Service', 'd' => 'If we are unable to fulfill the purchased service or product, a refund may be considered after review.'], ['t' => 'Proof of Purchase', 'd' => 'Your order number, payment proof, or account details may be required for verification.']] as $rule)
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
                <h3 class="text-2xl font-bold text-gray-900 px-4">How to Request a Refund or Cancellation</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ([['t' => '1. Contact Support', 'd' => 'Message us with your order number and explain the issue clearly.'], ['t' => '2. Verification Review', 'd' => 'We will review your payment, order status, and fulfillment progress before making a decision.'], ['t' => '3. Resolution', 'd' => 'If approved, we will process the refund or advise the next step for your order.']] as $step)
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
                    <p class="text-gray-400 text-sm leading-relaxed mb-8 max-w-2xl">
                        Due to the nature of digital products, software licenses, game top up, and custom website
                        services, most completed sales are final. Refunds or cancellations are generally not available
                        once a product has been delivered, a license has been issued, a top up has been processed, or
                        service work has already started.
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
                            <p class="text-xs font-bold text-white uppercase tracking-widest">Review Time</p>
                            <p class="text-xs text-gray-400">Refund reviews are handled as soon as possible after
                                verification.</p>
                        </div>
                    </div>
                </div>

                <div class="absolute right-0 top-0 -mr-16 -mt-16 w-64 h-64 bg-[#15A5ED]/10 rounded-full blur-3xl"></div>
            </div>

            {{-- Section: Exceptions --}}
            <div id="exceptions" class="scroll-mt-24">
                <div class="bg-white border border-gray-100 rounded-[2.5rem] p-8 shadow-sm">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Non-Refundable Cases</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-6">
                        The following situations are generally not eligible for refund, cancellation, or exchange.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ([['t' => 'Delivered Digital Products', 'd' => 'Digital items that have already been delivered, shown, sent, or fulfilled.'], ['t' => 'Processed Game Top Up', 'd' => 'Game top up orders that have already been credited or processed using the submitted account details.'], ['t' => 'Issued Software Licenses', 'd' => 'Software licenses, activation keys, or access credentials that have already been issued or delivered.'], ['t' => 'Started Website Services', 'd' => 'Website projects, maintenance tasks, consultation, setup, or custom work that has already begun.'], ['t' => 'Incorrect Customer Information', 'd' => 'Orders affected by wrong email, wrong account ID, wrong server, or incomplete customer-submitted details.'], ['t' => 'Change of Mind', 'd' => 'Refunds are generally not provided for simple change-of-mind requests after payment or fulfillment has started.']] as $ex)
                            <div class="rounded-2xl bg-[#f7f7f9] border border-gray-100 p-5">
                                <p class="text-xs font-black uppercase tracking-widest text-[#15A5ED]">
                                    {{ $ex['t'] }}
                                </p>
                                <p class="text-sm text-gray-600 mt-2 leading-relaxed">{{ $ex['d'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Contact --}}
            <div class="rounded-[2.5rem] border-2 border-dashed border-gray-200 p-10 text-center">
                <h3 class="text-xl font-bold text-gray-900">Need Help With a Refund Request?</h3>
                <p class="text-sm text-gray-500 mt-2 mb-8 max-w-lg mx-auto">
                    Contact our support team with your order number and issue details, and we will review your request.
                </p>
                <a href="https://wa.me/601156898898" target="_blank"
                    class="inline-flex items-center justify-center gap-3 px-8 py-3 rounded-xl bg-white border border-gray-200 text-sm font-bold text-gray-700 hover:bg-gray-50 transition-all">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                    Chat with Support
                </a>
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
