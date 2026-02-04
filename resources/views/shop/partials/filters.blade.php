@php
    $mode = $mode ?? 'desktop';
    $formId = $formId ?? null;
    $brandColor = '#15A5ED';
@endphp

{{-- =========================
    Quick Filter
    ========================= --}}
<div class="shrink-0 group/filter">
    <form id="{{ $formId }}" method="GET" action="{{ route('shop.index') }}"
        class="relative overflow-hidden bg-white/80 backdrop-blur-xl border border-black/[0.03] rounded-[2.5rem] p-6
               shadow-[0_8px_30px_rgb(0,0,0,0.04)] transition-all duration-500
               hover:shadow-[0_20px_50px_rgba(21,165,237,0.12)] hover:border-[#15A5ED]/20">

        {{-- Animated Scanner Line Effect --}}
        <div
            class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-[#15A5ED]/40 to-transparent -translate-x-full group-hover/filter:animate-[shimmer_2s_infinite]">
        </div>

        <div class="flex items-center gap-4 mb-6">
            <div
                class="relative flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-[#15A5ED] to-[#0E8AD1] text-white shadow-lg shadow-[#15A5ED]/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15z" />
                </svg>
            </div>
            <div>
                <h3 class="text-[14px] font-black text-slate-900 tracking-tight leading-none">Search Products</h3>
                <p class="text-[9px] text-[#15A5ED] uppercase tracking-[0.2em] font-bold opacity-70">
                    Find what you need
                </p>
            </div>
        </div>

        <div class="space-y-5">
            {{-- Input Group --}}
            @foreach (['q' => 'Search', 'sort' => 'Sort By'] as $name => $label)
                <div class="relative">
                    <label
                        class="block text-[9px] uppercase tracking-[0.2em] text-slate-400 font-bold mb-1.5 ml-1 transition-colors group-focus-within/filter:text-[#15A5ED]">
                        {{ $label }}
                    </label>

                    @if ($name === 'q')
                        <input type="text" name="q" value="{{ request('q') }}"
                            placeholder="Search products..."
                            class="w-full rounded-2xl border-none bg-slate-100/50 px-4 py-3 text-xs font-semibold text-slate-700
                                   placeholder:text-slate-300 focus:bg-white focus:ring-2 focus:ring-[#15A5ED]/20 transition-all duration-300" />
                    @else
                        <select name="sort"
                            class="w-full rounded-2xl border-none bg-slate-100/50 px-4 py-3 text-xs font-semibold text-slate-700
                                   focus:bg-white focus:ring-2 focus:ring-[#15A5ED]/20 transition-all duration-300 appearance-none">
                            <option value="">Default</option>
                            <option value="latest" @selected(request('sort') === 'latest')>Newest</option>
                            <option value="price_asc" @selected(request('sort') === 'price_asc')>Price: Low to High</option>
                            <option value="price_desc" @selected(request('sort') === 'price_desc')>Price: High to Low</option>
                        </select>
                    @endif
                </div>
            @endforeach

            <input type="hidden" name="category" value="{{ request('category') }}">

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="group/btn relative flex-1 px-4 py-3 rounded-2xl bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest overflow-hidden transition-all hover:scale-[1.02] active:scale-95">
                    <span class="relative z-10">Apply Filters</span>
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-[#15A5ED] to-[#0E8AD1] opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300">
                    </div>
                </button>

                <a href="{{ route('shop.index') }}"
                    class="px-5 py-3 rounded-2xl bg-slate-100 text-slate-400 hover:text-slate-600 hover:bg-slate-200 transition-all flex items-center justify-center"
                    aria-label="Reset">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </div>
    </form>
</div>

{{-- =========================
    Categories
    ========================= --}}
<div class="{{ $mode === 'desktop' ? 'flex-1 min-h-0 flex flex-col' : 'mt-6' }}">
    <div
        class="bg-white border border-black/[0.03] rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)]
               overflow-hidden flex flex-col {{ $mode === 'desktop' ? 'h-full' : '' }}">

        <div class="p-6 border-b border-slate-50 shrink-0 bg-white/50 backdrop-blur-md">
            <div class="flex items-center gap-3">
                <div class="h-2 w-2 rounded-full bg-[#15A5ED] animate-pulse"></div>
                <h3 class="text-[14px] font-black text-slate-900 tracking-tight">Categories</h3>
            </div>
        </div>

        <div class="{{ $mode === 'desktop' ? 'flex-1 min-h-0 overflow-y-auto custom-scrollbar' : '' }} p-4 space-y-1.5">
            @php
                $activeCat = request('category');
                $baseQuery = array_filter(['q' => request('q'), 'sort' => request('sort')]);
            @endphp

            <a href="{{ route('shop.index', $baseQuery) }}"
                class="flex items-center justify-between rounded-2xl px-5 py-4 transition-all duration-300 group
                {{ empty($activeCat) ? 'bg-slate-900 text-white ring-4 ring-slate-900/10' : 'text-slate-500 hover:bg-slate-50' }}">
                <span class="text-[11px] font-black uppercase tracking-widest">All Products</span>
                <span class="px-2 py-0.5 rounded-lg bg-[#15A5ED] text-[10px] text-white font-bold">
                    {{ $products->total() }}
                </span>
            </a>

            @isset($categories)
                @foreach ($categories as $cat)
                    <a href="{{ route('shop.index', array_merge($baseQuery, ['category' => $cat->slug])) }}"
                        class="flex items-center justify-between rounded-2xl px-5 py-3.5 transition-all duration-300 border border-transparent
                        {{ $activeCat === $cat->slug ? 'bg-[#15A5ED]/10 border-[#15A5ED]/20 text-[#15A5ED]' : 'text-slate-600 hover:border-slate-100 hover:bg-slate-50/50' }}">
                        <span class="text-[13px] font-bold tracking-tight">{{ $cat->name }}</span>
                        <span class="text-[10px] font-mono opacity-40">
                            [{{ str_pad((int) ($cat->products_count ?? 0), 2, '0', STR_PAD_LEFT) }}]
                        </span>
                    </a>
                @endforeach
            @endisset
        </div>
    </div>
</div>

<style>
    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 3px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }

    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background: #15A5ED;
    }
</style>
