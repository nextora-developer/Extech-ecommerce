<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicAgentController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q'));
        $agent = null;

        if ($q !== '') {
            $agent = Agent::with('user')
                ->where('agent_code', $q)
                ->orWhereHas('user', function ($query) use ($q) {
                    $query->where('phone', $q)
                        ->orWhere('name', 'like', "%{$q}%");
                })
                ->first();
        }

        return view('pages.agents.index', compact('q', 'agent'));
    }

    public function pdf(Request $request)
    {
        $q = trim((string) $request->query('q'));

        abort_if($q === '', 404);

        $agent = Agent::with('user')
            ->where('agent_code', $q)
            ->orWhereHas('user', function ($query) use ($q) {
                $query->where('phone', $q)
                    ->orWhere('name', 'like', "%{$q}%");
            })
            ->firstOrFail();

        $safeName = Str::slug(
            $agent->agent_code . '-' . ($agent->user->name ?? 'agent')
        );

        $pdf = Pdf::loadView('pages.agents.verify-agent-pdf', [
            'agent' => $agent,
            'q' => $q,
            'generatedAt' => now(),
        ])->setPaper('a4');

        return $pdf->stream("agent-verification-{$safeName}.pdf");
    }
}
