<x-app-layout>
    @section('title', $title ?? 'Terms & Conditions')

    <section class="bg-[#f7f7f9] min-h-screen pb-20">
        {{-- Header --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                <h2 class="text-xs font-bold uppercase tracking-[0.4em] text-[#15A5ED] mb-3">Agreement</h2>
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 tracking-tight mb-4">Terms & Conditions</h1>
                <p class="text-base text-gray-500 max-w-2xl mx-auto leading-relaxed">
                    Please read these terms carefully before using our store. By placing an order, you agree to be bound
                    by the guidelines below.
                </p>

                {{-- Anchor Navigation --}}
                <div class="mt-10 flex flex-wrap items-center justify-center gap-2">
                    @php
                        $nav = [
                            ['id' => 'introduction', 'label' => 'Introduction'],
                            ['id' => 'digital-product', 'label' => 'Digital Product'],
                            ['id' => 'order-processing', 'label' => 'Orders'],
                            ['id' => 'customer-responsibility', 'label' => 'Responsibility'],
                            ['id' => 'refund-policy', 'label' => 'Refund'],
                            ['id' => 'service-availability', 'label' => 'Availability'],
                            ['id' => 'pricing', 'label' => 'Pricing'],
                            ['id' => 'payment-methods', 'label' => 'Payment'],
                            ['id' => 'fraud', 'label' => 'Fraud'],
                            ['id' => 'illegal-use', 'label' => 'Illegal Use'],
                            ['id' => 'liability', 'label' => 'Liability'],
                            ['id' => 'account-security', 'label' => 'Security'],
                            ['id' => 'changes', 'label' => 'Changes'],
                            ['id' => 'contact', 'label' => 'Contact'],
                        ];
                    @endphp

                    @foreach ($nav as $item)
                        <a href="#{{ $item['id'] }}"
                            class="inline-flex items-center px-4 py-2 rounded-2xl bg-white border border-gray-200
                                   text-xs font-bold text-gray-600 hover:border-[#15A5ED]/60 hover:text-[#15A5ED] shadow-sm transition-all">
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
                        'id' => 'introduction',
                        'title' => '1. Introduction',
                        'gist' => 'These terms govern the use of our website and digital services.',
                        'body' => '
<p>Welcome to ExtechStudio.xyz.</p>

<p>These Terms & Conditions govern the use of our website and services. By accessing or purchasing from this website, you agree to be bound by these terms.</p>

<p>ExtechStudio.xyz provides digital products and services including but not limited to:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Mobile Reload / Prepaid Top-Up</li>
<li>Game Credits / Game Top-Up</li>
<li>E-Wallet Reload PIN (e.g. TNG Reload PIN)</li>
<li>Digital Gift Cards</li>
<li>Other digital products and services</li>
</ul>

<p>All products sold on this website are digital products and are delivered electronically.</p>
',
                    ],

                    [
                        'id' => 'digital-product',
                        'title' => '2. Digital Product Nature',
                        'gist' => 'All products sold are digital items delivered electronically.',
                        'body' => '
<p>All products sold on ExtechStudio.xyz are digital items.</p>

<p>This means:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>No physical items will be shipped</li>
<li>Delivery is done electronically</li>
</ul>

<p>Products may be delivered via</p>
<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Website display</li>
<li>Email</li>
<li>WhatsApp</li>
<li>Customer contact confirmation</li>
</ul>

',
                    ],

                    [
                        'id' => 'order-processing',
                        'title' => '3. Order Processing',
                        'gist' => 'Orders are usually fast, but delays may happen in some cases.',
                        'body' => '
<p>Orders are usually processed instantly or within a short time.</p>

<p>However, in some situations, orders may require manual verification or manual processing.</p>

<p>Processing time may vary due to:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Payment verification</li>
<li>System maintenance</li>
<li>Network provider delays</li>
<li>High transaction volume</li>
<li>Security checks</li>
</ul>

<p>ExtechStudio.xyz does not guarantee instant delivery in all cases.</p>
',
                    ],

                    [
                        'id' => 'customer-responsibility',
                        'title' => '4. Customer Responsibility',
                        'gist' => 'Customers must provide correct order information.',
                        'body' => '
<p>Customers are responsible for providing accurate information when placing an order.</p>

<p>This includes:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Correct phone number</li>
<li>Correct game ID / user ID</li>
<li>Correct server information</li>
<li>Correct email address</li>
</ul>

<p>If incorrect information is provided by the customer, ExtechStudio.xyz will not be responsible for any loss.</p>

<p>Orders completed using incorrect information cannot be reversed or refunded.</p>
',
                    ],

                    [
                        'id' => 'refund-policy',
                        'title' => '5. No Refund Policy',
                        'gist' => 'All sales are final once a digital product is delivered.',
                        'body' => '
<p>Due to the nature of digital products:</p>

<p><strong>All sales are FINAL.</strong></p>

<p>Once a digital product has been delivered or processed:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>No refunds</li>
<li>No cancellations</li>
<li>No exchanges</li>
</ul>

<p>Refunds may only be considered if:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>The order was not delivered</li>
<li>Payment was successfully charged but no product was provided</li>
</ul>

<p>Refund decisions are made at the sole discretion of ExtechStudio.xyz.</p>
',
                    ],

                    [
                        'id' => 'service-availability',
                        'title' => '6. Service Availability',
                        'gist' => 'Service may be interrupted due to maintenance or third-party issues.',
                        'body' => '
<p>ExtechStudio.xyz aims to provide reliable service, but we do not guarantee that:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>The website will always be available</li>
<li>All services will operate without interruption</li>
<li>All transactions will be processed instantly</li>
</ul>

<p>Services may be temporarily unavailable due to:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Server maintenance</li>
<li>System upgrades</li>
<li>Network issues</li>
<li>Third-party provider downtime</li>
</ul>
',
                    ],

                    [
                        'id' => 'pricing',
                        'title' => '7. Pricing & Product Changes',
                        'gist' => 'Prices and product details may change without prior notice.',
                        'body' => '
<p>All prices displayed on the website are subject to change without prior notice.</p>

<p>ExtechStudio.xyz reserves the right to:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Modify product prices</li>
<li>Change product availability</li>
<li>Update product descriptions</li>
<li>Discontinue products or services</li>
</ul>
',
                    ],

                    [
                        'id' => 'payment-methods',
                        'title' => '8. Payment Methods',
                        'gist' => 'Payments are handled by secure third-party payment gateways.',
                        'body' => '
<p>Payments on ExtechStudio.xyz are processed through secure third-party payment gateways.</p>

<p>Accepted payment methods may include:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Online Banking (FPX)</li>
<li>E-Wallet</li>
<li>Debit / Credit Card</li>
<li>Other supported payment gateways</li>
</ul>

<p>ExtechStudio.xyz does not store sensitive payment information.</p>
',
                    ],

                    [
                        'id' => 'fraud',
                        'title' => '9. Fraud & Abuse',
                        'gist' => 'Suspicious orders may be cancelled or blocked.',
                        'body' => '
<p>ExtechStudio.xyz reserves the right to:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Cancel suspicious orders</li>
<li>Suspend user accounts</li>
<li>Block fraudulent transactions</li>
</ul>

<p>If fraud, chargeback abuse, or suspicious activities are detected, we may take necessary action including account suspension and reporting to relevant authorities.</p>
',
                    ],

                    [
                        'id' => 'illegal-use',
                        'title' => '10. Illegal Use',
                        'gist' => 'Illegal or unauthorized use of services is prohibited.',
                        'body' => '
<p>Customers are strictly prohibited from using the services or products purchased from ExtechStudio.xyz for:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Illegal activities</li>
<li>Fraudulent activities</li>
<li>Unauthorized resale</li>
<li>Money laundering</li>
</ul>

<p>ExtechStudio.xyz will not be responsible for any illegal activities conducted by customers.</p>
',
                    ],

                    [
                        'id' => 'liability',
                        'title' => '11. Limitation of Liability',
                        'gist' => 'Responsibility ends once the product is delivered.',
                        'body' => '
<p>ExtechStudio.xyz shall not be liable for any:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Indirect losses</li>
<li>Financial losses</li>
<li>Service provider issues</li>
<li>Network delays</li>
<li>Game publisher system issues</li>
<li>Mobile operator issues</li>
</ul>

<p>Once the digital product has been successfully delivered, ExtechStudio.xyz\'s responsibility is considered fulfilled.</p>
',
                    ],

                    [
                        'id' => 'account-security',
                        'title' => '12. Account Security',
                        'gist' => 'Customers must protect their account credentials.',
                        'body' => '
<p>Customers are responsible for maintaining the confidentiality of their account information.</p>

<p>ExtechStudio.xyz will not be liable for unauthorized access resulting from:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Weak passwords</li>
<li>Account sharing</li>
<li>User negligence</li>
</ul>
',
                    ],

                    [
                        'id' => 'changes',
                        'title' => '13. Changes to Terms',
                        'gist' => 'These terms may be updated at any time.',
                        'body' => '
<p>ExtechStudio.xyz reserves the right to update or modify these Terms & Conditions at any time.</p>

<p>Changes will take effect immediately upon being posted on the website.</p>
',
                    ],

                    [
                        'id' => 'contact',
                        'title' => '14. Contact Information',
                        'gist' => 'Contact us for support or inquiries.',
                        'body' => '
<p>For support or inquiries, please contact:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Email: cs.extechstudio@gmail.com</li>
<li>WhatsApp: 011-5689 8898</li>
</ul>
',
                    ],
                ];
            @endphp

            @foreach ($sections as $sec)
                <div id="{{ $sec['id'] }}"
                    class="scroll-mt-24 bg-white border border-gray-100 rounded-[2rem] p-8 shadow-sm group hover:border-[#15A5ED]/30 transition-colors">
                    <div class="flex flex-col md:flex-row md:items-start gap-6">
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $sec['title'] }}</h3>

                            {{-- The Gist Badge --}}
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-[#f7f7f9] border border-gray-100 mb-4">
                                <span class="text-[10px] font-black uppercase text-[#15A5ED]">The Gist:</span>
                                <span class="text-xs font-medium text-gray-600">{{ $sec['gist'] }}</span>
                            </div>

                            <div class="text-sm text-gray-500 leading-relaxed space-y-3">
                                {!! $sec['body'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Acceptance Footer --}}
            <div class="bg-gray-900 rounded-[2rem] p-8 text-center text-white shadow-xl">
                <h3 class="text-lg font-bold mb-2">Questions about our Terms?</h3>
                <p class="text-gray-400 text-sm mb-6">
                    If something isn't clear, we're happy to explain our policies further.
                </p>
                <a href="https://wa.me/601156898898"
                    class="inline-flex items-center justify-center px-8 py-3 rounded-xl bg-[#15A5ED] text-white font-bold hover:bg-[#0E8CCB] transition-all">
                    Contact Legal Support
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
