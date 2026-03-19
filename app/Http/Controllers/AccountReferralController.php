<?php

namespace App\Http\Controllers;

use App\Models\AgentCommission;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class AccountReferralController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load('agent');

        abort_unless($user->agent, 403);

        $agent = $user->agent;

        $referredUsers = $agent->referredUsers()
            ->withCount('orders')
            ->latest()
            ->take(10)
            ->get();

        $commissions = AgentCommission::with('order')
            ->where('agent_id', $agent->id)
            ->latest()
            ->take(15)
            ->get();

        $stats = [
            'referred_users' => $agent->referredUsers()->count(),
            'current_points' => (float) ($agent->current_points ?? 0),
            'total_earned_rm' => (float) ($agent->total_earned_rm ?? 0),
            'total_earned_points' => (float) ($agent->total_earned_points ?? 0),
            'successful_orders' => AgentCommission::where('agent_id', $agent->id)->count(),
            'commission_percent' => (float) SystemSetting::getValue('agent_commission_percent', 6),
        ];

        $referralLink = url('/register?ref=' . $agent->referral_code);

        return view('account.referral.index', [
            'user' => $user,
            'agent' => $agent,
            'stats' => $stats,
            'referredUsers' => $referredUsers,
            'commissions' => $commissions,
            'referralLink' => $referralLink,
        ]);
    }
}
