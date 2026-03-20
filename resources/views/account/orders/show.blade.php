<x-app-layout>
    <div class="bg-[#F4F8FD] min-h-screen py-6 md:py-10">
        <div class="max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="hidden sm:flex items-center uppercase space-x-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-[#15a5ed] transition-colors">Home</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('home') }}" class="hover:text-[#15a5ed] transition-colors">Orders</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <span class="text-gray-900 font-medium">{{ $order->order_no }}</span>
            </nav>

            <div class="sm:hidden flex items-center justify-center relative mb-6">
                {{-- Back Button --}}
                <a href="{{ route('account.orders.index') }}" class="absolute left-0 p-2 text-gray-500 hover:text-[#15A5ED] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>

                {{-- Title --}}
                <h1 class="text-lg font-bold text-gray-900">
                    Orders Details
                </h1>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

                <aside class="hidden md:block lg:col-span-1">
                    @include('account.partials.sidebar')
                </aside>

                <main class="lg:col-span-3 space-y-5">

                    {{-- Header --}}
                    <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3 md:gap-4">

                            {{-- 左侧：订单号 + 时间 --}}
                            <div>
                                <h1
                                    class="text-xl md:text-2xl font-semibold text-[#0A0A0C] flex flex-col md:flex-row md:items-center gap-1 md:gap-2">
                                    <span>Order</span>
                                    <span class="text-[#6DBAE1] break-all">
                                        #{{ $order->order_no }}
                                    </span>
                                </h1>

                                <p class="text-sm text-gray-500 mt-1">
                                    Placed on {{ $order->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>

                            @php
                                $colors = [
                                    'pending' => 'bg-amber-50 text-amber-700 border border-amber-200',
                                    'paid' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                                    'processing' => 'bg-indigo-50 text-indigo-700 border border-indigo-200',
                                    'shipped' => 'bg-blue-50 text-blue-700 border border-blue-200',
                                    'completed' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                                    'cancelled' => 'bg-gray-50 text-gray-600 border border-gray-200',
                                    'failed' => 'bg-rose-50 text-rose-700 border border-rose-200',
                                ];
                            @endphp

                            {{-- 右侧：状态 + 按钮（手机会自动掉到第二行） --}}
                            <div class="flex items-center gap-2 md:gap-3 mt-1 md:mt-0">

                                {{-- Status Badge --}}
                                <span
                                    class="px-3 py-1 rounded-full text-xs md:text-sm font-medium shadow-sm
                   {{ $colors[$order->status] ?? 'bg-gray-100 text-gray-500' }}">
                                    {{ ucfirst($order->status) }}
                                </span>

                                {{-- Order Received Button（只在 shipped 时出现） --}}
                                @if ($order->status === 'shipped')
                                    <form method="POST" action="{{ route('account.orders.complete', $order) }}">
                                        @csrf
                                        <button
                                            class="inline-flex items-center gap-1.5 px-3 md:px-4 py-1.5 md:py-2 rounded-xl
                           bg-emerald-600 text-white text-xs md:text-sm font-semibold
                           hover:bg-emerald-700 active:scale-95 transition">
                                            <span class="text-sm">✓</span>
                                            <span>Order Received</span>
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('account.orders.invoice.preview', $order) }}" target="_blank"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#0F172A] text-white text-sm font-bold hover:bg-black transition-all shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                    Invoice
                                </a>

                            </div>

                        </div>


                        {{-- 🔥 REFINED ORDER STATUS BAR --}}
                        @php
                            $allSteps = [
                                'pending' => [
                                    'label' => 'Pending',
                                    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                                ],
                                'paid' => [
                                    'label' => 'Paid',
                                    'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                                ],
                                'processing' => [
                                    'label' => 'Processing',
                                    'icon' =>
                                        'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
                                ],
                                'shipped' => [
                                    'label' => 'Shipped',
                                    'icon' =>
                                        'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4',
                                ],
                                'completed' => [
                                    'label' => 'Received',
                                    'icon' => 'M5 13l4 4L19 7',
                                ],

                                // 🟡 Cancelled
                                'cancelled' => [
                                    'label' => 'Cancelled',
                                    'icon' => 'M12 2a10 10 0 110 20 10 10 0 010-20M9 9l6 6M15 9l-6 6',
                                ],

                                // 🔴 Failed
                                'failed' => [
                                    'label' => 'Failed',
                                    'icon' => 'M6 18L18 6M6 6l12 12',
                                ],
                            ];

                            $status = $order->status;

                            // ⭐ 默认不显示 cancelled / failed
                            $steps = $allSteps;
                            unset($steps['cancelled'], $steps['failed']);

                            // ⭐ 如果是 cancelled → 只加入 cancelled
                            if ($status === 'cancelled') {
                                $steps['cancelled'] = $allSteps['cancelled'];
                            }

                            // ⭐ 如果是 failed → 只加入 failed
                            if ($status === 'failed') {
                                $steps['failed'] = $allSteps['failed'];
                            }

                            $orderFlow = array_keys($steps);
                            $currentIndex = array_search($status, $orderFlow);
                        @endphp



                        <div class="mt-10 mb-12 px-1 sm:px-2">
                            <div class="flex items-center">
                                @foreach ($steps as $key => $data)
                                    @php
                                        $index = array_search($key, $orderFlow);
                                        $isDone = $index <= $currentIndex;
                                        $isLast = $loop->last;
                                    @endphp

                                    <div class="flex items-center {{ !$isLast ? 'flex-1' : '' }}">
                                        {{-- Step Point --}}
                                        <div class="relative flex flex-col items-center">
                                            <div
                                                class="w-8 h-8 sm:w-10 sm:h-10
                               rounded-xl sm:rounded-2xl
                               flex items-center justify-center transition-all duration-500 border
                        {{ $isDone
                            ? 'bg-black border-black text-white shadow-lg shadow-black/20'
                            : 'bg-white border-gray-300 text-gray-500' }}">

                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5" d="{{ $data['icon'] }}" />
                                                </svg>
                                            </div>

                                            {{-- Label (mobile tighter) --}}
                                            <div class="absolute -bottom-7 whitespace-nowrap">
                                                <span
                                                    class="text-[8px] sm:text-[9px]
                                   font-black uppercase
                                   tracking-[0.12em] sm:tracking-[0.2em]
                                   transition-colors duration-300
                            {{ $isDone ? 'text-black' : 'text-gray-500' }}">
                                                    {{ $data['label'] }}
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Connector Line (mobile shorter) --}}
                                        @if (!$isLast)
                                            <div
                                                class="h-[2px]
                               mx-1 sm:mx-2 md:mx-4
                               rounded-full overflow-hidden bg-gray-100
                               w-4 sm:w-6 md:flex-1 flex-none">
                                                <div
                                                    class="h-full transition-all duration-1000 ease-out
                            {{ $isDone && $currentIndex > $index ? 'w-full bg-[#D4AF37]' : 'w-0' }}">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- 🔥 END STATUS BAR --}}

                        {{-- 3 : 2 Layout --}}
                        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 pt-5">

                            {{-- 🟡 Left Side (3/5) --}}
                            <div class="lg:col-span-3 space-y-6">
                                @php
                                    $hasPhysicalItems = $order->items->contains(
                                        fn($item) => !$item->product?->is_digital,
                                    );
                                    $digitalItems = $order->items->filter(
                                        fn($item) => $item->product?->is_digital && !empty($item->customer_input_data),
                                    );
                                    $hasDigitalFulfillment = !$hasPhysicalItems && !empty($order->admin_note);
                                @endphp

                                {{-- Top Row: Customer & Delivery Info --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    {{-- Customer Card --}}
                                    <div
                                        class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
                                        <div class="flex items-center gap-2 mb-4">

                                            <h2 class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">
                                                Customer Details</h2>
                                        </div>
                                        <div class="space-y-1">
                                            <p class="text-gray-900 font-semibold text-base">
                                                {{ $order->customer_name }}</p>
                                            <p class="text-gray-600 text-sm flex items-center gap-2">
                                                <span class="text-gray-400">Phone:</span> {{ $order->customer_phone }}
                                            </p>
                                            <p class="text-gray-600 text-sm flex items-center gap-2">
                                                <span class="text-gray-400">Email:</span> {{ $order->customer_email }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Shipping / Digital Info Card --}}
                                    <div
                                        class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center gap-2">

                                                <h2
                                                    class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">
                                                    {{ $hasPhysicalItems ? 'Shipping Address' : 'Digital Delivery' }}
                                                </h2>
                                            </div>

                                            @if ($hasPhysicalItems && ($order->shipping_courier || $order->tracking_number))
                                                <button type="button"
                                                    onclick="openTrackingModal({{ $order->id }})"
                                                    class="text-xs font-bold text-indigo-600 hover:text-indigo-800 bg-indigo-50 px-3 py-1 rounded-full transition-colors">Track</button>
                                            @elseif ($hasDigitalFulfillment)
                                                <button type="button"
                                                    onclick="openDigitalFulfillmentModal({{ $order->id }})"
                                                    class="text-xs font-bold text-emerald-600 hover:text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full transition-colors">View
                                                    Keys</button>
                                            @endif
                                        </div>

                                        @if ($hasPhysicalItems)
                                            <div class="text-gray-700 leading-relaxed text-sm">
                                                {{ $order->address_line1 }}<br>
                                                @if ($order->address_line2)
                                                    {{ $order->address_line2 }}<br>
                                                @endif
                                                <span class="font-medium text-gray-900">{{ $order->postcode }}
                                                    {{ $order->city }}</span><br>
                                                {{ $order->state }}{{ $order->country ? ', ' . $order->country : '' }}
                                            </div>
                                        @else
                                            <div class="space-y-3">
                                                @forelse ($digitalItems as $item)
                                                    <div class="text-sm">
                                                        <p class="font-semibold text-gray-900 line-clamp-1">
                                                            {{ $item->product_name }}</p>
                                                        <div class="mt-1 pl-3 border-l-2 border-gray-100 space-y-1">
                                                            @foreach ($item->customer_input_data as $key => $value)
                                                                <div class="flex justify-between text-xs">
                                                                    <span
                                                                        class="text-gray-400">{{ ucwords(str_replace('_', ' ', $key)) }}</span>
                                                                    <span
                                                                        class="text-gray-700 font-mono">{{ $value }}</span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @empty
                                                    <p class="text-sm text-gray-400 italic text-center py-2">
                                                        No additional information was required for this digital item.
                                                    </p>
                                                @endforelse
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Order Remark (Full Width) --}}
                                <div class="rounded-2xl border border-gray-100 bg-gray-50/50 p-6 shadow-sm">
                                    <h2 class="text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-2">
                                        Order Remark</h2>
                                    <p
                                        class="text-sm leading-relaxed {{ $order->remark ? 'text-gray-700' : 'text-gray-400' }}">
                                        {{ $order->remark ? trim($order->remark) : 'No specific instructions provided by customer.' }}
                                    </p>
                                </div>
                            </div>

                            {{-- 🟣 Right Side (2/5): Order Summary --}}
                            <div class="lg:col-span-2">
                                <div
                                    class="sticky top-6 rounded-3xl border border-blue-100 bg-gradient-to-b from-[#F9FCFF] to-[#F4F8FD] p-6 shadow-sm">
                                    <h2 class="font-bold text-gray-900 text-lg mb-6 flex items-center gap-2">
                                        Order Summary
                                        <span class="h-1 w-1 rounded-full bg-blue-400"></span>
                                    </h2>

                                    <div class="space-y-4">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Subtotal</span>
                                            <span class="font-medium text-gray-900 font-mono">RM
                                                {{ number_format($order->subtotal, 2) }}</span>
                                        </div>

                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Shipping Fee</span>
                                            <span class="font-medium text-gray-900 font-mono">RM
                                                {{ number_format($order->shipping_fee, 2) }}</span>
                                        </div>

                                        @if (($order->points_redeemed ?? 0) > 0)
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-500">Points Redeemed</span>
                                                <span class="font-bold text-blue-600 font-mono">
                                                    {{ number_format($order->points_redeemed, 2) }} pts
                                                </span>
                                            </div>

                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-500">Points Discount</span>
                                                <span class="font-bold text-emerald-600 font-mono">
                                                    - RM {{ number_format($order->points_discount_rm, 2) }}
                                                </span>
                                            </div>
                                        @endif

                                        <div class="pt-4 border-t border-blue-200/50">
                                            <div class="flex justify-between items-end">
                                                <span
                                                    class="text-sm font-bold text-gray-900 uppercase tracking-tight">Total
                                                    Amount</span>
                                                <span
                                                    class="text-3xl font-black text-blue-600 font-mono tracking-tighter">
                                                    RM {{ number_format($order->total, 2) }}
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Payment Status --}}
                                        <div class="mt-6 p-4 rounded-2xl bg-white/60 border border-white space-y-3">
                                            <div class="flex justify-between items-center">
                                                <span
                                                    class="text-xs font-semibold text-gray-400 uppercase">Method</span>
                                                <span
                                                    class="text-sm font-bold text-gray-800">{{ $order->payment_method_name }}</span>
                                            </div>

                                            @if ($order->payment_receipt_path)
                                                <div class="grid grid-cols-2 gap-2 pt-1">
                                                    <button type="button"
                                                        onclick="openReceiptModal({{ $order->id }})"
                                                        class="flex justify-center items-center px-3 py-2 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-xs font-bold text-gray-700 transition-all">
                                                        View Receipt
                                                    </button>
                                                    <a href="{{ asset('storage/' . $order->payment_receipt_path) }}"
                                                        download
                                                        class="flex justify-center items-center px-3 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-xs font-bold text-white shadow-sm shadow-blue-200 transition-all">
                                                        Download
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        {{-- Items --}}
                        <h2 class="font-semibold text-[#0A0A0C] text-base mt-8 mb-4">Items</h2>

                        {{-- 📱 Mobile：改成卡片列表 --}}
                        <div class="space-y-3 md:hidden">
                            @foreach ($order->items as $item)
                                <div class="rounded-2xl border border-gray-200 bg-white/80 p-4 flex gap-3">

                                    {{-- Image / Placeholder --}}
                                    @if ($item->product?->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                            class="w-14 h-14 rounded-xl object-cover flex-shrink-0">
                                    @else
                                        <div
                                            class="w-14 h-14 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-300"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="flex-1 space-y-1">
                                        {{-- 名称 + variant --}}
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 leading-snug">
                                                {{ $item->product_name }}
                                            </p>
                                            @if ($item->variant_label)
                                                <p class="text-xs text-gray-500">
                                                    {{ $item->variant_label }}
                                                </p>
                                            @endif
                                        </div>

                                        {{-- 小 summary 行 --}}
                                        <div class="mt-2 grid grid-cols-2 gap-x-4 gap-y-1 text-xs">
                                            <div class="text-gray-500">Qty</div>
                                            <div class="text-right text-gray-900 font-medium">
                                                {{ $item->qty }}
                                            </div>

                                            <div class="text-gray-500">Unit Price</div>
                                            <div class="text-right text-gray-900">
                                                RM {{ number_format($item->unit_price, 2) }}
                                            </div>

                                            <div class="text-gray-500">Subtotal</div>
                                            <div class="text-right font-semibold text-gray-900">
                                                RM {{ number_format($item->unit_price * $item->qty, 2) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- 💻 Desktop：保留 table --}}
                        <div class="hidden md:block border rounded-2xl overflow-hidden">
                            <table class="w-full text-base">
                                <thead class="bg-gray-50 text-sm text-gray-500">
                                    <tr>
                                        <th class="text-left px-4 py-3">Product</th>
                                        <th class="text-right px-4 py-3">Qty</th>
                                        <th class="text-right px-4 py-3">Unit Price</th>
                                        <th class="text-right px-4 py-3">Subtotal</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100 text-base">
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td class="px-4 py-3 text-gray-900 flex items-center gap-3">
                                                {{-- Product image OR icon placeholder --}}
                                                @if ($item->product?->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                                        class="w-12 h-12 rounded object-cover">
                                                @else
                                                    <div
                                                        class="w-12 h-12 rounded bg-gray-100 border border-gray-200 flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-6 h-6 text-gray-300" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.8"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                        </svg>
                                                    </div>
                                                @endif

                                                <div>
                                                    {{ $item->product_name }}

                                                    @if ($item->variant_label)
                                                        <div class="text-sm text-gray-500">
                                                            {{ $item->variant_label }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="px-4 py-3 text-right text-gray-700">
                                                {{ $item->qty }}
                                            </td>

                                            <td class="px-4 py-3 text-right text-gray-700">
                                                RM {{ number_format($item->unit_price, 2) }}
                                            </td>

                                            <td class="px-4 py-3 text-right font-semibold text-gray-900">
                                                RM {{ number_format($item->unit_price * $item->qty, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>

                </main>
            </div>
        </div>
    </div>

    @if ($order->payment_receipt_path)
        <div id="receiptModal-{{ $order->id }}" class="fixed inset-0 z-50 hidden bg-black/50">
            {{-- 点击背景关闭 --}}
            <div class="flex items-center justify-center min-h-screen"
                onclick="closeReceiptModal({{ $order->id }})">
                {{-- 内容卡片，阻止冒泡 --}}
                <div class="bg-white rounded-2xl shadow-xl max-w-xl w-[90%] overflow-hidden"
                    onclick="event.stopPropagation()">
                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-900">
                            Payment Receipt
                        </h3>
                        <button type="button" class="text-gray-400 hover:text-gray-600"
                            onclick="closeReceiptModal({{ $order->id }})">
                            ✕
                        </button>
                    </div>

                    <div class="p-4">
                        <img src="{{ asset('storage/' . $order->payment_receipt_path) }}" alt="Payment receipt"
                            class="max-h-[70vh] w-auto mx-auto rounded-lg shadow-sm">
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($order->shipping_courier || $order->tracking_number)
        <div id="trackingModal-{{ $order->id }}" class="fixed inset-0 z-50 hidden bg-black/50">
            {{-- 点击背景关闭 --}}
            <div class="flex items-center justify-center min-h-screen"
                onclick="closeTrackingModal({{ $order->id }})">

                {{-- 内容卡片，阻止冒泡 --}}
                <div class="bg-white rounded-2xl shadow-xl max-w-md w-[90%] overflow-hidden"
                    onclick="event.stopPropagation()">

                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-900">
                            Tracking Information
                        </h3>
                        <button type="button" class="text-gray-400 hover:text-gray-600"
                            onclick="closeTrackingModal({{ $order->id }})">
                            ✕
                        </button>
                    </div>

                    <div class="p-4 space-y-3 text-sm text-gray-900">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Courier</span>
                            <span class="font-semibold">
                                {{ $order->shipping_courier ?? '-' }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-600">Tracking No.</span>
                            <span class="font-semibold">
                                {{ $order->tracking_number ?? '-' }}
                            </span>
                        </div>

                        @if ($order->shipped_at)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipped At</span>
                                <span class="font-semibold">
                                    {{ \Illuminate\Support\Carbon::parse($order->shipped_at)->timezone('Asia/Kuala_Lumpur')->format('d M Y, h:i A') }}
                                </span>
                            </div>
                        @endif

                        @if ($order->tracking_number)
                            <div class="pt-2">
                                <a target="_blank"
                                    href="https://www.tracking.my/{{ urlencode($order->tracking_number) }}"
                                    class="inline-flex items-center px-3 py-1.5 rounded-lg bg-indigo-600
                                      text-white text-xs font-semibold hover:bg-indigo-700">
                                    Track Parcel
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    @endif

    @if ($hasDigitalFulfillment)
        <div id="digitalFulfillmentModal-{{ $order->id }}" class="fixed inset-0 z-50 hidden bg-black/50">
            <div class="flex items-center justify-center min-h-screen"
                onclick="closeDigitalFulfillmentModal({{ $order->id }})">

                <div class="bg-white rounded-2xl shadow-xl max-w-md w-[90%] overflow-hidden"
                    onclick="event.stopPropagation()">

                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-900">
                            Digital Fulfillment
                        </h3>
                        <button type="button" class="text-gray-400 hover:text-gray-600"
                            onclick="closeDigitalFulfillmentModal({{ $order->id }})">
                            ✕
                        </button>
                    </div>

                    <div class="p-4 space-y-4 text-sm text-gray-900">

                        @if ($order->processed_at)
                            <div class="flex justify-between items-start gap-4">
                                <span class="text-gray-600">Processed At</span>
                                <span class="font-semibold text-right">
                                    {{ \Illuminate\Support\Carbon::parse($order->processed_at)->timezone('Asia/Kuala_Lumpur')->format('d M Y, h:i A') }}
                                </span>
                            </div>
                        @endif

                        <div class="pt-1">
                            <div class="text-gray-600 mb-2">Fulfillment Note</div>
                            <div
                                class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm leading-relaxed whitespace-pre-line break-words">
                                {{ $order->admin_note }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <script>
        function openReceiptModal(orderId) {
            const el = document.getElementById('receiptModal-' + orderId);
            if (el) {
                el.classList.remove('hidden');
            }
        }

        function closeReceiptModal(orderId) {
            const el = document.getElementById('receiptModal-' + orderId);
            if (el) {
                el.classList.add('hidden');
            }
        }

        function openTrackingModal(orderId) {
            const el = document.getElementById('trackingModal-' + orderId);
            if (el) {
                el.classList.remove('hidden');
            }
        }

        function closeTrackingModal(orderId) {
            const el = document.getElementById('trackingModal-' + orderId);
            if (el) {
                el.classList.add('hidden');
            }
        }

        function openDigitalFulfillmentModal(orderId) {
            const el = document.getElementById('digitalFulfillmentModal-' + orderId);
            if (el) {
                el.classList.remove('hidden');
            }
        }

        function closeDigitalFulfillmentModal(orderId) {
            const el = document.getElementById('digitalFulfillmentModal-' + orderId);
            if (el) {
                el.classList.add('hidden');
            }
        }
    </script>


</x-app-layout>
