@if ($paginator->hasPages())
    <nav class="flex items-center justify-center gap-3 select-none py-6" role="navigation">
        
        {{-- Previous Page --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center justify-center h-11 px-5 rounded-2xl border border-gray-100 bg-gray-50/50 text-sm font-medium text-gray-300 cursor-not-allowed">
                Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="inline-flex items-center justify-center h-11 px-5 rounded-2xl border border-gray-200 bg-white text-sm font-semibold text-gray-700 shadow-sm
                      hover:shadow-md hover:border-[#15A5ED]/30 hover:text-[#15A5ED]
                      hover:-translate-y-0.5 transition-all duration-200 active:scale-95">
                Previous
            </a>
        @endif

        {{-- Page Numbers --}}
        <div class="hidden md:flex items-center gap-2">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="w-10 text-center text-gray-400 font-medium">···</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="inline-flex items-center justify-center h-11 w-11 rounded-2xl 
                                         bg-[#15A5ED] text-white text-sm font-bold 
                                         shadow-lg shadow-[#15A5ED]/30 ring-2 ring-[#15A5ED]/10">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="inline-flex items-center justify-center h-11 w-11 rounded-2xl border border-gray-200 bg-white text-sm font-semibold text-gray-600
                                      hover:border-[#15A5ED]/40 hover:text-[#15A5ED] hover:bg-[#15A5ED]/5
                                      hover:shadow-sm transition-all duration-200">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="inline-flex items-center justify-center h-11 px-5 rounded-2xl border border-gray-200 bg-white text-sm font-semibold text-gray-700 shadow-sm
                      hover:shadow-md hover:border-[#15A5ED]/30 hover:text-[#15A5ED]
                      hover:-translate-y-0.5 transition-all duration-200 active:scale-95">
                Next
            </a>
        @else
            <span class="inline-flex items-center justify-center h-11 px-5 rounded-2xl border border-gray-100 bg-gray-50/50 text-sm font-medium text-gray-300 cursor-not-allowed">
                Next
            </span>
        @endif
    </nav>
@endif