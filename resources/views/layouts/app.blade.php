<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ecommerce') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
    <meta name="theme-color" content="#111111">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Extech Studio">
    <link rel="apple-touch-icon" href="{{ asset('icons/icon-192.png') }}">
</head>

<body class="font-sans antialiased bg-black text-gray-200">
    <div class="min-h-screen bg-black">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-black/95 border-b border-white/10">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    {{-- Global Footer --}}
    {{-- <footer class="relative overflow-hidden bg-black border-t border-white/10"> --}}
    <footer
        class="relative overflow-hidden border-t border-white/10
           bg-gradient-to-br from-black via-[#0B1F2E] to-[#0E2A3F] pb-[92px] sm:pb-0">

        <div class="relative max-w-7xl5 mx-auto px-6 lg:px-12 py-16 lg:py-20">

            {{-- Top Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-y-12 lg:gap-y-0 lg:gap-x-12">

                {{-- Brand --}}
                <div class="lg:col-span-4">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('images/logo/extechstudio-white-logo.png') }}"
                            alt="Extech Studio - Premium Essentials" class="h-12 w-auto object-contain" />
                    </div>

                    <p class="text-sm text-gray-400 leading-relaxed max-w-sm">
                        We curate premium-quality essentials designed to elevate the modern Malaysian lifestyle.
                        Every product is thoughtfully selected with a focus on craftsmanship, functionality, and
                        timeless design.
                    </p>

                    {{-- Small brand badge --}}
                    <div class="mt-6">
                        <span
                            class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest
                               text-[#15A5ED] bg-white/5 border border-[#15A5ED]/25 px-3 py-1 rounded-full">
                            Malaysia • Crafted with care
                        </span>
                    </div>
                </div>

                {{-- Explore --}}
                <div class="lg:col-span-2 lg:col-start-5">
                    <h4 class="text-white font-extrabold text-sm uppercase tracking-wider">
                        Explore
                    </h4>
                    <div class="h-px w-10 bg-white/15 mt-4 mb-6"></div>

                    @php
                        $links = [
                            ['label' => 'Shop All', 'route' => 'shop.index'],
                            ['label' => 'How to order', 'route' => 'how-to-order'],
                            ['label' => 'FAQ', 'route' => 'faq'],
                            ['label' => 'Verify Agents', 'route' => 'agents.index'],
                        ];
                    @endphp

                    <ul class="space-y-4">
                        @foreach ($links as $item)
                            <li>
                                <a href="{{ route($item['route']) }}"
                                    class="text-sm text-gray-400 hover:text-white transition relative inline-block
                          after:content-[''] after:absolute after:left-0 after:-bottom-1
                          after:h-px after:w-0 after:bg-[#15A5ED] hover:after:w-full
                          after:transition-all after:duration-300">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Support --}}
                <div class="lg:col-span-2">
                    <h4 class="text-white font-extrabold text-sm uppercase tracking-wider">
                        Support
                    </h4>
                    <div class="h-px w-10 bg-white/15 mt-4 mb-6"></div>

                    <ul class="space-y-4">
                        @php
                            $supportLinks = [
                                ['label' => 'Privacy Policy', 'route' => 'privacy-policy'],
                                ['label' => 'Terms & Conditions', 'route' => 'terms'],
                                ['label' => 'Shipping & Delivery', 'route' => 'shipping'],
                                ['label' => 'Returns & Refunds', 'route' => 'returns'],
                            ];
                        @endphp

                        @foreach ($supportLinks as $item)
                            <li>
                                <a href="{{ route($item['route']) }}"
                                    class="text-sm text-gray-400 hover:text-white transition relative inline-block
                          after:content-[''] after:absolute after:left-0 after:-bottom-1
                          after:h-px after:w-0 after:bg-[#15A5ED] hover:after:w-full
                          after:transition-all after:duration-300">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Account --}}
                <div class="lg:col-span-2">
                    <h4 class="text-white font-extrabold text-sm uppercase tracking-wider">
                        Account
                    </h4>
                    <div class="h-px w-10 bg-white/15 mt-4 mb-6"></div>

                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('account.index') }}"
                                class="text-sm text-gray-400 hover:text-white transition relative inline-block
                                  after:content-[''] after:absolute after:left-0 after:-bottom-1
                                  after:h-px after:w-0 after:bg-[#15A5ED] hover:after:w-full
                                  after:transition-all after:duration-300">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('account.orders.index') }}"
                                class="text-sm text-gray-400 hover:text-white transition relative inline-block
                                  after:content-[''] after:absolute after:left-0 after:-bottom-1
                                  after:h-px after:w-0 after:bg-[#15A5ED] hover:after:w-full
                                  after:transition-all after:duration-300">
                                My Order
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('account.favorites.index') }}"
                                class="text-sm text-gray-400 hover:text-white transition relative inline-block
                                  after:content-[''] after:absolute after:left-0 after:-bottom-1
                                  after:h-px after:w-0 after:bg-[#15A5ED] hover:after:w-full
                                  after:transition-all after:duration-300">
                                My Wishlist
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('account.referral.index') }}"
                                class="text-sm text-gray-400 hover:text-white transition relative inline-block
                                  after:content-[''] after:absolute after:left-0 after:-bottom-1
                                  after:h-px after:w-0 after:bg-[#15A5ED] hover:after:w-full
                                  after:transition-all after:duration-300">
                                Referral Center
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('account.address.index') }}"
                                class="text-sm text-gray-400 hover:text-white transition relative inline-block
                                  after:content-[''] after:absolute after:left-0 after:-bottom-1
                                  after:h-px after:w-0 after:bg-[#15A5ED] hover:after:w-full
                                  after:transition-all after:duration-300">
                                Shipping Addresses
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('account.profile.edit') }}"
                                class="text-sm text-gray-400 hover:text-white transition relative inline-block
                                  after:content-[''] after:absolute after:left-0 after:-bottom-1
                                  after:h-px after:w-0 after:bg-[#15A5ED] hover:after:w-full
                                  after:transition-all after:duration-300">
                                Profile Settings
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Social Media --}}
                <div class="lg:col-span-2">
                    <h4 class="text-white font-extrabold text-sm uppercase tracking-wider">
                        Social Media
                    </h4>
                    <div class="h-px w-10 bg-white/15 mt-4 mb-6"></div>

                    <ul class="space-y-4">
                        <li>
                            <a href="#"
                                class="text-sm text-gray-400 hover:text-white transition relative inline-block
                                  after:content-[''] after:absolute after:left-0 after:-bottom-1
                                  after:h-px after:w-0 after:bg-[#15A5ED] hover:after:w-full
                                  after:transition-all after:duration-300">
                                Instagram
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/share/1CZuN9UAqd/?mibextid=wwXIfr"
                                class="text-sm text-gray-400 hover:text-white transition relative inline-block
                                  after:content-[''] after:absolute after:left-0 after:-bottom-1
                                  after:h-px after:w-0 after:bg-[#15A5ED] hover:after:w-full
                                  after:transition-all after:duration-300">
                                Facebook
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/601156898898"
                                class="text-sm text-gray-400 hover:text-white transition relative inline-block
                                  after:content-[''] after:absolute after:left-0 after:-bottom-1
                                  after:h-px after:w-0 after:bg-[#15A5ED] hover:after:w-full
                                  after:transition-all after:duration-300">
                                WhatsApp Support
                            </a>
                        </li>

                        <li class="text-sm text-gray-500">
                            <a href="mailto:cs.extechstudio@gmail.com" class="hover:text-gray-300 transition">
                                cs.extechstudio@gmail.com
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

            {{-- Bottom Bar --}}
            <div
                class="mt-14 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4">

                <p class="text-sm text-gray-500 font-medium text-center md:text-left">
                    © {{ date('Y') }} Extech Studio. All rights reserved.
                </p>

                <div class="flex flex-col items-center md:flex-row md:items-center gap-3 md:gap-4">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                        Secure Payments
                    </span>

                    <div
                        class="flex flex-wrap justify-center md:justify-start items-center gap-4 max-w-xs md:max-w-none">
                        <img src="/images/payments/fpx.png" alt="FPX" class="h-6 transition" />
                        <img src="/images/payments/visa.png" alt="Visa" class="h-6 transition" />
                        <img src="/images/payments/mastercard.png" alt="Mastercard" class="h-6 transition" />
                        <img src="/images/payments/shopeepay.png" alt="ShopeePay" class="h-6 transition" />
                        <img src="/images/payments/spaylater.png" alt="SPayLater" class="h-6 transition" />
                        <img src="/images/payments/grabpay.png" alt="GrabPay" class="h-6 transition" />
                        <img src="/images/payments/grabpaylater.png" alt="GrabPayLater" class="h-6 transition" />
                        <img src="/images/payments/tng.png" alt="TNG" class="h-6 transition" />
                        <img src="/images/payments/alipay.png" alt="Alipay" class="h-6 transition" />
                    </div>
                </div>
            </div>


        </div>
    </footer>

    {{-- Back to Top Button --}}
    <button id="backToTopBtn"
        class="hidden fixed right-4 bottom-24 z-50
           w-12 h-12 rounded-full
           bg-[#15A5ED] text-white
           flex items-center justify-center
           shadow-lg shadow-[#15A5ED]/40
           hover:bg-[#6DBAE1] transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    <a href="https://wa.me/601156898898" target="_blank"
        class="hidden sm:flex fixed right-4 bottom-4 z-50
          w-12 h-12 rounded-full
          bg-[#25D366] text-white
          items-center justify-center
          shadow-lg shadow-[#25D366]/40
          hover:bg-[#1DA851] transition-all duration-300 animate-bounce">

        <!-- WhatsApp Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
            class="bi bi-whatsapp" viewBox="0 0 16 16">
            <path
                d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
        </svg>
    </a>

    <div id="pwa-install-banner"
        style="
    display:none;
    position:fixed;
    left:16px;
    right:16px;
    bottom:16px;
    z-index:9999;
    background:#111;
    color:#fff;
    border-radius:16px;
    padding:16px;
    box-shadow:0 8px 24px rgba(0,0,0,.2);
">
        <div style="display:flex;justify-content:space-between;align-items:start;gap:12px;">
            <div>
                <div style="font-size:16px;font-weight:700;">Install Extech Studio</div>
                <div style="font-size:14px;opacity:.9;margin-top:4px;">
                    Add this app to your home screen for faster access.
                </div>
            </div>
            <button id="pwa-close-btn"
                style="
            background:transparent;
            border:none;
            color:#fff;
            font-size:20px;
            cursor:pointer;
        ">&times;</button>
        </div>

        <div style="display:flex;gap:8px;margin-top:14px;">
            <button id="pwa-install-btn"
                style="
            background:#fff;
            color:#111;
            border:none;
            border-radius:10px;
            padding:10px 14px;
            font-weight:600;
            cursor:pointer;
        ">
                Install
            </button>

            <button id="pwa-later-btn"
                style="
            background:transparent;
            color:#fff;
            border:1px solid rgba(255,255,255,.3);
            border-radius:10px;
            padding:10px 14px;
            cursor:pointer;
        ">
                Later
            </button>
        </div>
    </div>

    <div id="ios-install-tip"
        style="
    display:none;
    position:fixed;
    left:16px;
    right:16px;
    bottom:16px;
    z-index:9999;
    background:#111;
    color:#fff;
    border-radius:16px;
    padding:16px;
">
        <div style="font-weight:700;">Install Extech Studio</div>
        <div style="font-size:14px;margin-top:6px;">
            On iPhone: tap <strong>Share</strong> then <strong>Add to Home Screen</strong>.
        </div>
        <button id="ios-tip-close"
            style="
        margin-top:12px;
        background:#fff;
        color:#111;
        border:none;
        border-radius:10px;
        padding:10px 14px;
        cursor:pointer;
    ">OK</button>
    </div>

    <script>
        function refreshCartCount() {
            console.log('Refreshing cart count…');
            const badge = document.querySelector('[data-cart-count]');
            if (!badge) return;

            fetch("{{ route('cart.count') }}", {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (typeof data.count !== 'undefined') {
                        badge.textContent = data.count;
                    }
                })
                .catch(() => {});
        }

        document.addEventListener('DOMContentLoaded', refreshCartCount);

        window.addEventListener('pageshow', function(event) {
            const navEntries = performance.getEntriesByType('navigation');
            const navType = navEntries[0] ? navEntries[0].type : null;

            if (event.persisted || navType === 'back_forward') {
                refreshCartCount();
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btn = document.getElementById("backToTopBtn");

            window.addEventListener("scroll", () => {
                if (window.scrollY > 300) {
                    btn.classList.remove("hidden");
                } else {
                    btn.classList.add("hidden");
                }
            });

            btn.addEventListener("click", () => {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });
        });
    </script>

    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2500)" x-show="show"
            x-transition:enter="transform ease-out duration-300" x-transition:enter-start="translate-y-10 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="transform ease-in duration-200"
            x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-10 opacity-0"
            class="fixed bottom-[80px] left-1/2 -translate-x-1/2 z-[9999]">

            <div
                class="flex items-center gap-3 bg-black text-white px-5 py-3 rounded-full shadow-[0_10px_30px_rgba(0,0,0,0.4)]">

                {{-- Green dot --}}
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>

                {{-- Text --}}
                <span class="text-sm font-medium">
                    {{ session('success') }}
                </span>

            </div>
        </div>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Notice',
                text: {!! json_encode(session('info')) !!},
                confirmButtonColor: '#15A5ED'
            });
        </script>
    @endif

    @stack('scripts')

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('{{ asset('sw.js') }}')
                    .then(reg => console.log('SW registered', reg))
                    .catch(err => console.log('SW failed', err));
            });
        }
    </script>

    <script>
        let deferredPrompt = null;

        const installBanner = document.getElementById('pwa-install-banner');
        const installBtn = document.getElementById('pwa-install-btn');
        const closeBtn = document.getElementById('pwa-close-btn');
        const laterBtn = document.getElementById('pwa-later-btn');

        function isStandalone() {
            return window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;
        }

        function hideBanner() {
            installBanner.style.display = 'none';
        }

        function showBanner() {
            if (!isStandalone()) {
                installBanner.style.display = 'block';
            }
        }

        function dismissForDays(days = 3) {
            const until = Date.now() + days * 24 * 60 * 60 * 1000;
            localStorage.setItem('pwa_install_dismiss_until', String(until));
        }

        function canShowAgain() {
            const until = localStorage.getItem('pwa_install_dismiss_until');
            if (!until) return true;
            return Date.now() > Number(until);
        }

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;

            if (canShowAgain() && !isStandalone()) {
                showBanner();
            }
        });

        installBtn?.addEventListener('click', async () => {
            if (!deferredPrompt) return;

            deferredPrompt.prompt();

            const choiceResult = await deferredPrompt.userChoice;
            console.log('Install choice:', choiceResult.outcome);

            deferredPrompt = null;
            hideBanner();
        });

        closeBtn?.addEventListener('click', () => {
            dismissForDays(7);
            hideBanner();
        });

        laterBtn?.addEventListener('click', () => {
            dismissForDays(3);
            hideBanner();
        });

        window.addEventListener('appinstalled', () => {
            console.log('PWA installed');
            hideBanner();
            deferredPrompt = null;
        });
    </script>

    <script>
        function isIos() {
            return /iphone|ipad|ipod/i.test(window.navigator.userAgent);
        }

        function isInStandaloneMode() {
            return ('standalone' in window.navigator) && window.navigator.standalone;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const iosTip = document.getElementById('ios-install-tip');
            const iosTipClose = document.getElementById('ios-tip-close');

            if (isIos() && !isInStandaloneMode()) {
                const hidden = localStorage.getItem('ios_install_tip_closed');
                if (!hidden) {
                    iosTip.style.display = 'block';
                }
            }

            iosTipClose?.addEventListener('click', () => {
                iosTip.style.display = 'none';
                localStorage.setItem('ios_install_tip_closed', '1');
            });
        });
    </script>
</body>

</html>
