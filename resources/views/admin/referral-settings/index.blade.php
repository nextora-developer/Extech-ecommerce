@extends('admin.layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">Referral Settings</h1>
            <p class="text-sm text-gray-500 mt-1">Manage agent commission rate and point conversion settings.</p>
        </div>
    </div>

    <div class="max-w-3xl">
        <div class="bg-white border border-[#D4AF37]/18 rounded-2xl p-6 shadow-[0_18px_40px_rgba(0,0,0,0.06)]">
            <form method="POST" action="{{ route('admin.referral-settings.update') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Agent Commission Percent (%)
                        </label>
                        <input type="number" step="0.01" min="0" max="100" name="agent_commission_percent"
                            value="{{ old('agent_commission_percent', $commissionPercent) }}"
                            class="w-full rounded-xl border-gray-200 text-black px-4 py-3
                                   focus:border-[#D4AF37] focus:ring-[#D4AF37]/30" />
                        <p class="text-xs text-gray-400 mt-2">
                            Example: 6 means 6% of order subtotal.
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Point Rate (RM → Point)
                        </label>
                        <input type="number" step="0.01" min="0" name="point_rate_rm"
                            value="{{ old('point_rate_rm', $pointRateRm) }}"
                            class="w-full rounded-xl border-gray-200 text-black px-4 py-3
                                   focus:border-[#D4AF37] focus:ring-[#D4AF37]/30" />
                        <p class="text-xs text-gray-400 mt-2">
                            Example: 1 means RM1 = 1 point.
                        </p>
                    </div>
                </div>

                <div class="rounded-2xl bg-gray-50 border border-gray-100 p-4">
                    <p class="text-sm text-gray-600">
                        Current rule preview:
                        <span class="font-bold text-gray-900">
                            {{ number_format($commissionPercent, 2) }}%
                        </span>
                        commission and
                        <span class="font-bold text-gray-900">
                            RM{{ number_format($pointRateRm, 2) }} = {{ number_format($pointRateRm, 2) }} point
                        </span>
                    </p>
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-5 py-3 rounded-xl bg-[#D4AF37] text-white font-bold
                               hover:bg-[#c49d22] transition shadow-sm">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
