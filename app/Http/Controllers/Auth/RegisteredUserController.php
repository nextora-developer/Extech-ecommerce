<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        return view('auth.register', [
            'referralCode' => $request->get('ref'),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'referral_code' => ['nullable', 'string', 'max:255'],
        ]);

        $agent = null;

        if ($request->filled('referral_code')) {
            $agent = Agent::where('referral_code', trim($request->referral_code))
                ->where('status', 'active')
                ->first();

            if (! $agent) {
                return back()
                    ->withErrors([
                        'referral_code' => 'Invalid or inactive referral code.',
                    ])
                    ->withInput();
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referred_by_agent_id' => $agent?->id,
        ]);

        event(new Registered($user));

        return redirect()->route('login')
            ->with('status', '注册成功，请先登录你的账号。');
    }
}