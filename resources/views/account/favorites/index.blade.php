<x-app-layout>
    <div class="bg-[#f7f7f9] min-h-screen py-10">
        <div class="max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-xs font-medium uppercase tracking-widest text-gray-400 mb-8">
                <a href="{{ route('home') }}" class="hover:text-[#8f6a10] transition-colors">Home</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-gray-900">Wishlist</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                {{-- Left Sidebar --}}
                <aside class="lg:col-span-1">
                    @include('account.partials.sidebar')
                </aside>

                {{-- Right Content --}}
                <main class="lg:col-span-3 space-y-6">

                    {{-- Header Section --}}
                    <section class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                            <div>
                                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Wishlist</h1>
                                <p class="text-gray-500 mt-2 max-w-md">
                                    A curated collection of items you love. Save them here and come back when you're
                                    ready.
                                </p>
                            </div>
                            @if ($favorites->total() > 0)
                                <div
                                    class="inline-flex items-center px-4 py-2 bg-gray-50 rounded-2xl border border-gray-100">
                                    <span class="text-sm font-bold text-gray-900">{{ $favorites->total() }}</span>
                                    <span
                                        class="ml-1.5 text-xs font-medium text-gray-500 uppercase tracking-wider">Items</span>
                                </div>
                            @endif
                        </div>
                    </section>

                    {{-- Favorites Grid --}}
                    @if ($favorites->isEmpty())
                        <section class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 text-center">
                            <div class="max-w-xs mx-auto">
                                <div
                                    class="w-16 h-16 bg-gray-50 text-gray-300 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-8 h-8 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg> </div>
                                <h3 class="font-bold text-gray-900">Your wishlist is empty</h3>
                                <p class="text-gray-500 text-sm mt-1">Start exploring our collection and save your
                                    favorite pieces.</p> <a href="{{ route('shop.index') }}"
                                    class="mt-6 inline-flex items-center px-6 py-2.5 bg-black text-white text-sm font-bold rounded-xl transition-all duration-300 ease-out hover:bg-black hover:text-white hover:-translate-y-0.5 hover:scale-[1.03] hover:shadow-xl hover:shadow-gray/30">
                                    Start Shopping </a>
                            </div>
                        </section>
                    @else
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-5">
                            @foreach ($favorites as $favorite)
                                @php $product = $favorite->product; @endphp
                                @if ($product)
                                    <a href="{{ route('shop.show', $product->slug) }}"
                                        class="group relative bg-white/70 backdrop-blur-md rounded-2xl border border-white
                           shadow-[0_8px_30px_rgb(0,0,0,0.04)]
                           hover:shadow-[0_20px_40px_rgba(21,165,237,0.1)]
                           hover:border-[#15A5ED]/30 transition-all duration-500
                           flex flex-col overflow-hidden">

                                        {{-- Image --}}
                                        <div
                                            class="relative aspect-square bg-[#F1F5F9]/50 overflow-hidden m-2 rounded-xl">
                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-700">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center text-[10px] font-mono text-slate-300">
                                                    IMG_NOT_FOUND
                                                </div>
                                            @endif

                                            {{-- ❤️ Remove Favorite --}}
                                            <form action="{{ route('account.favorites.destroy', $product) }}"
                                                method="POST" class="absolute top-2 right-2 z-20"
                                                onclick="event.preventDefault(); event.stopPropagation(); this.submit();">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-white/80 backdrop-blur
                                       border border-slate-100 text-[#15A5ED]
                                       hover:bg-[#15A5ED] hover:text-white transition-all">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 24 24" class="h-4 w-4">
                                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                                        2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09
                                        C13.09 3.81 14.76 3 16.5 3
                                        19.58 3 22 5.42 22 8.5
                                        c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        {{-- Content --}}
                                        <div class="p-4 pt-2 flex-1 flex flex-col">
                                            {{-- Status --}}
                                            <div class="flex items-center gap-2 mb-3">
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                                <span
                                                    class="text-[10px] font-mono text-slate-400 uppercase tracking-tighter">
                                                    Saved_Item
                                                </span>
                                            </div>

                                            {{-- Category --}}
                                            <div class="text-xs font-mono text-slate-400 uppercase tracking-widest">
                                                {{ $product->category->name ?? 'UNCATEGORIZED' }}
                                            </div>

                                            {{-- Name --}}
                                            <h3
                                                class="mt-1 text-base font-bold text-slate-800 line-clamp-2
                                   group-hover:text-[#15A5ED] transition-colors">
                                                {{ $product->name }}
                                            </h3>

                                            {{-- Price --}}
                                            <div class="mt-4 text-base font-mono font-bold text-slate-900">
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
                                                            class="text-[10px] text-slate-400 uppercase mr-1">From</span>
                                                        RM {{ number_format($min, 2) }}
                                                    @endif
                                                @else
                                                    RM {{ number_format($product->price ?? 0, 2) }}
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Hover bottom bar --}}
                                        <div
                                            class="h-1 w-0 bg-[#15A5ED] group-hover:w-full transition-all duration-500">
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>

                        <div class="mt-12">
                            {{ $favorites->links() }}
                        </div>
                    @endif


                </main>
            </div>
        </div>
    </div>
</x-app-layout>
