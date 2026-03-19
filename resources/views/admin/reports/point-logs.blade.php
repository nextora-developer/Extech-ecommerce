@extends('admin.layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">Point Logs Report</h1>
            <p class="text-sm text-gray-500 mt-1">Track all point earnings, redemptions and adjustments.</p>
        </div>
    </div>

    <div class="bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm mb-8 transition-all hover:shadow-md">
    <form method="GET" class="space-y-6">

        {{-- Filters Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-5">

            {{-- Search Bar (Spans 2 columns) --}}
            <div class="xl:col-span-2 relative group">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400 group-focus-within:text-[#D4AF37] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="keyword" value="{{ request('keyword') }}"
                    placeholder="Search agent, email, remark..."
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-200 bg-gray-50/30 focus:bg-white focus:ring-2 focus:ring-[#D4AF37]/20 focus:border-[#D4AF37] text-sm transition-all" />
            </div>

            {{-- Type --}}
            <div class="relative">
                <select name="type" class="w-full rounded-xl border-gray-200 bg-gray-50/30 focus:bg-white text-sm focus:ring-[#D4AF37]/20 focus:border-[#D4AF37] transition-all cursor-pointer">
                    <option value="">All Types</option>
                    <option value="commission" @selected(request('type') === 'commission')>Commission</option>
                    <option value="redeem" @selected(request('type') === 'redeem')>Redeem</option>
                    <option value="admin_adjustment" @selected(request('type') === 'admin_adjustment')>Admin Adjustment</option>
                </select>
            </div>

            {{-- Direction --}}
            <div class="relative">
                <select name="direction" class="w-full rounded-xl border-gray-200 bg-gray-50/30 focus:bg-white text-sm focus:ring-[#D4AF37]/20 focus:border-[#D4AF37] transition-all cursor-pointer">
                    <option value="">All Directions</option>
                    <option value="in" @selected(request('direction') === 'in')>IN (Points Earned)</option>
                    <option value="out" @selected(request('direction') === 'out')>OUT (Points Used)</option>
                </select>
            </div>

            {{-- Date Range (Grouped look) --}}
            <div class="xl:col-span-2 grid grid-cols-2 gap-2">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[10px] font-bold text-gray-400 uppercase">From</div>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="w-full pl-12 rounded-xl border-gray-200 bg-gray-50/30 focus:bg-white text-sm focus:ring-[#D4AF37]/20 focus:border-[#D4AF37] transition-all" />
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[10px] font-bold text-gray-400 uppercase">To</div>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="w-full pl-8 rounded-xl border-gray-200 bg-gray-50/30 focus:bg-white text-sm focus:ring-[#D4AF37]/20 focus:border-[#D4AF37] transition-all" />
                </div>
            </div>
        </div>

        {{-- Action Buttons Row --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-t border-gray-50 pt-5 gap-4">
            
            <div class="text-xs text-gray-400 italic">
                Showing results based on your current filters
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route(request()->route()->getName()) }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-bold text-sm hover:bg-gray-50 hover:text-gray-900 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    Reset
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-8 py-2.5 rounded-xl bg-[#D4AF37] text-white font-bold text-sm hover:bg-[#b8962d] transition-all shadow-lg shadow-[#D4AF37]/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 8.293A1 1 0 013 7.586V4z" /></svg>
                    Apply Filters
                </button>

                <div class="w-[1px] h-8 bg-gray-100 mx-1 hidden sm:block"></div>

                <a href="{{ route('admin.reports.point-logs.export', request()->query()) }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 font-bold text-sm hover:bg-emerald-600 hover:text-white transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Export CSV
                </a>
            </div>
        </div>
    </form>
</div>
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr class="text-left text-gray-500 uppercase text-[11px] tracking-wider">
                        <th class="px-5 py-4">Date</th>
                        <th class="px-5 py-4">Agent</th>
                        <th class="px-5 py-4">Type</th>
                        <th class="px-5 py-4">Direction</th>
                        <th class="px-5 py-4">Points</th>
                        <th class="px-5 py-4">Reference</th>
                        <th class="px-5 py-4">Remark</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($pointLogs as $log)
                        <tr>
                            <td class="px-5 py-4 text-gray-600">{{ $log->created_at?->format('d M Y, H:i') }}</td>
                            <td class="px-5 py-4">
                                <div class="font-bold text-gray-900">{{ $log->agent->user->name ?? '—' }}</div>
                                <div class="text-xs text-gray-400">{{ $log->agent->user->email ?? '' }}</div>
                            </td>
                            <td class="px-5 py-4">{{ ucfirst(str_replace('_', ' ', $log->type)) }}</td>
                            <td class="px-5 py-4">
                                <span
                                    class="px-2 py-1 rounded-full text-[10px] font-bold {{ $log->direction === 'in' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                    {{ strtoupper($log->direction) }}
                                </span>
                            </td>
                            <td
                                class="px-5 py-4 font-bold {{ $log->direction === 'in' ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $log->direction === 'in' ? '+' : '-' }}{{ number_format($log->points, 2) }}
                            </td>
                            <td class="px-5 py-4 text-gray-500">
                                {{ $log->reference_type ? $log->reference_type . ' #' . $log->reference_id : '—' }}
                            </td>
                            <td class="px-5 py-4 text-gray-600">{{ $log->remark ?: '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-gray-400">No point logs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-100">
            {{ $pointLogs->links() }}
        </div>
    </div>
@endsection
