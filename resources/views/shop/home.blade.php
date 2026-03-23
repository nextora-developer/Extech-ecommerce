<x-app-layout>
    <div class="bg-white">
        {{-- Banner：可滑动轮播，图片来自数据库 --}}
        <section class="w-full relative bg-white overflow-hidden" data-banner-slider>

            {{-- Technical Background Elements --}}
            <div class="absolute inset-0 z-0 opacity-[0.03]"
                style="background-image: linear-gradient(#15A5ED 1px, transparent 1px), linear-gradient(90deg, #15A5ED 1px, transparent 1px); background-size: 40px 40px;">
            </div>

            <div class="max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="relative rounded-3xl overflow-hidden shadow-[0_8px_20px_rgba(0,0,0,0.12)]">

                    @if (isset($banners) && $banners->count())
                        {{-- 用固定比例，避免不同 breakpoint 高度不一样导致裁切不同 --}}
                        <div class="relative w-full aspect-[21/10] sm:aspect-[21/9] lg:aspect-auto lg:h-[420px]">
                            {{-- 轨道 --}}
                            <div class="absolute inset-0 flex h-full transition-transform duration-700 ease-out"
                                data-banner-track>
                                @foreach ($banners as $banner)
                                    @php
                                        $url = $banner->link_url ?: route('shop.index');
                                    @endphp

                                    <a href="{{ $url }}" class="relative w-full h-full shrink-0 block group">
                                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner"
                                            class="w-full h-full object-cover object-center block">
                                    </a>
                                @endforeach
                            </div>

                            {{-- 左右箭头 --}}
                            @if ($banners->count() > 1)
                                <button type="button"
                                    class="hidden sm:flex absolute left-4 top-1/2 -translate-y-1/2
                                   w-9 h-9 rounded-full bg-black/45 hover:bg-black/70
                                   text-white items-center justify-center text-sm"
                                    data-banner-prev>
                                    ‹
                                </button>

                                <button type="button"
                                    class="hidden sm:flex absolute right-4 top-1/2 -translate-y-1/2
                                   w-9 h-9 rounded-full bg-black/45 hover:bg-black/70
                                   text-white items-center justify-center text-sm"
                                    data-banner-next>
                                    ›
                                </button>

                                {{-- 小点点 --}}
                                <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2"
                                    data-banner-dots>
                                    @foreach ($banners as $index => $banner)
                                        <button type="button"
                                            class="w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/80 transition"
                                            data-banner-dot="{{ $index }}"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        {{-- 没有 banner 的时候显示一个占位背景 --}}
                        <div
                            class="w-full aspect-[21/10] sm:aspect-[21/9] lg:aspect-auto lg:h-[420px] bg-[#F5F5F7] flex items-center justify-center rounded-3xl">
                            <p class="text-gray-400 text-sm">Shop Banner coming soon</p>
                        </div>
                    @endif

                </div>
            </div>
        </section>


        {{-- Category 区块 --}}
        <section id="categories" class="relative bg-white overflow-hidden">
            {{-- Technical Background Elements --}}
            <div class="absolute inset-0 z-0 opacity-[0.03]"
                style="background-image: linear-gradient(#15A5ED 1px, transparent 1px), linear-gradient(90deg, #15A5ED 1px, transparent 1px); background-size: 40px 40px;">
            </div>

            <div class="relative z-10 max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8 lg:py-4">

                @if (isset($categories) && $categories->count())
                    {{-- Horizontal Scroll Container --}}
                    <div class="overflow-x-auto scrollbar-hide cursor-grab select-none active:cursor-grabbing"
                        data-scroll-x>
                        <div class="flex gap-4 md:gap-6 min-w-max py-4">
                            @foreach ($categories as $category)
                                <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                                    class="group shrink-0 w-[120px] md:w-[140px] bg-[#F8FAFC]/50 backdrop-blur-sm border border-slate-100 rounded-2xl
                                   px-4 py-6 transition-all duration-300 hover:bg-white hover:shadow-[0_15px_30px_rgba(21,165,237,0.08)] 
                                   hover:border-[#15A5ED]/40 flex flex-col items-center relative overflow-hidden">

                                    {{-- Hover Tech Pattern --}}
                                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"
                                        style="background-image: radial-gradient(#15A5ED 0.5px, transparent 0.5px); background-size: 10px 10px;">
                                    </div>

                                    {{-- Icon / Graphic --}}
                                    <div
                                        class="relative w-16 h-16 rounded-2xl bg-white border border-slate-100 flex items-center justify-center p-3 mb-4 
                                        shadow-sm group-hover:shadow-[0_0_15px_rgba(21,165,237,0.2)] group-hover:border-[#15A5ED]/20 transition-all duration-300">
                                        @if ($category->icon)
                                            <img src="{{ asset('storage/' . $category->icon) }}"
                                                alt="{{ $category->name }}"
                                                class="w-full h-full object-contain filter transition-all">
                                        @else
                                            <svg class="w-6 h-6 text-slate-300 group-hover:text-[#15A5ED]"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                        @endif
                                    </div>

                                    {{-- Category Name --}}
                                    <div
                                        class="relative text-xs font-bold text-slate-500 group-hover:text-slate-900 text-center uppercase tracking-tighter transition-colors">
                                        {{ $category->name }}
                                    </div>

                                    {{-- Tech Sub-label --}}
                                    <div
                                        class="mt-1 text-[12px] font-mono text-slate-300 group-hover:text-[#15A5ED] transition-colors">
                                        TYPE_SYS_{{ $loop->iteration }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div
                        class="flex flex-col items-center justify-center border border-slate-100 rounded-3xl bg-[#F8FAFC] py-12">
                        <p class="text-[10px] font-mono text-slate-400 uppercase tracking-widest">
                            Err: No_Categories_Detected
                        </p>
                    </div>
                @endif
            </div>
        </section>


        {{-- Featured products --}}
        <section id="featured" class="relative bg-[#F8FAFC] overflow-hidden py-8 lg:py-18">
            {{-- High-tech Light Background --}}
            <div class="absolute inset-0 z-0 opacity-[0.4]"
                style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 32px 32px;">
            </div>

            {{-- Soft Technical Glows --}}
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#15A5ED]/5 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-400/5 rounded-full blur-[120px]"></div>

            <div class="relative z-10 max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Header with Technical Line --}}
                <div class="text-center mb-10">
                    <div class="inline-flex flex-col items-center">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="w-2 h-2 rounded-full bg-[#15A5ED] shadow-[0_0_10px_#15A5ED]"></span>
                            <span class="h-[1px] w-10 bg-[#15A5ED]/40"></span>
                            <span class="text-[10px] font-mono text-slate-400 uppercase tracking-[0.3em]">
                                Verified_Systems
                            </span>
                            <span class="h-[1px] w-10 bg-[#15A5ED]/40"></span>
                            <span class="w-2 h-2 rounded-full bg-[#15A5ED] shadow-[0_0_10px_#15A5ED]"></span>
                        </div>

                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight">
                            New <span class="text-[#15A5ED] font-light">Arrival</span>
                        </h2>

                        <p class="mt-2 text-xs font-mono text-slate-400 uppercase tracking-widest">
                            2026 Edition // Curated Digital Solutions
                        </p>
                    </div>
                </div>

                @if ($featured->count())

                    {{-- Mobile Slider --}}
                    <div class="lg:hidden -mx-4 px-4 overflow-x-auto scrollbar-hide">
                        <div class="flex gap-4 snap-x snap-mandatory pb-2 w-max">
                            @foreach ($featured as $product)
                                <a href="{{ route('shop.show', $product->slug) }}"
                                    class="group snap-start shrink-0 w-[50vw] sm:w-[30vw] relative bg-white/70 backdrop-blur-md rounded-2xl border border-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgba(21,165,237,0.1)] hover:border-[#15A5ED]/30 transition-all duration-500 flex flex-col overflow-hidden">

                                    {{-- Product image --}}
                                    <div class="relative aspect-square bg-[#F1F5F9]/50 overflow-hidden m-2 rounded-xl">
                                        @if ($product->image ?? false)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center text-[10px] font-mono text-slate-300">
                                                IMG_NOT_FOUND
                                            </div>
                                        @endif

                                        @auth
                                            @php
                                                $isFavorited = auth()
                                                    ->user()
                                                    ->favorites->contains('product_id', $product->id);
                                            @endphp
                                            <form
                                                action="{{ $isFavorited ? route('account.favorites.destroy', $product) : route('account.favorites.store', $product) }}"
                                                method="POST" class="absolute top-2 right-2 z-20">
                                                @csrf
                                                @if ($isFavorited)
                                                    @method('DELETE')
                                                @endif
                                                <button type="submit"
                                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-white/80 backdrop-blur shadow-sm border border-slate-100 text-[#15A5ED] hover:bg-[#15A5ED] hover:text-white transition-all">
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
                                    <div class="p-4 pt-2">
                                        <div class="flex items-center gap-2 mb-3">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                            <span
                                                class="text-[10px] font-mono text-slate-400 uppercase tracking-tighter">Ready_stock</span>
                                        </div>

                                        <div class="text-xs font-mono text-slate-400 uppercase tracking-widest">
                                            {{ $product->category->name ?? 'UNCATEGORIZED' }}
                                        </div>

                                        <h3
                                            class="text-base font-bold text-slate-800 line-clamp-1 group-hover:text-[#15A5ED] transition-colors">
                                            {{ $product->name }}
                                        </h3>

                                        <div class="mt-4 flex items-center justify-between">
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

                                            <div
                                                class="h-8 w-8 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center group-hover:bg-[#15A5ED] group-hover:text-white transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="h-1 w-0 bg-[#15A5ED] group-hover:w-full transition-all duration-500">
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Desktop Grid --}}
                    <div x-data="{
                        scrollLeft() {
                                this.$refs.pcSlider.scrollBy({ left: -260, behavior: 'smooth' });
                            },
                            scrollRight() {
                                this.$refs.pcSlider.scrollBy({ left: 260, behavior: 'smooth' });
                            }
                    }" class="hidden lg:block relative">

                        {{-- Left Button --}}
                        <button type="button" @click="scrollLeft"
                            class="absolute left-2 top-1/2 z-20 -translate-y-1/2 w-11 h-11 rounded-full bg-white/90 backdrop-blur border border-slate-200 shadow-[0_10px_30px_rgba(0,0,0,0.08)] text-slate-700 hover:bg-[#15A5ED] hover:text-white hover:border-[#15A5ED] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        {{-- Right Button --}}
                        <button type="button" @click="scrollRight"
                            class="absolute right-2 top-1/2 z-20 -translate-y-1/2 w-11 h-11 rounded-full bg-white/90 backdrop-blur border border-slate-200 shadow-[0_10px_30px_rgba(0,0,0,0.08)] text-slate-700 hover:bg-[#15A5ED] hover:text-white hover:border-[#15A5ED] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        {{-- Slider --}}
                        <div x-ref="pcSlider" class="overflow-x-auto scrollbar-hide scroll-smooth">
                            <div class="flex gap-5 w-max">
                                @foreach ($featured as $product)
                                    <a href="{{ route('shop.show', $product->slug) }}"
                                        class="group relative shrink-0 w-[calc((100vw-12rem)/5)] max-w-[260px] min-w-[220px] bg-white/70 backdrop-blur-md rounded-2xl border border-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgba(21,165,237,0.1)] hover:border-[#15A5ED]/30 transition-all duration-500 flex flex-col overflow-hidden">

                                        {{-- Product image --}}
                                        <div
                                            class="relative aspect-square bg-[#F1F5F9]/50 overflow-hidden m-2 rounded-xl">
                                            @if ($product->image ?? false)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center text-[10px] font-mono text-slate-300">
                                                    IMG_NOT_FOUND
                                                </div>
                                            @endif

                                            @auth
                                                @php
                                                    $isFavorited = auth()
                                                        ->user()
                                                        ->favorites->contains('product_id', $product->id);
                                                @endphp
                                                <form
                                                    action="{{ $isFavorited ? route('account.favorites.destroy', $product) : route('account.favorites.store', $product) }}"
                                                    method="POST" class="absolute top-2 right-2 z-20">
                                                    @csrf
                                                    @if ($isFavorited)
                                                        @method('DELETE')
                                                    @endif
                                                    <button type="submit"
                                                        class="w-8 h-8 flex items-center justify-center rounded-full bg-white/80 backdrop-blur shadow-sm border border-slate-100 text-[#15A5ED] hover:bg-[#15A5ED] hover:text-white transition-all">
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
                                        <div class="p-4 pt-2">
                                            <div class="flex items-center gap-2 mb-3">
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                                <span
                                                    class="text-[10px] font-mono text-slate-400 uppercase tracking-tighter">Ready_stock</span>
                                            </div>

                                            <div class="text-xs font-mono text-slate-400 uppercase tracking-widest">
                                                {{ $product->category->name ?? 'UNCATEGORIZED' }}
                                            </div>

                                            <h3
                                                class="text-base font-bold text-slate-800 line-clamp-1 group-hover:text-[#15A5ED] transition-colors">
                                                {{ $product->name }}
                                            </h3>

                                            <div class="mt-4 flex items-center justify-between">
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

                                                <div
                                                    class="h-8 w-8 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center group-hover:bg-[#15A5ED] group-hover:text-white transition-all">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="h-1 w-0 bg-[#15A5ED] group-hover:w-full transition-all duration-500">
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- ✅ BUTTON 放这里 --}}
                    <div class="mt-10 flex justify-center">
                        <a href="{{ route('shop.index') }}"
                            class="inline-flex items-center gap-2 rounded-full bg-[#15A5ED] px-6 py-3 text-xs font-bold uppercase tracking-[0.2em] text-white shadow-[0_12px_30px_rgba(21,165,237,0.25)] hover:shadow-[0_16px_40px_rgba(21,165,237,0.35)] hover:-translate-y-0.5 transition-all duration-300">
                            Explore More
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                @else
                    <div class="text-center py-20 border-2 border-dashed border-slate-200 rounded-3xl">
                        <p class="font-mono text-sm text-slate-400">DATABASE_EMPTY: Please insert records.</p>
                    </div>
                @endif

            </div>
        </section>

        {{-- Category Showcase --}}
        <section class="relative bg-[#F8FAFC] py-10 lg:py-20 overflow-hidden">
            <div class="relative z-10 max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                    {{-- Entertainment --}}
                    <div class="bg-white rounded-[28px] bg-[#F3F3F3] p-6 md:p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl md:text-3xl font-semibold text-black">Entertainment</h2>
                            <a href="{{ route('shop.index', ['category' => 'entertainment']) }}"
                                class="inline-flex items-center gap-2 text-sm font-medium text-black hover:text-[#15A5ED] transition">
                                View all
                                <span>→</span>
                            </a>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach ($entertainmentProducts->take(4) as $product)
                                <a href="{{ route('shop.show', $product->slug) }}"
                                    class="group relative block aspect-square overflow-hidden rounded-[20px] bg-white">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center text-sm text-slate-400">
                                            No Image
                                        </div>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Games --}}
                    <div class="bg-white rounded-[28px] bg-[#F3F3F3] p-6 md:p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl md:text-3xl font-semibold text-black">Games</h2>
                            <a href="{{ route('shop.index', ['category' => 'games']) }}"
                                class="inline-flex items-center gap-2 text-sm font-medium text-black hover:text-[#15A5ED] transition">
                                View all
                                <span>→</span>
                            </a>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach ($gameProducts->take(4) as $product)
                                <a href="{{ route('shop.show', $product->slug) }}"
                                    class="group relative block aspect-square overflow-hidden rounded-[20px] bg-white">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center text-sm text-slate-400">
                                            No Image
                                        </div>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- Trust & Value Section --}}
        <section class="relative bg-white py-16 lg:py-16 overflow-hidden">
            {{-- soft grid --}}
            <div class="absolute inset-0 opacity-[0.035] pointer-events-none"
                style="background-image: radial-gradient(#15A5ED 1px, transparent 1px); background-size: 28px 28px;">
            </div>

            <div class="max-w-7xl5 mx-auto px-6 relative">

                {{-- section shell --}}
                <div
                    class="relative rounded-[2.5rem] border border-slate-300 bg-white shadow-[0_20px_60px_rgba(15,23,42,0.06)] overflow-hidden">

                    {{-- top technical bar --}}
                    <div
                        class="h-14 border-b border-slate-300 bg-gradient-to-r from-slate-50 via-white to-slate-50 flex items-center justify-between px-6 lg:px-8">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#15A5ED]"></span>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-[0.28em] text-slate-500">
                                Trust Layer
                            </span>
                        </div>

                        <div class="hidden sm:flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                        </div>
                    </div>

                    @php
                        $features = [
                            [
                                'label' => 'Instant',
                                'sub' => 'Auto Delivery',
                                'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                            ],
                            [
                                'label' => 'Secure',
                                'sub' => 'Encrypted',
                                'icon' =>
                                    'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.744c0 5.052 3.823 9.213 8.712 9.637.222.019.447.029.672.029.224 0 .449-.01.671-.029 4.89-.423 8.713-4.585 8.713-9.637 0-1.305-.209-2.56-.598-3.744A11.959 11.959 0 0112 2.714z',
                            ],
                            [
                                'label' => 'Trusted',
                                'sub' => 'Verified',
                                'icon' =>
                                    'M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z',
                            ],
                            [
                                'label' => 'Support.MY',
                                'sub' => 'Local Team',
                                'icon' =>
                                    'M15 10.5a3 3 0 11-6 0 3 3 0 016 0z M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z',
                            ],
                        ];
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($features as $index => $f)
                            <div
                                class="group relative px-6 py-8 lg:px-8 lg:py-10 transition-all duration-500 hover:bg-slate-50/70 {{ $index < count($features) - 1 ? 'border-b sm:border-b-0 lg:border-r border-slate-300' : '' }} {{ $index === 0 ? 'sm:border-r lg:border-r' : '' }} {{ $index === 1 ? 'lg:border-r' : '' }} {{ $index === 2 ? 'sm:border-r lg:border-r' : '' }}">

                                {{-- hover glow line --}}
                                <div
                                    class="absolute left-0 top-0 h-full w-[2px] bg-transparent group-hover:bg-[#15A5ED] transition-all duration-500">
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="relative shrink-0">
                                        <div
                                            class="absolute inset-0 rounded-2xl bg-[#15A5ED] blur-xl opacity-0 group-hover:opacity-15 transition-all duration-500">
                                        </div>
                                        <div
                                            class="relative w-12 h-12 lg:w-14 lg:h-14 rounded-2xl border border-slate-300 bg-slate-50 flex items-center justify-center text-slate-600 group-hover:border-[#15A5ED]/40 group-hover:text-[#15A5ED] group-hover:bg-white transition-all duration-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 lg:w-6 lg:h-6"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="{{ $f['icon'] }}" />
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="min-w-0">
                                        <p
                                            class="text-[10px] lg:text-[11px] font-mono font-bold uppercase tracking-[0.24em] text-slate-400 mb-2">
                                            0{{ $index + 1 }}
                                        </p>

                                        <h4
                                            class="text-sm lg:text-base font-black uppercase tracking-[0.16em] text-slate-900 group-hover:text-[#15A5ED] transition-colors duration-300">
                                            {{ $f['label'] }}
                                        </h4>

                                        <p class="mt-2 text-sm text-slate-500 font-medium">
                                            {{ $f['sub'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <section class="relative">
            <div class="mx-auto max-w-7xl5 px-4 sm:px-6 lg:px-8 pb-6 py-4">

                {{-- marquee --}}
                <div class="relative">

                    {{-- fade edges --}}
                    <div
                        class="pointer-events-none absolute left-0 top-0 bottom-0 w-14 bg-gradient-to-r from-white via-white/80 to-transparent z-10">
                    </div>

                    <div
                        class="pointer-events-none absolute right-0 top-0 bottom-0 w-14 bg-gradient-to-l from-white via-white/80 to-transparent z-10">
                    </div>

                    <div class="overflow-hidden" data-pay-marquee>
                        <div class="flex items-center gap-10 sm:gap-14 will-change-transform" data-pay-track>

                            @php
                                $payments = [
                                    ['alt' => 'FPX', 'src' => asset('images/payments/fpx.png')],
                                    ['alt' => 'Visa', 'src' => asset('images/payments/visa.png')],
                                    ['alt' => 'Mastercard', 'src' => asset('images/payments/mastercard.png')],
                                    ['alt' => 'TNG eWallet', 'src' => asset('images/payments/tng.png')],
                                    ['alt' => 'GrabPay', 'src' => asset('images/payments/grabpay.png')],
                                    ['alt' => 'GrabPayLater', 'src' => asset('images/payments/grabpaylater.png')],
                                    ['alt' => 'ShopeePay', 'src' => asset('images/payments/shopeepay.png')],
                                    ['alt' => 'SPayLater', 'src' => asset('images/payments/spaylater.png')],
                                    ['alt' => 'AliPay', 'src' => asset('images/payments/alipay.png')],
                                ];
                            @endphp

                            @foreach ($payments as $p)
                                <div class="shrink-0">
                                    <img src="{{ $p['src'] }}" alt="{{ $p['alt'] }}"
                                        class="h-14 sm:h-16 lg:h-20 w-auto object-contain
                                       rounded-xl sm:rounded-2xl
                                       hover:opacity-90 transition"
                                        draggable="false">
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </section>

        {{-- Bottom CTA Section --}}
        <section class="relative bg-white overflow-hidden">


            <div class="relative max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
                {{-- Main Glass Panel --}}
                <div
                    class="relative flex flex-col md:flex-row items-center justify-between gap-10 bg-[#F8FAFC] rounded-[2rem] p-8 md:p-16 border border-slate-200/60 shadow-[0_20px_50px_rgba(0,0,0,0.02)]">

                    {{-- Decorative Tech Brackets --}}
                    <div class="absolute top-6 left-6 w-2 h-2 border-t-2 border-l-2 border-[#15A5ED]/30"></div>
                    <div class="absolute bottom-6 right-6 w-2 h-2 border-b-2 border-r-2 border-[#15A5ED]/30"></div>

                    <div class="text-center md:text-left max-w-xl relative z-10">
                        <div
                            class="inline-flex items-center gap-2 mb-4 px-3 py-1 rounded-md bg-white border border-slate-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#15A5ED] animate-pulse"></span>
                            <span
                                class="text-[10px] font-mono font-bold text-slate-400 uppercase tracking-widest">System_Online</span>
                        </div>

                        <h3 class="text-2xl md:text-4xl font-bold text-slate-900 tracking-tight leading-tight">
                            Elevate Your <span class="text-[#15A5ED]">Digital Workspace</span>
                        </h3>
                        <p class="mt-4 text-sm md:text-lg text-slate-500 leading-relaxed font-light">
                            Access our full inventory of high-performance essentials. <br class="hidden md:block">
                            Precision-engineered, securely delivered, local support.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 shrink-0 relative z-10 w-full md:w-auto">
                        {{-- Primary Tech Button --}}
                        <a href="{{ route('shop.index') }}"
                            class="group relative inline-flex items-center justify-center px-10 py-4 rounded-xl
                           text-sm font-bold uppercase tracking-wider
                           bg-slate-900 text-white overflow-hidden
                           transition-all duration-300 hover:bg-[#15A5ED] hover:shadow-[0_10px_25px_rgba(21,165,237,0.4)]
                           hover:-translate-y-1">
                            <span class="relative z-10 flex items-center">
                                Shop Now
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="ml-2 h-4 w-4 transition-transform group-hover:translate-x-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.25 7.75L18.5 12m0 0l-4.25 4.25M18.5 12H5.5" />
                                </svg>
                            </span>
                        </a>

                        {{-- Secondary Ghost Button --}}
                        <a href="#categories"
                            class="inline-flex items-center justify-center px-10 py-4 rounded-xl
                           text-sm font-bold uppercase tracking-wider
                           bg-white text-slate-600 border border-slate-200
                           hover:bg-slate-50 hover:text-[#15A5ED] hover:border-[#15A5ED]/40 transition-all duration-300">
                            View Category
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- scripts 原样保留 --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('[data-scroll-x]');
            if (!slider) return;

            let isDown = false;
            let startX = 0;
            let moved = false;

            slider.addEventListener('mousedown', function(e) {
                isDown = true;
                moved = false;
                slider.classList.add('cursor-grabbing');

                e.preventDefault();
                startX = e.clientX;
            });

            const stopDrag = () => {
                isDown = false;
                slider.classList.remove('cursor-grabbing');
            };

            slider.addEventListener('mouseup', stopDrag);
            slider.addEventListener('mouseleave', stopDrag);

            slider.addEventListener('mousemove', function(e) {
                if (!isDown) return;

                e.preventDefault();
                const x = e.clientX;
                const delta = x - startX;

                slider.scrollLeft -= delta * 1.2;

                startX = x;
                if (Math.abs(delta) > 3) moved = true;
            });

            slider.addEventListener('click', function(e) {
                if (moved) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }, true);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('[data-banner-slider]');
            if (!slider) return;

            const track = slider.querySelector('[data-banner-track]');
            const slides = Array.from(track.children);
            const prevBtn = slider.querySelector('[data-banner-prev]');
            const nextBtn = slider.querySelector('[data-banner-next]');
            const dotsWrap = slider.querySelector('[data-banner-dots]');
            const dots = dotsWrap ? Array.from(dotsWrap.querySelectorAll('[data-banner-dot]')) : [];

            let index = 0;
            let autoTimer = null;

            function goTo(i) {
                if (!slides.length) return;
                index = (i + slides.length) % slides.length;
                track.style.transform = `translateX(-${index * 100}%)`;

                dots.forEach((dot, idx) => {
                    if (idx === index) {
                        dot.classList.add('bg-white');
                        dot.classList.remove('bg-white/40');
                    } else {
                        dot.classList.remove('bg-white');
                        dot.classList.add('bg-white/40');
                    }
                });
            }

            function next() {
                goTo(index + 1);
            }

            function prev() {
                goTo(index - 1);
            }

            goTo(0);

            if (prevBtn) prevBtn.addEventListener('click', () => {
                prev();
                restartAuto();
            });

            if (nextBtn) nextBtn.addEventListener('click', () => {
                next();
                restartAuto();
            });

            dots.forEach((dot, idx) => {
                dot.addEventListener('click', () => {
                    goTo(idx);
                    restartAuto();
                });
            });

            function startAuto() {
                if (autoTimer) clearInterval(autoTimer);
                autoTimer = setInterval(() => {
                    next();
                }, 5000);
            }

            function restartAuto() {
                startAuto();
            }

            startAuto();

            let startX = null;
            let isTouchMoving = false;

            slider.addEventListener('touchstart', (e) => {
                if (!e.touches[0]) return;
                startX = e.touches[0].clientX;
                isTouchMoving = true;
            });

            slider.addEventListener('touchmove', (e) => {
                if (!isTouchMoving || startX === null) return;
                const currentX = e.touches[0].clientX;
                const diff = currentX - startX;
            });

            slider.addEventListener('touchend', (e) => {
                if (!isTouchMoving || startX === null) return;
                const endX = e.changedTouches[0].clientX;
                const diff = endX - startX;

                if (Math.abs(diff) > 50) {
                    if (diff < 0) {
                        next();
                    } else {
                        prev();
                    }
                    restartAuto();
                }

                startX = null;
                isTouchMoving = false;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrap = document.querySelector('[data-pay-marquee]');
            const track = document.querySelector('[data-pay-track]');
            if (!wrap || !track) return;

            // 复制一份内容，实现无缝循环
            track.innerHTML = track.innerHTML + track.innerHTML;

            let x = 0;
            let speed = 0.55; // ✅ 速度：0.35 慢 / 0.55 默认 / 0.8 快
            let paused = false;

            // track 一半宽度（因为复制了两份）
            function getHalfWidth() {
                return track.scrollWidth / 2;
            }

            function tick() {
                if (!paused) {
                    x += speed;
                    const half = getHalfWidth();

                    // 滑到一半就重置（无缝）
                    if (x >= half) x = 0;

                    track.style.transform = `translateX(${-x}px)`;
                }
                requestAnimationFrame(tick);
            }
            tick();

            // hover 暂停（桌面）
            wrap.addEventListener('mouseenter', () => paused = true);
            wrap.addEventListener('mouseleave', () => paused = false);

            // touch 暂停（手机）
            wrap.addEventListener('touchstart', () => paused = true, {
                passive: true
            });
            wrap.addEventListener('touchend', () => paused = false, {
                passive: true
            });

            // 可选：根据用户滚动方向微调速度（更“顺”）
            wrap.addEventListener('wheel', (e) => {
                // 鼠标滚轮时短暂加速/减速（不阻止默认）
                const delta = Math.max(-12, Math.min(12, e.deltaY));
                speed = Math.max(0.25, Math.min(1.2, 0.55 + delta * 0.01));
                clearTimeout(wrap._paySpeedTimer);
                wrap._paySpeedTimer = setTimeout(() => speed = 0.55, 500);
            }, {
                passive: true
            });
        });
    </script>

</x-app-layout>
