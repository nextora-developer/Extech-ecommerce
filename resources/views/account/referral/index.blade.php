<x-app-layout>
    <div class="bg-[#F8FAFC] min-h-screen py-6 md:py-10">
        <div class="max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb: Hidden on very small screens to save space --}}
            
             <nav class="hidden sm:flex items-center uppercase space-x-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-[#15a5ed] transition-colors">Home</a>

                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>

                <span class="text-gray-900 font-medium">Referral Center</span>
            </nav>

            <div class="sm:hidden flex items-center justify-center relative mb-6">
                {{-- Back Button --}}
                <a href="{{ route('home') }}" class="absolute left-0 p-2 text-gray-500 hover:text-[#15A5ED] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>

                {{-- Title --}}
                <h1 class="text-lg font-bold text-gray-900">
                    Referral Center
                </h1>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                {{-- Sidebar: Responsive visibility --}}
                <aside class="hidden lg:block lg:col-span-1">
                    <div class="sticky top-8">
                        @include('account.partials.sidebar')
                    </div>
                </aside>

                <main class="lg:col-span-3 space-y-6 md:space-y-8">

                    {{-- Commission Stats Cards --}}
                    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                        <div
                            class="group relative bg-white rounded-3xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-200/50 border border-gray-50">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-yellow-50 to-orange-50 text-yellow-600 flex items-center justify-center transition-transform group-hover:scale-110">

                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>

                                </div>
                            </div>

                            <h3 class="text-[11px] font-bold uppercase tracking-widest text-gray-400">
                                Current Points
                            </h3>

                            <div class="flex items-baseline gap-1 mt-1">
                                <span class="text-3xl font-black text-gray-900">
                                    {{ number_format($stats['current_points'], 2) }}
                                </span>
                                <span class="text-sm font-bold text-gray-400">PTS</span>
                            </div>
                        </div>
                        <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
                            <div
                                class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Total Points Earn
                            </p>
                            <div class="text-2xl font-black text-gray-900 mt-1">
                                {{ number_format($stats['total_earned_points'], 2) }}</div>
                        </div>

                        <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
                            <div
                                class="w-10 h-10 rounded-xl bg-green-50 text-green-500 flex items-center justify-center mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Successful Orders
                            </p>
                            <div class="text-2xl font-black text-gray-900 mt-1">{{ $stats['successful_orders'] }}</div>
                        </div>

                        <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
                            <div
                                class="w-10 h-10 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Current Rate</p>
                            <div class="text-2xl font-black text-gray-900 mt-1">
                                {{ number_format($stats['commission_percent'], 2) }}%</div>
                        </div>
                    </section>

                    {{-- Referral Assets: Added Copy Functionality --}}
                    <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Code Card --}}
                        <div
                            class="group bg-white rounded-3xl border border-gray-100 shadow-sm p-6 transition-all hover:shadow-md">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-4">Your Referral
                                Code</p>
                            <div
                                class="flex items-center justify-between bg-gray-50 rounded-2xl p-4 border border-dashed border-gray-200 group-hover:border-[#15A5ED]/30 transition-colors">
                                <span class="text-2xl font-black text-gray-900 tracking-widest uppercase"
                                    id="refCode">{{ $agent->referral_code }}</span>
                                <button onclick="copyToClipboard('{{ $agent->referral_code }}', this)"
                                    class="p-2 hover:bg-white rounded-xl transition-all text-gray-400 hover:text-[#15A5ED]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Link Card --}}
                        <div
                            class="group bg-white rounded-3xl border border-gray-100 shadow-sm p-6 transition-all hover:shadow-md">
                            <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-4">Quick Share
                                Link</p>
                            <div class="flex items-center gap-3 bg-gray-50 rounded-2xl p-4 border border-gray-200">
                                <span
                                    class="text-sm font-semibold text-gray-600 truncate flex-1">{{ $referralLink }}</span>
                                <button onclick="copyToClipboard('{{ $referralLink }}', this)"
                                    class="shrink-0 px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-700 hover:bg-[#15A5ED] hover:text-white hover:border-[#15A5ED] transition-all">
                                    Copy Link
                                </button>
                            </div>
                        </div>
                    </section>

                    {{-- Data Lists --}}
                    <div class="space-y-8">
                        {{-- Referred Users --}}
                        <section>
                            <h2 class="text-xl font-black text-gray-900 mb-5 px-2 flex items-center gap-3">
                                <span class="w-2 h-8 bg-[#15A5ED] rounded-full"></span>
                                Referred Users
                            </h2>
                            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                                @forelse ($referredUsers as $referredUser)
                                    <div
                                        class="px-6 py-5 border-b border-gray-50 last:border-b-0 hover:bg-gray-50/50 transition-colors">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-[#15A5ED]/10 text-[#15A5ED] flex items-center justify-center font-bold text-sm">
                                                    {{ strtoupper(substr($referredUser->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-gray-900">
                                                        {{ $referredUser->name }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $referredUser->created_at->format('M d, Y') }}</div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-sm font-black text-gray-900">
                                                    {{ $referredUser->orders_count ?? 0 }}</div>
                                                <div
                                                    class="text-[10px] uppercase font-bold text-gray-400 tracking-tighter">
                                                    Orders</div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-16 text-center">
                                        <p class="text-gray-400 font-medium">No friends referred yet.</p>
                                    </div>
                                @endforelse
                            </div>
                        </section>

                        {{-- Commission History --}}
                        <section>
                            <h2 class="text-xl font-black text-gray-900 mb-5 px-2 flex items-center gap-3">
                                <span class="w-2 h-8 bg-[#15A5ED] rounded-full"></span>
                                Commission History
                            </h2>

                            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">

                                {{-- Desktop Header --}}
                                <div
                                    class="hidden md:grid grid-cols-4 px-8 py-4 bg-gray-50 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                                    <span>Order Info</span>
                                    <span>Subtotal</span>
                                    <span>Rate</span>
                                    <span class="text-right">Points Earned</span>
                                </div>

                                @forelse ($commissions as $commission)
                                    {{-- Mobile Card --}}
                                    <div class="md:hidden px-4 py-4 border-b border-gray-50 last:border-b-0">
                                        <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
                                            <div class="flex items-start justify-between gap-4">
                                                <div>
                                                    <div class="text-sm font-bold text-gray-900">
                                                        #{{ $commission->order->order_no ?? $commission->order_id }}
                                                    </div>
                                                    <div class="text-[10px] text-gray-400 uppercase font-medium mt-1">
                                                        {{ optional($commission->credited_at)->format('d M, Y') }}
                                                    </div>
                                                </div>

                                                <div class="text-right">
                                                    <div class="text-lg font-black text-[#15A5ED] leading-none">
                                                        +{{ number_format($commission->points_awarded, 2) }}
                                                    </div>
                                                    <div
                                                        class="text-[10px] uppercase tracking-wider text-gray-400 mt-1">
                                                        Points Earned
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4 grid grid-cols-2 gap-3">
                                                <div class="rounded-xl bg-gray-50 px-3 py-2">
                                                    <div
                                                        class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                                        Subtotal
                                                    </div>
                                                    <div class="mt-1 text-sm font-bold text-gray-800">
                                                        RM {{ number_format($commission->order_subtotal, 2) }}
                                                    </div>
                                                </div>

                                                <div class="rounded-xl bg-gray-50 px-3 py-2">
                                                    <div
                                                        class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                                        Rate
                                                    </div>
                                                    <div class="mt-1 text-sm font-bold text-gray-800">
                                                        {{ number_format($commission->commission_percent, 1) }}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Desktop Row --}}
                                    <div
                                        class="hidden md:block px-6 md:px-8 py-5 border-b border-gray-50 last:border-b-0 hover:bg-gray-50/50 transition-colors">
                                        <div class="grid grid-cols-4 items-center gap-4">
                                            <div>
                                                <div class="text-sm font-bold text-gray-900">
                                                    #{{ $commission->order->order_no ?? $commission->order_id }}
                                                </div>
                                                <div class="text-[10px] text-gray-400 uppercase font-medium">
                                                    {{ optional($commission->credited_at)->format('d M, Y') }}
                                                </div>
                                            </div>

                                            <div class="text-sm font-bold text-gray-600">
                                                RM {{ number_format($commission->order_subtotal, 2) }}
                                            </div>

                                            <div class="text-sm font-bold text-gray-600">
                                                {{ number_format($commission->commission_percent, 1) }}%
                                            </div>

                                            <div class="text-right text-sm font-black text-[#15A5ED]">
                                                +{{ number_format($commission->points_awarded, 2) }}
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <div class="p-10 md:p-16 text-center text-gray-400">
                                        No records found.
                                    </div>
                                @endforelse
                            </div>
                        </section>
                    </div>
                </main>
            </div>
        </div>
    </div>

    {{-- Tiny JS for the copy functionality --}}
    <script>
        function copyToClipboard(text, btn) {
            // 优先用现代 API
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text)
                    .then(() => showCopied(btn))
                    .catch(() => fallbackCopy(text, btn));
            } else {
                fallbackCopy(text, btn);
            }
        }

        // fallback（超重要）
        function fallbackCopy(text, btn) {
            const textarea = document.createElement("textarea");
            textarea.value = text;
            textarea.style.position = "fixed";
            textarea.style.opacity = "0";
            document.body.appendChild(textarea);
            textarea.focus();
            textarea.select();

            try {
                document.execCommand('copy');
                showCopied(btn);
            } catch (err) {
                showError(btn);
            }

            document.body.removeChild(textarea);
        }

        // 成功 UI
        function showCopied(btn) {
            const original = btn.innerHTML;
            btn.innerHTML = "✔ Copied";
            btn.classList.add("text-green-500");

            setTimeout(() => {
                btn.innerHTML = original;
                btn.classList.remove("text-green-500");
            }, 2000);
        }

        // 失败 UI
        function showError(btn) {
            const original = btn.innerHTML;
            btn.innerHTML = "✖ Failed";
            btn.classList.add("text-red-500");

            setTimeout(() => {
                btn.innerHTML = original;
                btn.classList.remove("text-red-500");
            }, 2000);
        }
    </script>
</x-app-layout>
