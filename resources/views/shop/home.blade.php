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

            <div class="relative z-10 max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-4">



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
                                                class="w-full h-full object-contain filter grayscale group-hover:grayscale-0 transition-all">
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
        <section id="featured" class="relative bg-[#F8FAFC] overflow-hidden py-16 lg:py-18">
            {{-- High-tech Light Background --}}
            <div class="absolute inset-0 z-0 opacity-[0.4]"
                style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 32px 32px;">
            </div>

            {{-- Soft Technical Glows --}}
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#15A5ED]/5 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-400/5 rounded-full blur-[120px]"></div>

            <div class="relative z-10 max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Header with Technical Line --}}
                <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
                    <div class="relative pl-6 border-l-2 border-[#15A5ED]">
                        <div
                            class="absolute -left-[5px] top-0 w-2 h-2 bg-[#15A5ED] rounded-full shadow-[0_0_8px_#15A5ED]">
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
                            Featured <span class="text-[#15A5ED] font-light">Products</span>
                        </h2>
                        <p class="mt-1 text-xs font-mono text-slate-400 uppercase tracking-widest">
                            Verified_Systems // 2026_Edition
                        </p>
                    </div>

                    <a href="{{ route('shop.index') }}"
                        class="group inline-flex items-center text-xs font-bold uppercase tracking-widest text-slate-500 hover:text-[#15A5ED] transition-all">
                        Explore more
                        <span
                            class="ml-2 w-8 h-[1px] bg-slate-300 group-hover:w-12 group-hover:bg-[#15A5ED] transition-all"></span>
                    </a>
                </div>

                @if ($featured->count())
                    <div class="grid grid-cols-2 lg:grid-cols-5 gap-5">
                        @foreach ($featured as $product)
                            <a href="{{ route('shop.show', $product->slug) }}"
                                class="group relative bg-white/70 backdrop-blur-md rounded-2xl border border-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgba(21,165,237,0.1)] hover:border-[#15A5ED]/30 transition-all duration-500 flex flex-col overflow-hidden">

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

                                    {{-- Heart Button --}}
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
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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

                                    {{-- Category --}}
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
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                {{-- Hover Bottom Bar --}}
                                <div class="h-1 w-0 bg-[#15A5ED] group-hover:w-full transition-all duration-500"></div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-20 border-2 border-dashed border-slate-200 rounded-3xl">
                        <p class="font-mono text-sm text-slate-400">DATABASE_EMPTY: Please insert records.</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- Trust & Value Section --}}
        <section class="relative bg-white border-t border-slate-100 overflow-hidden">
            {{-- Background Tech Detail --}}
            <div
                class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-[#15A5ED]/20 to-transparent">
            </div>

            <div class="max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-20 relative">

                {{-- Decorative Corner Brackets --}}
                <div class="absolute top-10 left-8 w-4 h-4 border-t border-l border-slate-200"></div>
                <div class="absolute bottom-10 right-8 w-4 h-4 border-b border-r border-slate-200"></div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">

                    {{-- Delivery Component --}}
                    <div class="flex items-start gap-5 group">
                        <div class="relative flex-shrink-0">
                            <div
                                class="w-14 h-14 flex items-center justify-center rounded-xl bg-slate-50 border border-slate-100 text-slate-400 group-hover:text-[#15A5ED] group-hover:border-[#15A5ED]/30 group-hover:bg-white group-hover:shadow-[0_0_20px_rgba(21,165,237,0.15)] transition-all duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V11.25c0-4.446-3.51-8.11-8.048-8.11h-.852a4.482 4.482 0 00-4.488 4.488v2.602M19.5 14.25l-2.25-6.75m-10.5 6.75h12.75" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="w-1 h-1 rounded-full bg-[#15A5ED] group-hover:animate-ping"></span>
                                <h4 class="text-sm font-mono font-bold text-slate-900 uppercase tracking-[0.15em]">
                                    Logistics.v1</h4>
                            </div>
                            <p class="text-base text-slate-500 leading-snug">
                                Fast delivery processed in <span class="text-slate-900 font-bold">1–3 business
                                    days</span>.
                            </p>
                        </div>
                    </div>

                    {{-- Payment Component --}}
                    <div class="flex items-start gap-5 group">
                        <div class="relative flex-shrink-0">
                            <div
                                class="w-14 h-14 flex items-center justify-center rounded-xl bg-slate-50 border border-slate-100 text-slate-400 group-hover:text-[#15A5ED] group-hover:border-[#15A5ED]/30 group-hover:bg-white group-hover:shadow-[0_0_20px_rgba(21,165,237,0.15)] transition-all duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.744c0 5.052 3.823 9.213 8.712 9.637.222.019.447.029.672.029.224 0 .449-.01.671-.029 4.89-.423 8.713-4.585 8.713-9.637 0-1.305-.209-2.56-.598-3.744A11.959 11.959 0 0112 2.714z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="w-1 h-1 rounded-full bg-[#15A5ED]"></span>
                                <h4 class="text-sm font-mono font-bold text-slate-900 uppercase tracking-[0.15em]">
                                    Secure.Enc</h4>
                            </div>
                            <p class="text-base text-slate-500 leading-snug">
                                Transactions via <span class="text-slate-900 font-bold">Industry Standard</span> SSL
                                encryption.
                            </p>
                        </div>
                    </div>

                    {{-- Returns Component --}}
                    <div class="flex items-start gap-5 group">
                        <div class="relative flex-shrink-0">
                            <div
                                class="w-14 h-14 flex items-center justify-center rounded-xl bg-slate-50 border border-slate-100 text-slate-400 group-hover:text-[#15A5ED] group-hover:border-[#15A5ED]/30 group-hover:bg-white group-hover:shadow-[0_0_20_rgba(21,165,237,0.15)] transition-all duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="w-1 h-1 rounded-full bg-[#15A5ED]"></span>
                                <h4 class="text-sm font-mono font-bold text-slate-900 uppercase tracking-[0.15em]">
                                    Return.Poly</h4>
                            </div>
                            <p class="text-base text-slate-500 leading-snug">
                                Hassle-free <span class="text-slate-900 font-bold">14-day return</span> policy for all
                                hardware.
                            </p>
                        </div>
                    </div>

                    {{-- Local Component --}}
                    <div class="flex items-start gap-5 group">
                        <div class="relative flex-shrink-0">
                            <div
                                class="w-14 h-14 flex items-center justify-center rounded-xl bg-slate-50 border border-slate-100 text-slate-400 group-hover:text-[#15A5ED] group-hover:border-[#15A5ED]/30 group-hover:bg-white group-hover:shadow-[0_0_20px_rgba(21,165,237,0.15)] transition-all duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="w-1 h-1 rounded-full bg-[#15A5ED]"></span>
                                <h4 class="text-sm font-mono font-bold text-slate-900 uppercase tracking-[0.15em]">
                                    Origin.MY</h4>
                            </div>
                            <p class="text-base text-slate-500 leading-snug">
                                Proudly <span class="text-slate-900 font-bold">Malaysian-owned</span> and operated.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- Bottom CTA Section --}}
        <section class="relative bg-white overflow-hidden border-b border-slate-100">
            {{-- Technical Background Glow --}}
            <div
                class="absolute bottom-0 right-0 w-96 h-96 bg-[#15A5ED]/5 rounded-full blur-[100px] -translate-x-1/4 translate-y-1/2">
            </div>
            <div class="absolute top-0 left-0 w-full h-px bg-slate-100"></div>

            <div class="relative max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
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
                                Launch Store
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
                            Directory
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
</x-app-layout>
