<x-app-layout>
    <div class="bg-[#F5F5F7] min-h-screen">
        <div class="max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

            {{-- Header + 小标题 --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900">Shop</h1>
                    <p class="text-sm text-gray-500">
                        Browse Shop products and find what you need.
                    </p>
                </div>

                {{-- 总数 --}}
                <div class="text-xs sm:text-sm text-gray-500">
                    Showing <span class="font-semibold text-gray-800">{{ $products->total() }}</span> items
                </div>
            </div>

            {{-- Filter Bar --}}
            <form method="GET" action="{{ route('shop.index') }}"
                class="mb-10 bg-white/80 backdrop-blur-md border border-slate-200 rounded-2xl p-5 shadow-[0_15px_40px_-15px_rgba(0,0,0,0.05)] relative overflow-hidden">

                {{-- Decorative Tech Accent --}}
                <div class="absolute top-0 left-0 w-1 h-full bg-[#15A5ED]"></div>

                <div class="flex flex-col lg:flex-row lg:items-end gap-5">

                    {{-- Search Module --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1.5">
                            <span
                                class="text-[10px] font-mono font-bold text-[#15A5ED] tracking-widest uppercase">Query_Input</span>
                        </div>
                        <div class="relative group">
                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="Enter keywords..."
                                class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2 text-sm text-slate-700
                           placeholder:text-slate-400 focus:bg-white focus:border-[#15A5ED] focus:ring-4 focus:ring-[#15A5ED]/10 focus:outline-none transition-all duration-300">
                            <div
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-[#15A5ED] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Category Module --}}
                    <div class="w-full lg:w-60">
                        <div class="flex items-center gap-2 mb-1.5">
                            <span
                                class="text-[10px] font-mono font-bold text-slate-400 tracking-widest uppercase">System_Sector</span>
                        </div>
                        <select name="category"
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2 text-sm text-slate-700
                       focus:bg-white focus:border-[#15A5ED] focus:ring-4 focus:ring-[#15A5ED]/10 transition-all duration-300 outline-none appearance-none cursor-pointer">
                            <option value="">All Categories</option>
                            @isset($categories)
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    {{-- Sort Module --}}
                    <div class="w-full lg:w-56">
                        <div class="flex items-center gap-2 mb-1.5">
                            <span
                                class="text-[10px] font-mono font-bold text-slate-400 tracking-widest uppercase">Logic_Order</span>
                        </div>
                        <select name="sort"
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2 text-sm text-slate-700
                       focus:bg-white focus:border-[#15A5ED] focus:ring-4 focus:ring-[#15A5ED]/10 transition-all duration-300 outline-none appearance-none cursor-pointer">
                            <option value="">Default Sequence</option>
                            <option value="latest" @selected(request('sort') === 'latest')>Timestamp: Latest</option>
                            <option value="price_asc" @selected(request('sort') === 'price_asc')>Value: Low to High</option>
                            <option value="price_desc" @selected(request('sort') === 'price_desc')>Value: High to Low</option>
                        </select>
                    </div>

                    {{-- Control Buttons --}}
                    <div class="flex items-center gap-2 h-11">
                        <button type="submit"
                            class="flex-1 lg:flex-none px-6 h-full rounded-xl bg-slate-900 text-white text-xs font-bold uppercase tracking-widest 
                       hover:bg-[#15A5ED] hover:shadow-[0_8px_20px_rgba(21,165,237,0.3)] transition-all active:scale-95 duration-300">
                            Search
                        </button>

                        <a href="{{ route('shop.index') }}"
                            class="flex items-center justify-center px-4 h-full rounded-xl border border-slate-200 text-slate-400 hover:text-red-500 hover:border-red-100 hover:bg-red-50 transition-all active:scale-95 duration-300"
                            title="Reset Filters">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>
            </form>

            {{-- Product Grid --}}
            @if ($products->count())
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-5">

                    @foreach ($products as $product)
                        <a href="{{ route('shop.show', $product->slug) }}"
                            class="group relative bg-white/70 backdrop-blur-md rounded-2xl border border-white shadow-[0_8px_30px_rgb(0,0,0,0.04)]
                               hover:shadow-[0_20px_40px_rgba(21,165,237,0.1)] hover:border-[#15A5ED]/30 transition-all duration-500
                               flex flex-col overflow-hidden">

                            {{-- Image --}}
                            <div class="relative aspect-square bg-[#F1F5F9]/50 overflow-hidden m-2 rounded-xl">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        loading="lazy"
                                        class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-700">
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
                                        $isFavorited = auth()->user()->favorites->contains('product_id', $product->id);
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
                                                fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor"
                                                viewBox="0 0 24 24" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                    <span class="text-[10px] font-mono text-slate-400 uppercase tracking-tighter">
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                </div>

                                {{-- Optional: secondary CTA like your "View Details" --}}
                                <div class="mt-4">
                                    <div
                                        class="w-full inline-flex items-center justify-center rounded-xl bg-white/60 border border-slate-200 py-2.5
                                           text-xs font-bold uppercase tracking-widest text-slate-600
                                           hover:bg-[#15A5ED] hover:text-white hover:border-[#15A5ED] transition-all duration-300">
                                        View Details
                                    </div>
                                </div>
                            </div>

                            {{-- Hover Bottom Bar --}}
                            <div class="h-1 w-0 bg-[#15A5ED] group-hover:w-full transition-all duration-500"></div>
                        </a>
                    @endforeach

                </div>

                <div class="mt-8">
                    {{ $products->withQueryString()->links() }}
                </div>
            @else
                {{-- Empty State (featured style) --}}
                <div class="text-center py-20 border-2 border-dashed border-slate-200 rounded-3xl bg-white/50">
                    <p class="font-mono text-sm text-slate-400">NO_RESULTS: Try adjusting your filters.</p>
                    <a href="{{ route('shop.index') }}"
                        class="mt-4 inline-flex text-xs font-bold uppercase tracking-widest text-slate-500 hover:text-[#15A5ED] transition">
                        Back to shop
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
