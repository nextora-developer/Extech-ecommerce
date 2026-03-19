<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class ReferralSettingController extends Controller
{
    public function index()
    {
        $commissionPercent = (float) SystemSetting::getValue('agent_commission_percent', 6);
        $pointRateRm = (float) SystemSetting::getValue('point_rate_rm', 1);

        return view('admin.referral-settings.index', compact(
            'commissionPercent',
            'pointRateRm'
        ));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'agent_commission_percent' => ['required', 'numeric', 'min:0', 'max:100'],
            'point_rate_rm' => ['required', 'numeric', 'min:0'],
        ]);

        SystemSetting::updateOrCreate(
            ['key' => 'agent_commission_percent'],
            ['value' => $validated['agent_commission_percent']]
        );

        SystemSetting::updateOrCreate(
            ['key' => 'point_rate_rm'],
            ['value' => $validated['point_rate_rm']]
        );

        return back()->with('success', 'Referral settings updated successfully.');
    }
}
