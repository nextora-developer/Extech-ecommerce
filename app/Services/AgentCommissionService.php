<?php

namespace App\Services;

use App\Models\Agent;
use App\Models\AgentCommission;
use App\Models\Order;
use App\Models\PointLog;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\DB;

class AgentCommissionService
{
    public function handleCompletedOrder(Order $order): void
    {
        if (! $order->user_id) {
            return;
        }

        if ((float) $order->subtotal <= 0) {
            return;
        }

        if (AgentCommission::where('order_id', $order->id)->exists()) {
            return;
        }

        $order->loadMissing('user');

        $user = $order->user;

        if (! $user || ! $user->referred_by_agent_id) {
            return;
        }

        $agent = Agent::find($user->referred_by_agent_id);

        if (! $agent || $agent->status !== 'active') {
            return;
        }

        $commissionPercent = (float) SystemSetting::getValue('agent_commission_percent', 6);
        $pointRate = (float) SystemSetting::getValue('point_rate_rm', 1);

        $subtotal = round((float) $order->subtotal, 2);
        $commissionAmountRm = round($subtotal * ($commissionPercent / 100), 2);
        $pointsAwarded = round($commissionAmountRm * $pointRate, 2);

        DB::transaction(function () use (
            $agent,
            $user,
            $order,
            $subtotal,
            $commissionPercent,
            $commissionAmountRm,
            $pointRate,
            $pointsAwarded
        ) {
            $commission = AgentCommission::create([
                'agent_id' => $agent->id,
                'user_id' => $user->id,
                'order_id' => $order->id,
                'order_subtotal' => $subtotal,
                'commission_percent' => $commissionPercent,
                'commission_amount_rm' => $commissionAmountRm,
                'point_rate' => $pointRate,
                'points_awarded' => $pointsAwarded,
                'status' => 'credited',
                'credited_at' => now(),
            ]);

            $agent->increment('current_points', $pointsAwarded);
            $agent->increment('total_earned_rm', $commissionAmountRm);
            $agent->increment('total_earned_points', $pointsAwarded);

            PointLog::create([
                'agent_id' => $agent->id,
                'type' => 'commission',
                'direction' => 'in',
                'points' => $pointsAwarded,
                'reference_type' => 'agent_commission',
                'reference_id' => $commission->id,
                'remark' => 'Commission from order #' . $order->order_no,
            ]);
        });
    }
}
