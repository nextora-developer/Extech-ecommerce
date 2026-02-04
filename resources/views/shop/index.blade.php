<x-app-layout>
    <div class="bg-[#F5F5F7] min-h-screen">
        <div class="max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8" x-data="{ mobileFilterOpen: false }">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900">Shop</h1>
                    <p class="text-sm text-gray-500">Browse Shop products and find what you need.</p>
                </div>

                <div class="flex items-center gap-3">
                    {{-- Mobile Filter Button --}}
                    <button type="button" @click="mobileFilterOpen = true"
                        class="sm:hidden inline-flex items-center gap-2 px-4 h-10 rounded-xl bg-slate-900 text-white text-xs font-bold uppercase tracking-widest
                               hover:bg-[#15A5ED] hover:shadow-[0_8px_20px_rgba(21,165,237,0.25)] transition-all active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5h18M6 12h12M10 19h4" />
                        </svg>
                        Filter
                    </button>

                    {{-- 总数 --}}
                    <div class="text-xs sm:text-sm text-gray-500">
                        Showing <span class="font-semibold text-gray-800">{{ $products->total() }}</span> items
                    </div>
                </div>
            </div>

            @php
                $activeCat = request('category');
                $baseQuery = [
                    'q' => request('q'),
                    'sort' => request('sort'),
                ];
            @endphp


            {{-- Main Layout --}}
            <div class="grid grid-cols-1 lg:grid-cols-10 gap-6 lg:gap-8">
                {{-- LEFT: Desktop Sidebar Filter --}}
                <aside class="hidden lg:block lg:col-span-2">
                    <div class="lg:sticky lg:top-24 max-h-[calc(100vh-7rem)] flex flex-col gap-5">
                        @include('shop.partials.filters', ['mode' => 'desktop'])
                    </div>
                </aside>


                {{-- RIGHT: Products --}}
                <main class="lg:col-span-8">
                    @if ($products->count())
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4 sm:gap-6">
                            @foreach ($products as $product)
                                <a href="{{ route('shop.show', $product->slug) }}"
                                    class="group relative bg-white/70 backdrop-blur-md rounded-2xl border border-white shadow-[0_8px_30px_rgb(0,0,0,0.04)]
                               hover:shadow-[0_20px_40px_rgba(21,165,237,0.1)] hover:border-[#15A5ED]/30 transition-all duration-500
                               flex flex-col overflow-hidden">

                                    {{-- Image --}}
                                    <div class="relative aspect-square bg-[#F1F5F9]/50 overflow-hidden m-2 rounded-xl">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}" loading="lazy"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center text-[10px] font-mono text-slate-300">
                                                IMG_NOT_FOUND
                                            </div>
                                        @endif

                                        {{-- Subtle overlay --}}
                                        <div
                                            class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-500">
                                        </div>

                                        {{-- ❤️ Favorite Button (Glass Style) --}}
                                        @auth
                                            @php
                                                $isFavorited = auth()
                                                    ->user()
                                                    ->favorites->contains('product_id', $product->id);
                                            @endphp

                                            <form
                                                action="{{ $isFavorited ? route('account.favorites.destroy', $product) : route('account.favorites.store', $product) }}"
                                                method="POST" class="absolute top-2 right-2 z-20"
                                                onclick="event.preventDefault(); event.stopPropagation(); this.submit();">
                                                @csrf
                                                @if ($isFavorited)
                                                    @method('DELETE')
                                                @endif

                                                <button type="submit"
                                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-white/80 backdrop-blur shadow-sm border border-slate-100
                                               text-[#15A5ED] hover:bg-[#15A5ED] hover:text-white transition-all">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        fill="{{ $isFavorited ? 'currentColor' : 'none' }}"
                                                        stroke="currentColor" viewBox="0 0 24 24" class="h-4 w-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endauth
                                    </div>

                                    {{-- Content --}}
                                    <div class="p-4 pt-2 flex-1 flex flex-col">
                                        {{-- Status --}}
                                        <div class="flex items-center gap-2 mb-3">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                            <span
                                                class="text-[10px] font-mono text-slate-400 uppercase tracking-tighter">
                                                Ready_stock
                                            </span>
                                        </div>

                                        {{-- Category --}}
                                        <div class="text-xs font-mono text-slate-400 uppercase tracking-widest">
                                            {{ $product->category->name ?? 'UNCATEGORIZED' }}
                                        </div>

                                        {{-- Name --}}
                                        <h3
                                            class="mt-1 text-base font-bold text-slate-800 line-clamp-2 group-hover:text-[#15A5ED] transition-colors leading-snug">
                                            {{ $product->name }}
                                        </h3>

                                        {{-- Price + Action --}}
                                        <div class="mt-4 flex items-center justify-between gap-3">
                                            <div class="text-base font-mono font-bold text-slate-900">
                                                @if ($product->has_variants && $product->variants->count())
                                                    @php
                                                        $prices = $product->variants->pluck('price')->filter();
                                                        $min = $prices->min();
                                                        $max = $prices->max();
                                                    @endphp

                                                    @if ($min == $max)
                                                        RM {{ number_format($min, 2) }}
                                                    @else
                                                        <span
                                                            class="text-[10px] font-medium text-slate-400 uppercase align-middle mr-1">
                                                            From
                                                        </span>
                                                        RM {{ number_format($min, 2) }}
                                                    @endif
                                                @else
                                                    RM {{ number_format($product->price ?? 0, 2) }}
                                                @endif
                                            </div>

                                            {{-- Tech icon button --}}
                                            <div
                                                class="h-8 w-8 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center
                                           group-hover:bg-[#15A5ED] group-hover:text-white transition-all shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Hover Bottom Bar --}}
                                    <div class="h-1 w-0 bg-[#15A5ED] group-hover:w-full transition-all duration-500">
                                    </div>
                                </a>
                            @endforeach

                        </div>

                        <div class="mt-8">
                            {{ $products->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="text-center py-20 border-2 border-dashed border-slate-200 rounded-3xl bg-white/50">
                            <p class="font-mono text-sm text-slate-400">NO_RESULTS: Try adjusting your filters.</p>
                            <a href="{{ route('shop.index') }}"
                                class="mt-4 inline-flex text-xs font-bold uppercase tracking-widest text-slate-500 hover:text-[#15A5ED] transition">
                                Back to shop
                            </a>
                        </div>
                    @endif
                </main>
            </div>

            {{-- MOBILE: Slide-over Filter Drawer --}}
            <div class="sm:hidden fixed inset-0 z-50" x-show="mobileFilterOpen" x-cloak>
                {{-- Backdrop --}}
                <div class="absolute inset-0 bg-black/40" @click="mobileFilterOpen=false"></div>

                {{-- Panel --}}
                <div class="absolute right-0 top-0 h-full w-[88%] max-w-sm bg-[#F5F5F7] shadow-2xl"
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">

                    <div class="p-4 flex items-center justify-between">
                        <div class="text-sm font-bold uppercase tracking-widest text-slate-700">Filters</div>
                        <button class="p-2 rounded-lg hover:bg-white/70" @click="mobileFilterOpen=false"
                            aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="px-4 pb-6 overflow-y-auto h-[calc(100%-56px)] custom-scrollbar">
                        @include('shop.partials.filters', [
                            'mode' => 'mobile',
                            'formId' => 'mobileFilterForm',
                        ])

                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <a href="{{ route('shop.index') }}"
                                class="text-center rounded-2xl border border-black/[0.08] bg-white py-3 text-xs font-bold uppercase tracking-widest text-gray-600">
                                Reset
                            </a>

                            {{-- ✅ Done = submit --}}
                            <button type="button" @click="document.getElementById('mobileFilterForm')?.submit()"
                                class="rounded-2xl bg-slate-900 py-3 text-xs font-bold uppercase tracking-widest text-white shadow-sm active:scale-[0.99]">
                                Done
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <script>
                (function() {
                    const sheet = document.getElementById('filterSheet');
                    const panel = document.getElementById('filterPanel');
                    const backdrop = document.getElementById('filterBackdrop');

                    const openBtn = document.getElementById('openFilters');
                    const closeBtn = document.getElementById('closeFilters');
                    const doneBtn = document.getElementById('applyAndClose');

                    if (!sheet || !panel || !backdrop || !openBtn) return;

                    function openSheet() {
                        sheet.classList.remove('hidden');
                        requestAnimationFrame(() => {
                            backdrop.classList.remove('opacity-0');
                            panel.classList.remove('translate-y-full');
                            document.documentElement.classList.add('overflow-hidden');
                        });
                    }

                    function closeSheet() {
                        backdrop.classList.add('opacity-0');
                        panel.classList.add('translate-y-full');
                        document.documentElement.classList.remove('overflow-hidden');
                        setTimeout(() => sheet.classList.add('hidden'), 220);
                    }

                    openBtn.addEventListener('click', openSheet);
                    backdrop.addEventListener('click', closeSheet);
                    closeBtn && closeBtn.addEventListener('click', closeSheet);

                    // ✅ Done = submit form
                    doneBtn && doneBtn.addEventListener('click', () => {
                        const form = document.getElementById('mobileFilterForm');
                        if (form) form.submit();
                    });

                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape' && !sheet.classList.contains('hidden')) closeSheet();
                    });
                })();
            </script> --}}



        </div>
    </div>
</x-app-layout>
