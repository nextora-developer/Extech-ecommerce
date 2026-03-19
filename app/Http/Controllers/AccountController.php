<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PointLog;


class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load('agent');

        $stats = [
            'orders' => $user->orders()->count(),
            'favorites' => $user->favorites()->count(),
            'addresses' => $user->addresses()->count(),
        ];

        $latestOrders = $user->orders()
            ->with(['items.product'])
            ->latest()
            ->take(5)
            ->get();

        $currentPoints = (float) ($user->agent->current_points ?? 0);

        $recentPointLogs = $user->agent
            ? PointLog::where('agent_id', $user->agent->id)
            ->latest()
            ->take(8)
            ->get()
            : collect();

        return view('account.index', compact(
            'user',
            'stats',
            'latestOrders',
            'currentPoints',
            'recentPointLogs'
        ));
    }
}
