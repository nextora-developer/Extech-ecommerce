@extends('admin.layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Agents</h1>
            <p class="text-sm text-gray-500 mt-1">Manage approved agent accounts</p>
        </div>
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm mb-6 transition-all">
        <form method="GET" class="flex flex-col md:flex-row gap-3">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input name="keyword" value="{{ request('keyword') }}"
                    placeholder="Search agent code, name, email, phone..."
                    class="block w-full pl-10 pr-3 py-2.5 bg-gray-50 border-transparent rounded-xl text-sm
                    focus:bg-white focus:ring-2 focus:ring-[#D4AF37]/20 focus:border-[#D4AF37] transition-all">
            </div>

            <select name="status"
                class="min-w-[160px] py-2.5 bg-gray-50 border-transparent rounded-xl text-sm
                focus:bg-white focus:ring-2 focus:ring-[#D4AF37]/20 focus:border-[#D4AF37] transition-all">
                <option value="">All Status</option>
                <option value="active" @selected(request('status') === 'active')>Active</option>
                <option value="suspended" @selected(request('status') === 'suspended')>Suspended</option>
            </select>

            <button
                class="px-6 py-2.5 rounded-xl bg-[#D4AF37]/10 text-[#8f6a10]
                border border-[#D4AF37]/20 hover:bg-[#D4AF37] hover:text-white
                transition-all font-bold text-sm">
                Filter
            </button>

            <a href="{{ route('admin.agents.index') }}"
                class="px-4 py-2.5 rounded-xl border border-gray-100 text-gray-500 hover:bg-gray-50
                transition-all text-sm flex items-center justify-center">
                Reset
            </a>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-50">
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Agent Code
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Approved By
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Approved At
                        </th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">
                    @forelse ($agents as $agent)
                        <tr class="group hover:bg-[#D4AF37]/5 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-900">
                                {{ $agent->agent_code }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $agent->user->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $agent->user->email ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $agent->user->phone ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($agent->status === 'active')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full
                                        text-[11px] font-bold bg-emerald-50 text-emerald-700
                                        border border-emerald-100 uppercase tracking-wider">
                                        Active
                                    </span>
                                @elseif ($agent->status === 'suspended')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full
                                        text-[11px] font-bold bg-rose-50 text-rose-700
                                        border border-rose-100 uppercase tracking-wider">
                                        Suspended
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full
                                        text-[11px] font-bold bg-gray-50 text-gray-500
                                        border border-gray-100 uppercase tracking-wider">
                                        {{ ucfirst($agent->status) }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                {{ $agent->approver->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                {{ $agent->approved_at?->format('d M Y H:i') ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">

                                    {{-- View --}}
                                    <a href="{{ route('admin.agents.show', $agent) }}"
                                        class="p-2 rounded-lg text-gray-400 hover:text-sky-600 hover:bg-sky-50 transition-all"
                                        title="View Agent">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7
                                    -1.274 4.057-5.065 7-9.542 7
                                    -4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    {{-- Suspend / Activate --}}
                                    @if ($agent->status === 'active')
                                        <form action="{{ route('admin.agents.suspend', $agent) }}" method="POST"
                                            onsubmit="return confirm('Suspend this agent?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="p-2 rounded-lg text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition-all"
                                                title="Suspend Agent">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>

                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.agents.activate', $agent) }}" method="POST"
                                            onsubmit="return confirm('Activate this agent?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="p-2 rounded-lg text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 transition-all"
                                                title="Activate Agent">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Remove --}}
                                    <form action="{{ route('admin.users.remove-agent', $agent->user_id) }}" method="POST"
                                        onsubmit="return confirm('Remove this user as agent?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 rounded-lg text-gray-400 hover:text-rose-600 hover:bg-rose-50 transition-all"
                                            title="Remove Agent">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-20 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-gray-200" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M17 20h5V4H2v16h5m10 0v-5.586a1 1 0 00-.293-.707l-2.414-2.414a1 1 0 00-.707-.293H10.414a1 1 0 00-.707.293L7.293 13.707A1 1 0 007 14.414V20m10 0H7" />
                                        </svg>
                                    </div>
                                    <p class="font-medium">No agents found</p>
                                    <p class="text-xs mt-1 text-gray-300">Try adjusting your filters or assign a verified
                                        user as agent</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
            {{ $agents->links() }}
        </div>
    </div>
@endsection
