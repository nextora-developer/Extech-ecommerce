<x-app-layout>
    @section('title', $title ?? 'FAQ')

    @php
        $faqs = [
            [
                'category' => 'Website Services',
                'question' => 'What website services do you provide?',
                'answer' => 'We provide website-related services such as landing pages, corporate websites, eCommerce websites, custom web systems, website maintenance, and other digital solutions depending on your business needs.',
            ],
            [
                'category' => 'Website Services',
                'question' => 'How do I place an order for a website service?',
                'answer' => 'You can choose your preferred website package or service, add it to your cart, and submit your requirements during checkout. After payment confirmation, our team will review your order and contact you if additional information is needed.',
            ],
            [
                'category' => 'Website Services',
                'question' => 'What details should I provide for website services?',
                'answer' => 'You should provide as much relevant information as possible, such as your business name, required pages or features, design preferences, reference websites, branding materials, and any other important project details.',
            ],
            [
                'category' => 'Game Top Up',
                'question' => 'How does game top up work?',
                'answer' => 'Select your game top up product, enter the required game account details correctly, complete payment, and your order will be processed according to the product delivery method. Please make sure all account information is accurate before placing your order.',
            ],
            [
                'category' => 'Game Top Up',
                'question' => 'How long does it take to receive my game top up?',
                'answer' => 'Most game top up orders are processed as quickly as possible, but delivery time may vary depending on the product, supplier response time, or verification requirements. Please refer to your order updates for the latest status.',
            ],
            [
                'category' => 'Game Top Up',
                'question' => 'What happens if I entered the wrong game ID or account details?',
                'answer' => 'Please check your information carefully before submitting the order. Incorrect account details may cause delays or failed delivery. In such cases, correction or refund may not always be possible once the order has been processed.',
            ],
            [
                'category' => 'Software License',
                'question' => 'How will I receive my software license?',
                'answer' => 'Software licenses are usually delivered digitally through the appropriate channel, such as email, order history, or direct contact, depending on the product type and fulfillment method.',
            ],
            [
                'category' => 'Software License',
                'question' => 'Are software licenses physical products?',
                'answer' => 'No. Software licenses are digital products only. No physical item will be shipped unless clearly stated otherwise on the product page.',
            ],
            [
                'category' => 'Orders & Payment',
                'question' => 'What payment methods do you accept?',
                'answer' => 'Available payment methods will be shown during checkout. Please complete payment only through the official payment options provided on our website.',
            ],
            [
                'category' => 'Orders & Payment',
                'question' => 'How do I know if my payment was successful?',
                'answer' => 'Once your payment is successful, you should see a payment confirmation screen and your order status will be updated accordingly. You may also receive an email notification or see the update in your order history.',
            ],
            [
                'category' => 'Orders & Payment',
                'question' => 'Can I cancel or change my order after payment?',
                'answer' => 'Because many of our products and services are digital in nature, orders that have already been processed may not be cancelled, changed, or refunded. Please review your order carefully before making payment.',
            ],
            [
                'category' => 'Delivery',
                'question' => 'Do you provide shipping for orders?',
                'answer' => 'No shipping is required for most of our products because we mainly provide digital products and services such as website services, game top up, and software licenses.',
            ],
            [
                'category' => 'Delivery',
                'question' => 'How will I receive updates about my order?',
                'answer' => 'Order updates may be provided through your account dashboard, email, or direct contact from our team, depending on the type of order and fulfillment process.',
            ],
            [
                'category' => 'Support',
                'question' => 'How can I contact support if I need help?',
                'answer' => 'If you need assistance, you can contact our support team through the contact method provided on our website. Please include your order number and relevant details so we can assist you more efficiently.',
            ],
            [
                'category' => 'Support',
                'question' => 'Do you offer refunds?',
                'answer' => 'Refund eligibility depends on the type of product or service purchased and the processing status of the order. Since many of our products are digital, refunds may not be available once delivery or processing has started.',
            ],
        ];

        $categories = collect($faqs)->pluck('category')->unique();
    @endphp

    <section class="bg-[#f7f7f9] min-h-screen pb-20">
        {{-- Header --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                <h2 class="text-xs font-bold uppercase tracking-[0.3em] text-[#15A5ED] mb-3">
                    Support Center
                </h2>

                <h1 class="text-4xl font-bold text-gray-900 tracking-tight mb-6">
                    Frequently Asked Questions
                </h1>

                <p class="text-gray-500 max-w-2xl mx-auto mb-8 leading-relaxed">
                    Find answers about website services, game top up, software licenses, payments, and order delivery.
                </p>

                {{-- Search Bar --}}
                <div class="relative max-w-xl mx-auto">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>

                    <input
                        type="text"
                        id="faqSearch"
                        placeholder="Search for answers (e.g. website service, game top up, license...)"
                        class="block w-full pl-11 pr-4 py-4 bg-[#f7f7f9] border-none rounded-2xl text-sm
                               focus:ring-2 focus:ring-[#15A5ED]/40 transition-all">
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row gap-12">

                {{-- Category Sidebar --}}
                <aside class="hidden lg:block w-64 shrink-0 space-y-2">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 px-4 mb-4">
                        Categories
                    </h3>

                    <button
                        class="w-full text-left px-4 py-2 rounded-xl text-sm font-bold
                               text-[#15A5ED] bg-[#EAF6FF]"
                        data-filter="all">
                        All Questions
                    </button>

                    @foreach ($categories as $cat)
                        <button
                            class="w-full text-left px-4 py-2 rounded-xl text-sm font-medium
                                   text-gray-500 hover:bg-white hover:text-gray-900 transition-all"
                            data-filter="{{ Str::slug($cat) }}">
                            {{ $cat }}
                        </button>
                    @endforeach
                </aside>

                {{-- FAQ List --}}
                <div class="flex-1 space-y-4" id="faqList">
                    @foreach ($faqs as $faq)
                        <div
                            class="faq-item bg-white border border-gray-100 rounded-2xl shadow-sm
                                   overflow-hidden transition-all duration-300"
                            data-category="{{ Str::slug($faq['category']) }}">

                            <button
                                type="button"
                                class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left group"
                                data-faq-toggle>

                                <div>
                                    <span
                                        class="inline-block px-2 py-0.5 rounded bg-[#f7f7f9]
                                               text-[10px] font-bold uppercase tracking-wider
                                               text-[#15A5ED] mb-2">
                                        {{ $faq['category'] }}
                                    </span>

                                    <p
                                        class="text-base font-bold text-gray-900
                                               group-hover:text-[#15A5ED] transition-colors">
                                        {{ $faq['question'] }}
                                    </p>
                                </div>

                                <span
                                    class="w-10 h-10 rounded-full bg-[#f7f7f9]
                                           group-hover:bg-[#EAF6FF]
                                           flex items-center justify-center shrink-0 transition-all">
                                    <svg
                                        class="w-5 h-5 text-[#15A5ED] transition-transform duration-300"
                                        data-faq-icon
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                </span>
                            </button>

                            <div class="px-6 pb-6 hidden" data-faq-panel>
                                <div class="pt-2 border-t border-gray-50 mt-1">
                                    <p class="text-gray-600 leading-relaxed">
                                        {{ $faq['answer'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- No Results --}}
                    <div id="noResults" class="hidden text-center py-20">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-full
                                   bg-gray-100 text-gray-400 mb-4">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        <h4 class="text-lg font-bold text-gray-900">No matches found</h4>
                        <p class="text-gray-500">Try adjusting your search keywords.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Accordion
        document.querySelectorAll('[data-faq-toggle]').forEach(btn => {
            btn.addEventListener('click', () => {
                const item = btn.closest('.faq-item');
                const panel = item.querySelector('[data-faq-panel]');
                const icon = item.querySelector('[data-faq-icon]');
                const isOpen = !panel.classList.contains('hidden');

                document.querySelectorAll('[data-faq-panel]').forEach(p => p.classList.add('hidden'));
                document.querySelectorAll('[data-faq-icon]').forEach(i => i.classList.remove('rotate-45'));
                document.querySelectorAll('.faq-item').forEach(i => {
                    i.classList.remove('ring-2', 'ring-[#15A5ED]/20');
                });

                if (!isOpen) {
                    panel.classList.remove('hidden');
                    icon.classList.add('rotate-45');
                    item.classList.add('ring-2', 'ring-[#15A5ED]/20');
                }
            });
        });

        // Search + Category Filter
        const searchInput = document.getElementById('faqSearch');
        const faqItems = document.querySelectorAll('.faq-item');
        const noResults = document.getElementById('noResults');
        const filterButtons = document.querySelectorAll('[data-filter]');
        let activeCategory = 'all';

        function applyFilters() {
            const term = searchInput.value.toLowerCase().trim();
            let hasMatch = false;

            faqItems.forEach(item => {
                const text = item.innerText.toLowerCase();
                const matchesSearch = text.includes(term);
                const matchesCategory =
                    activeCategory === 'all' || item.dataset.category === activeCategory;

                if (matchesSearch && matchesCategory) {
                    item.style.display = 'block';
                    hasMatch = true;
                } else {
                    item.style.display = 'none';
                }
            });

            noResults.style.display = hasMatch ? 'none' : 'block';
        }

        searchInput.addEventListener('input', applyFilters);

        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                activeCategory = btn.getAttribute('data-filter');

                filterButtons.forEach(b => {
                    b.classList.remove('bg-[#EAF6FF]', 'text-[#15A5ED]', 'font-bold');
                    b.classList.add('text-gray-500', 'font-medium');
                });

                btn.classList.add('bg-[#EAF6FF]', 'text-[#15A5ED]', 'font-bold');
                btn.classList.remove('text-gray-500', 'font-medium');

                applyFilters();
            });
        });
    </script>
</x-app-layout>