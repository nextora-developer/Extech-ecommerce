@extends('admin.layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">Referral Reports</h1>
            <p class="text-sm text-gray-500 mt-1">Track referral commissions and referred order performance.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        {{-- Total Commission Card --}}
        <div
            class="relative overflow-hidden bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm group hover:shadow-md transition-all duration-300">
            <div
                class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity">
            </div>

            <div class="relative flex items-center gap-4">
                <div
                    class="flex-shrink-0 w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V7m0 1v8" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-[0.15em] font-bold text-gray-400">Total Commission</p>
                    <div class="flex items-baseline gap-1 mt-0.5">
                        <span class="text-xs font-bold text-emerald-600/60 uppercase">RM</span>
                        <h3 class="text-2xl font-black text-gray-900 tracking-tight">
                            {{ number_format($summary['total_commission_rm'], 2) }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Points Awarded Card --}}
        <div
            class="relative overflow-hidden bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm group hover:shadow-md transition-all duration-300">
            <div
                class="absolute -right-4 -top-4 w-24 h-24 bg-sky-50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity">
            </div>

            <div class="relative flex items-center gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-[0.15em] font-bold text-gray-400">Points Awarded</p>
                    <div class="flex items-baseline gap-1 mt-0.5">
                        <h3 class="text-2xl font-black text-gray-900 tracking-tight">
                            {{ number_format($summary['total_points_awarded'], 0) }}
                        </h3>
                        <span class="text-[10px] font-bold text-sky-600 uppercase">PTS</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Records Card --}}
        <div
            class="relative overflow-hidden bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm group hover:shadow-md transition-all duration-300">
            <div
                class="absolute -right-4 -top-4 w-24 h-24 bg-gray-50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity">
            </div>

            <div class="relative flex items-center gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-gray-100 text-gray-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-[0.15em] font-bold text-gray-400">Total Records</p>
                    <h3 class="text-2xl font-black text-gray-900 tracking-tight mt-0.5">
                        {{ number_format($summary['total_records']) }}
                    </h3>
                </div>
            </div>
        </div>

    </div>

    <div class="bg-white border border-gray-100 rounded-[1.5rem] p-5 shadow-sm mb-6 transition-all hover:shadow-md">
        <form method="GET" class="space-y-4">

            {{-- Filters Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                {{-- Search Bar (Dominant 6-col span) --}}
                <div class="md:col-span-6 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400 group-focus-within:text-[#D4AF37] transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="keyword" value="{{ request('keyword') }}"
                        placeholder="Search agent, customer, order no..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:ring-2 focus:ring-[#D4AF37]/20 focus:border-[#D4AF37] text-sm transition-all" />
                </div>

                {{-- Date Range Group (Combined 6-col span) --}}
                <div class="md:col-span-6 flex items-center gap-2">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">From</span>
                        </div>
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                            class="w-full pl-11 py-2.5 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white text-sm focus:ring-[#D4AF37]/20 focus:border-[#D4AF37] transition-all" />
                    </div>

                    <div class="h-px w-4 bg-gray-300"></div>

                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">To</span>
                        </div>
                        <input type="date" name="end_date" value="{{ request('end_date') }}"
                            class="w-full pl-8 py-2.5 rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white text-sm focus:ring-[#D4AF37]/20 focus:border-[#D4AF37] transition-all" />
                    </div>
                </div>
            </div>

            {{-- Action Buttons Row --}}
            <div class="flex items-center justify-between pt-2">
                {{-- Quick Stats / Feedback --}}
                <div class="hidden sm:block text-xs text-gray-400 font-medium italic">
                    Press enter to apply filters quickly
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <a href="{{ route(request()->route()->getName()) }}"
                        class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200 text-gray-500 font-bold text-sm hover:bg-gray-50 hover:text-gray-700 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset
                    </a>

                    <button type="submit"
                        class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-2.5 rounded-xl bg-[#D4AF37] text-white font-bold text-sm hover:bg-[#c89d1c] transition-all shadow-lg shadow-[#D4AF37]/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 8.293A1 1 0 013 7.586V4z" />
                        </svg>
                        Apply Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr class="text-left text-gray-500 uppercase text-[11px] tracking-wider">
                        <th class="px-5 py-4">Order</th>
                        <th class="px-5 py-4">Agent</th>
                        <th class="px-5 py-4">Customer</th>
                        <th class="px-5 py-4">Subtotal</th>
                        <th class="px-5 py-4">Rate</th>
                        <th class="px-5 py-4">Commission</th>
                        <th class="px-5 py-4">Points</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($referrals as $row)
                        <tr>
                            <td class="px-5 py-4 font-bold text-gray-900">
                                {{ $row->order->order_no ?? '—' }}
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-bold text-gray-900">{{ $row->agent->user->name ?? '—' }}</div>
                                <div class="text-xs text-gray-400">{{ $row->agent->user->email ?? '' }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-bold text-gray-900">{{ $row->user->name ?? '—' }}</div>
                                <div class="text-xs text-gray-400">{{ $row->user->email ?? '' }}</div>
                            </td>
                            <td class="px-5 py-4">RM {{ number_format($row->order_subtotal, 2) }}</td>
                            <td class="px-5 py-4">{{ number_format($row->commission_percent, 2) }}%</td>
                            <td class="px-5 py-4 font-bold text-emerald-600">RM
                                {{ number_format($row->commission_amount_rm, 2) }}</td>
                            <td class="px-5 py-4 font-bold text-sky-600">{{ number_format($row->points_awarded, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-gray-400">No referral records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-100">
            {{ $referrals->links() }}
        </div>
    </div>
@endsection
