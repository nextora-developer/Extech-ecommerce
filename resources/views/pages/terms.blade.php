<x-app-layout>
    @section('title', $title ?? 'Terms & Conditions')

    <section class="bg-[#f7f7f9] min-h-screen pb-20">
        {{-- Header --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                <h2 class="text-xs font-bold uppercase tracking-[0.4em] text-[#15A5ED] mb-3">Agreement</h2>
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 tracking-tight mb-4">Terms & Conditions</h1>
                <p class="text-base text-gray-500 max-w-2xl mx-auto leading-relaxed">
                    Please read these terms carefully before using our website or placing an order. By accessing our
                    services, purchasing from our store, or submitting an order, you agree to be bound by the terms below.
                </p>

                {{-- Anchor Navigation --}}
                <div class="mt-10 flex flex-wrap items-center justify-center gap-2">
                    @php
                        $nav = [
                            ['id' => 'introduction', 'label' => 'Introduction'],
                            ['id' => 'digital-product', 'label' => 'Digital Services'],
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
                        'gist' => 'These terms govern the use of our website, digital products, and related services.',
                        'body' => '
<p>Welcome to ExtechStudio.xyz.</p>

<p>These Terms & Conditions govern your use of our website and services. By accessing, browsing, or purchasing from this website, you agree to be legally bound by these terms.</p>

<p>ExtechStudio.xyz provides digital products and services including but not limited to:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Website services</li>
<li>Website maintenance services</li>
<li>Custom web solutions</li>
<li>Game top up / game credits</li>
<li>Software licenses</li>
<li>Other digital services and products</li>
</ul>

<p>Unless otherwise stated, our products and services are delivered digitally or fulfilled electronically.</p>
',
                    ],

                    [
                        'id' => 'digital-product',
                        'title' => '2. Digital Product & Service Nature',
                        'gist' => 'Most products and services on this website are digital and do not involve physical delivery.',
                        'body' => '
<p>Most products and services sold on ExtechStudio.xyz are digital in nature.</p>

<p>This means:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>No physical item may be shipped unless clearly stated on the product page</li>
<li>Delivery, access, activation, or service updates may be provided electronically</li>
<li>Fulfillment methods may vary depending on the product or service purchased</li>
</ul>

<p>Depending on the order type, fulfillment may be provided through:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Email</li>
<li>Customer dashboard or account area</li>
<li>Direct communication from our team</li>
<li>License key delivery</li>
<li>Project discussion and service fulfillment process</li>
</ul>
',
                    ],

                    [
                        'id' => 'order-processing',
                        'title' => '3. Order Processing',
                        'gist' => 'Orders may be processed automatically or manually, depending on the product or service type.',
                        'body' => '
<p>Orders may be processed instantly, within a short time, or according to the workflow required for the purchased service.</p>

<p>Some orders may require manual review, project confirmation, or additional customer information before fulfillment can begin.</p>

<p>Processing time may vary due to:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Payment verification</li>
<li>Order complexity</li>
<li>Missing customer information</li>
<li>Manual review or approval</li>
<li>Third-party supplier or provider response time</li>
<li>System maintenance or temporary downtime</li>
</ul>

<p>ExtechStudio.xyz does not guarantee that every order will be completed instantly.</p>
',
                    ],

                    [
                        'id' => 'customer-responsibility',
                        'title' => '4. Customer Responsibility',
                        'gist' => 'Customers must provide complete and accurate information when placing an order.',
                        'body' => '
<p>Customers are responsible for ensuring that all information submitted during checkout or project submission is accurate, complete, and up to date.</p>

<p>This may include:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Correct email address</li>
<li>Correct game ID, user ID, server, or account details</li>
<li>Correct software or license requirements</li>
<li>Correct business or project details for website services</li>
<li>Any files, content, or requirements necessary for service fulfillment</li>
</ul>

<p>If incorrect, incomplete, or misleading information is provided, ExtechStudio.xyz shall not be responsible for delays, failed delivery, activation issues, or losses arising from such information.</p>

<p>Orders completed based on customer-provided information may not be reversible, cancellable, or refundable.</p>
',
                    ],

                    [
                        'id' => 'refund-policy',
                        'title' => '5. Refund Policy',
                        'gist' => 'Refunds are limited because many products and services are digital or custom in nature.',
                        'body' => '
<p>Due to the nature of digital products, software licenses, game top up, and custom service work, all purchases should be reviewed carefully before payment is made.</p>

<p><strong>As a general rule, all completed sales are final.</strong></p>

<p>Refunds, cancellations, or exchanges may not be available once:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>A digital product has been delivered</li>
<li>A software license has been issued</li>
<li>A game top up has been processed</li>
<li>A website service or project has already started</li>
<li>Work, setup, consultation, or configuration has already been performed</li>
</ul>

<p>A refund may only be considered in limited cases, such as:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Successful payment was made but the order was not delivered at all</li>
<li>The purchased item or service cannot be fulfilled by us</li>
<li>A duplicate payment is confirmed</li>
</ul>

<p>Any refund request is subject to internal review and final approval at the sole discretion of ExtechStudio.xyz.</p>
',
                    ],

                    [
                        'id' => 'service-availability',
                        'title' => '6. Service Availability',
                        'gist' => 'We aim to provide reliable service, but uninterrupted availability is not guaranteed.',
                        'body' => '
<p>ExtechStudio.xyz aims to keep its website and services available and functional. However, we do not guarantee uninterrupted access at all times.</p>

<p>Services may be temporarily unavailable, delayed, or limited due to:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Server maintenance</li>
<li>System upgrades</li>
<li>Technical issues</li>
<li>Third-party service interruptions</li>
<li>Provider or supplier downtime</li>
<li>Unexpected operational issues</li>
</ul>

<p>We reserve the right to suspend, restrict, or modify any service temporarily or permanently when necessary.</p>
',
                    ],

                    [
                        'id' => 'pricing',
                        'title' => '7. Pricing & Product Changes',
                        'gist' => 'Prices, packages, and product details may change without prior notice.',
                        'body' => '
<p>All prices shown on ExtechStudio.xyz are subject to change at any time without prior notice.</p>

<p>We reserve the right to:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Modify prices</li>
<li>Change package features</li>
<li>Update product or service descriptions</li>
<li>Revise service scope</li>
<li>Discontinue products, software, or service offerings</li>
</ul>

<p>Any pricing or product changes will not affect completed orders that have already been confirmed, unless additional work or revised requirements are requested by the customer.</p>
',
                    ],

                    [
                        'id' => 'payment-methods',
                        'title' => '8. Payment Methods',
                        'gist' => 'Payments are processed through supported payment methods and third-party payment providers.',
                        'body' => '
<p>Payments on ExtechStudio.xyz are made through the payment options available on the website at the time of checkout.</p>

<p>Accepted methods may include:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Online Banking / FPX</li>
<li>Debit Card / Credit Card</li>
<li>E-Wallet or supported digital payment methods</li>
<li>Other supported payment gateway methods</li>
</ul>

<p>We do not guarantee that every payment method will always be available.</p>

<p>ExtechStudio.xyz does not store full sensitive payment details unless expressly stated and securely handled by the appropriate payment provider.</p>
',
                    ],

                    [
                        'id' => 'fraud',
                        'title' => '9. Fraud & Abuse',
                        'gist' => 'Suspicious, abusive, or fraudulent activity may result in cancellation or account restriction.',
                        'body' => '
<p>ExtechStudio.xyz reserves the right to investigate and take action against any suspicious, abusive, or fraudulent transaction or activity.</p>

<p>We may, without prior notice:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Cancel suspicious orders</li>
<li>Delay fulfillment for verification</li>
<li>Refuse service</li>
<li>Suspend user accounts</li>
<li>Block certain transactions or customers</li>
</ul>

<p>If fraud, payment abuse, chargeback abuse, false claims, or suspicious conduct is detected, we may report the matter to relevant payment providers or authorities where necessary.</p>
',
                    ],

                    [
                        'id' => 'illegal-use',
                        'title' => '10. Illegal Use',
                        'gist' => 'Our products and services must not be used for unlawful or unauthorized purposes.',
                        'body' => '
<p>Customers are strictly prohibited from using any product or service purchased from ExtechStudio.xyz for:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Illegal activities</li>
<li>Fraudulent activities</li>
<li>Unauthorized resale where prohibited</li>
<li>Copyright infringement</li>
<li>System abuse, hacking, or malicious activity</li>
<li>Any unlawful business or personal purpose</li>
</ul>

<p>We reserve the right to refuse or terminate service where misuse is suspected.</p>
',
                    ],

                    [
                        'id' => 'liability',
                        'title' => '11. Limitation of Liability',
                        'gist' => 'Our liability is limited to the extent permitted by law.',
                        'body' => '
<p>To the fullest extent permitted by law, ExtechStudio.xyz shall not be liable for any indirect, incidental, special, or consequential loss or damage arising from the use of our website, products, or services.</p>

<p>This includes but is not limited to:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Loss of profits</li>
<li>Business interruption</li>
<li>Loss of data</li>
<li>Third-party provider failures</li>
<li>Game publisher or software vendor issues</li>
<li>Delays caused by customer inaction or missing information</li>
</ul>

<p>Where a digital product has been correctly delivered, or a service has been performed according to the order scope, our responsibility shall be considered fulfilled to that extent.</p>
',
                    ],

                    [
                        'id' => 'account-security',
                        'title' => '12. Account Security',
                        'gist' => 'Customers are responsible for protecting their own accounts and login details.',
                        'body' => '
<p>If you create an account on ExtechStudio.xyz, you are responsible for maintaining the confidentiality of your login credentials and account activity.</p>

<p>We are not responsible for unauthorized access resulting from:</p>

<ul class="list-disc pl-6 space-y-1 marker:text-gray-500">
<li>Weak passwords</li>
<li>Password sharing</li>
<li>User negligence</li>
<li>Unauthorized access to your email or personal devices</li>
</ul>

<p>You should notify us promptly if you believe your account has been compromised.</p>
',
                    ],

                    [
                        'id' => 'changes',
                        'title' => '13. Changes to Terms',
                        'gist' => 'These terms may be updated from time to time.',
                        'body' => '
<p>ExtechStudio.xyz reserves the right to update, revise, or modify these Terms & Conditions at any time.</p>

<p>Any updated version becomes effective once published on the website, unless otherwise stated.</p>

<p>It is your responsibility to review these terms periodically for changes.</p>
',
                    ],

                    [
                        'id' => 'contact',
                        'title' => '14. Contact Information',
                        'gist' => 'Contact us if you need clarification or support regarding these terms.',
                        'body' => '
<p>If you have any questions regarding these Terms & Conditions, please contact us through the details below:</p>

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
                    If anything is unclear, feel free to contact us for further clarification.
                </p>
                <a href="https://wa.me/601156898898"
                    class="inline-flex items-center justify-center px-8 py-3 rounded-xl bg-[#15A5ED] text-white font-bold hover:bg-[#0E8CCB] transition-all">
                    Contact Support
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