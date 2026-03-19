<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        $q = Agent::with(['user', 'approver']);

        if ($request->filled('keyword')) {
            $kw = $request->string('keyword');

            $q->where(function ($query) use ($kw) {
                $query->where('agent_code', 'like', "%{$kw}%")
                    ->orWhereHas('user', function ($userQuery) use ($kw) {
                        $userQuery->where('name', 'like', "%{$kw}%")
                            ->orWhere('email', 'like', "%{$kw}%")
                            ->orWhere('phone', 'like', "%{$kw}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $q->where('status', $request->status);
        }

        $agents = $q->latest()->paginate(15)->withQueryString();

        return view('admin.agents.index', compact('agents'));
    }

    public function show(Agent $agent)
    {
        $agent->load(['user.addresses', 'approver']);

        $recentOrders = $agent->user
            ? $agent->user->orders()->withCount('items')->latest()->take(5)->get()
            : collect();

        $referredUsersCount = \App\Models\User::where('referred_by_agent_id', $agent->id)->count();

        $successfulReferralOrders = \App\Models\AgentCommission::where('agent_id', $agent->id)->count();

        $recentPointLogs = \App\Models\PointLog::where('agent_id', $agent->id)
            ->latest()
            ->take(10)
            ->get();

        return view('admin.agents.show', compact(
            'agent',
            'recentOrders',
            'referredUsersCount',
            'successfulReferralOrders',
            'recentPointLogs'
        ));
    }

    public function setAsAgent(User $user)
    {
        if (! $user->is_verified) {
            return back()->with('error', 'Only verified users can be assigned as agent.');
        }

        if (! $user->is_active) {
            return back()->with('error', 'Inactive user cannot be assigned as agent.');
        }

        if ($user->agent) {
            return back()->with('error', 'This user is already an agent.');
        }

        Agent::create([
            'user_id'       => $user->id,
            'agent_code'    => $this->generateAgentCode(),
            'referral_code' => $this->generateReferralCode(),
            'status'        => 'active',
            'approved_by'   => auth()->id(),
            'approved_at'   => now(),
            'notes'         => null,
        ]);

        return back()->with('success', 'User has been assigned as agent successfully.');
    }

    public function removeAgent(User $user)
    {
        if (! $user->agent) {
            return back()->with('error', 'This user is not an agent.');
        }

        $user->agent->delete();

        return back()->with('success', 'Agent removed successfully.');
    }

    protected function generateAgentCode(): string
    {
        do {
            $code = 'AGT-' . strtoupper(Str::random(6));
        } while (Agent::where('agent_code', $code)->exists());

        return $code;
    }

    protected function generateReferralCode(): string
    {
        do {
            $code = 'REF-' . strtoupper(Str::random(6));
        } while (Agent::where('referral_code', $code)->exists());

        return $code;
    }

    public function suspend(Agent $agent)
    {
        if ($agent->status === 'suspended') {
            return back()->with('error', 'This agent is already suspended.');
        }

        $agent->update([
            'status' => 'suspended',
        ]);

        return back()->with('success', 'Agent suspended successfully.');
    }

    public function activate(Agent $agent)
    {
        if ($agent->status === 'active') {
            return back()->with('error', 'This agent is already active.');
        }

        if (! $agent->user || ! $agent->user->is_verified) {
            return back()->with('error', 'Only verified users can have active agent access.');
        }

        if (! $agent->user->is_active) {
            return back()->with('error', 'Inactive user cannot be activated as agent.');
        }

        $agent->update([
            'status' => 'active',
        ]);

        return back()->with('success', 'Agent activated successfully.');
    }

    public function adjustPoints(Request $request, Agent $agent)
    {
        $validated = $request->validate([
            'direction' => ['required', 'in:in,out'],
            'points' => ['required', 'numeric', 'min:0.01'],
            'remark' => ['required', 'string', 'max:255'],
        ]);

        $points = round((float) $validated['points'], 2);
        $currentPoints = (float) ($agent->current_points ?? 0);

        if ($validated['direction'] === 'out' && $points > $currentPoints) {
            return back()->withErrors([
                'adjust_points' => 'Cannot deduct more than current points balance.',
            ]);
        }

        DB::transaction(function () use ($agent, $validated, $points) {
            if ($validated['direction'] === 'in') {
                $agent->increment('current_points', $points);
                $agent->increment('total_earned_points', $points);
            } else {
                $agent->decrement('current_points', $points);
            }

            \App\Models\PointLog::create([
                'agent_id' => $agent->id,
                'type' => 'admin_adjustment',
                'direction' => $validated['direction'],
                'points' => $points,
                'reference_type' => 'agent',
                'reference_id' => $agent->id,
                'remark' => $validated['remark'],
            ]);
        });

        return back()->with('success', 'Points adjusted successfully.');
    }
}
