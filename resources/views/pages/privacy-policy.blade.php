<x-app-layout>
    @section('title', $title ?? 'Privacy Policy')

    <section class="bg-[#f7f7f9] min-h-screen pb-20">
        {{-- Header --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                <h2 class="text-xs font-bold uppercase tracking-[0.3em] text-[#15A5ED] mb-3">Legal & Transparency</h2>
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 tracking-tight mb-4">Privacy Policy</h1>
                <p class="text-base text-gray-500 max-w-2xl mx-auto leading-relaxed">
                    We value your trust. This policy explains how we collect, use, and protect your personal information
                    in plain, easy-to-understand language.
                </p>
                <p class="mt-6 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    Last Updated: January 2026
                </p>

                {{-- Fast Navigation --}}
                <div class="mt-10 flex flex-wrap items-center justify-center gap-3">
                    @foreach ([['id' => 'overview', 'label' => 'Overview', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'], ['id' => 'data', 'label' => 'Data Collection', 'icon' => 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4'], ['id' => 'use', 'label' => 'Usage', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'], ['id' => 'security', 'label' => 'Security', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z']] as $j)
                        <a href="#{{ $j['id'] }}"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-white border border-gray-100 shadow-sm
                                  text-xs font-bold text-gray-700 hover:border-[#15A5ED]/60 hover:text-[#15A5ED] transition-all group">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-[#15A5ED]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $j['icon'] }}" />
                            </svg>
                            {{ $j['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">

            {{-- Section: Overview --}}
            <div id="overview" class="scroll-mt-24 relative pl-8 group">
                <div
                    class="absolute left-0 top-0 bottom-0 w-1 bg-gray-100 group-hover:bg-[#15A5ED] transition-colors rounded-full">
                </div>
                <h3 class="text-2xl font-bold text-gray-900">1. Overview</h3>
                <div class="mt-4 prose prose-sm text-gray-600 max-w-none leading-relaxed">
                    <p>We respect your privacy and are committed to protecting your personal data. This policy applies
                        to all services provided through our website and outlines your rights under data protection
                        laws.</p>
                </div>
            </div>

            {{-- Section: Data Collection --}}
            <div id="data" class="scroll-mt-24 bg-white border border-gray-100 rounded-[2.5rem] p-8 shadow-sm">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-2xl bg-[#EAF6FF] flex items-center justify-center text-[#15A5ED]">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">2. Data We Collect</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ([['t' => 'Identity Data', 'd' => 'First name, last name, and usernames.'], ['t' => 'Contact Data', 'd' => 'Email address, phone number, and delivery addresses.'], ['t' => 'Transaction Data', 'd' => 'Details about payments and products purchased.'], ['t' => 'Technical Data', 'd' => 'IP address, browser type, and device information.']] as $item)
                        <div class="p-4 rounded-2xl bg-[#f7f7f9] border border-gray-50">
                            <h4 class="text-sm font-bold text-gray-900 mb-1">{{ $item['t'] }}</h4>
                            <p class="text-xs text-gray-500 leading-relaxed">{{ $item['d'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Section: Usage --}}
            <div id="use" class="scroll-mt-24 relative pl-8 group">
                <div
                    class="absolute left-0 top-0 bottom-0 w-1 bg-gray-100 group-hover:bg-[#15A5ED] transition-colors rounded-full">
                </div>
                <h3 class="text-2xl font-bold text-gray-900">3. How We Use Data</h3>
                <ul class="mt-6 space-y-4">
                    @foreach (['To process and deliver your orders.', 'To manage our relationship with you (e.g., support requests).', 'To use data analytics to improve our website and marketing.', 'To protect our business and this website from fraud.'] as $list)
                        <li class="flex items-start gap-3 text-sm text-gray-600">
                            <span
                                class="mt-1 flex-shrink-0 w-5 h-5 rounded-full bg-green-50 text-green-600 flex items-center justify-center">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            {{ $list }}
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Section: Security --}}
            <div id="security" class="scroll-mt-24 bg-gray-900 rounded-[2.5rem] p-8 text-white shadow-xl">
                <h3 class="text-2xl font-bold mb-4">4. Security & Protection</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    We have put in place appropriate security measures to prevent your personal data from being
                    accidentally lost, used, or accessed in an unauthorized way.
                </p>

                <div class="flex items-center gap-2 text-[#15A5ED] font-bold text-xs uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    End-to-End Encryption Enabled
                </div>
            </div>

            {{-- Contact Call-to-Action --}}
            <div id="contact" class="scroll-mt-24 rounded-3xl border-2 border-dashed border-gray-200 p-8 text-center">
                <h3 class="text-xl font-bold text-gray-900">Still have questions?</h3>
                <p class="text-sm text-gray-500 mt-2 mb-6">
                    Our data protection officer is ready to help you with any privacy concerns.
                </p>
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="https://wa.me/601156898898" target="_blank"
                        class="inline-flex items-center justify-center px-6 py-3 rounded-2xl bg-gray-900 text-white text-sm font-bold hover:bg-black transition-all shadow-lg">
                        Chat via WhatsApp
                    </a>
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
