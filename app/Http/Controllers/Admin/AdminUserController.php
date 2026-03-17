<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $q = User::query();

        if ($request->filled('keyword')) {
            $kw = $request->string('keyword');
            $q->where(function ($qq) use ($kw) {
                $qq->where('name', 'like', "%{$kw}%")
                    ->orWhere('email', 'like', "%{$kw}%");
            });
        }

        // status
        if ($request->filled('status')) {
            if ($request->string('status') === 'active') {
                $q->where('is_active', true);
            } elseif ($request->string('status') === 'inactive') {
                $q->where('is_active', false);
            }
        }

        // ✅ IC uploaded
        if ($request->filled('ic_uploaded')) {
            if ($request->ic_uploaded === 'yes') {
                $q->whereNotNull('ic_image')->where('ic_image', '!=', '');
            } else {
                $q->where(function ($qq) {
                    $qq->whereNull('ic_image')->orWhere('ic_image', '');
                });
            }
        }

        // ✅ verified
        if ($request->filled('verified')) {
            if ($request->verified === 'verified') {
                $q->where('is_verified', true);
            } else {
                $q->where(function ($qq) {
                    $qq->where('is_verified', false)
                        ->orWhereNull('is_verified');
                });
            }
        }

        $users = $q->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('addresses', 'defaultAddress');

        // 最近 5 张订单（根据你自己的关联/字段名微调）
        $recentOrders = Order::where('user_id', $user->id)
            ->latest()
            ->withCount('items')   // 如果你有 items 关联
            ->take(7)
            ->get();

        return view('admin.users.show', compact('user', 'recentOrders'));
    }

    public function edit(User $user)
    {
        $user->load('addresses');

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone' => ['nullable', 'string', 'max:30'],

            // IC
            'ic_number'  => ['nullable', 'string', 'max:30'],
            'birth_date' => ['nullable', 'date'],
            'ic_image'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            // system
            'password'    => ['nullable', 'string', 'min:8'],
            'is_active'   => ['nullable', 'boolean'],
            'is_verified' => ['nullable', 'boolean'],
        ]);

        // =====================
        // BASIC
        // =====================
        $user->name  = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'] ?? null;

        // =====================
        // IC INFO
        // =====================
        $user->ic_number  = $data['ic_number'] ?? $user->ic_number;
        $user->birth_date = $data['birth_date'] ?? $user->birth_date;

        // =====================
        // ACTIVE
        // =====================
        $user->is_active = (bool) ($data['is_active'] ?? false);

        // =====================
        // PASSWORD
        // =====================
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        // =====================
        // IC IMAGE UPLOAD
        // =====================
        $uploadedNewIc = false;

        if ($request->hasFile('ic_image')) {

            // delete old
            if ($user->ic_image && Storage::disk('public')->exists($user->ic_image)) {
                Storage::disk('public')->delete($user->ic_image);
            }

            $user->ic_image = $request->file('ic_image')->store('ic-images', 'public');
            $uploadedNewIc = true;
        }

        // =====================
        // VERIFIED LOGIC (🔥优化重点)
        // =====================
        $requestVerified = (bool) ($data['is_verified'] ?? false);

        // ❌ 没有 IC 不允许 verified
        if ($requestVerified && empty($user->ic_image)) {
            return back()->withErrors([
                'is_verified' => 'User must upload IC before verification.'
            ]);
        }

        // ✅ 如果 admin 开启 verified
        if ($requestVerified && !$user->is_verified) {
            $user->is_verified = true;
            $user->verified_at = now();
        }

        // ❌ 如果 admin 取消 verified
        if (!$requestVerified && $user->is_verified) {
            $user->is_verified = false;
            $user->verified_at = null;
        }

        // 🔥 如果上传新 IC → 自动变 unverified（重新审核）
        if ($uploadedNewIc) {
            $user->is_verified = false;
            $user->verified_at = null;
        }

        $user->save();

        return redirect()
            ->route('admin.users.show', $user)
            ->with('success', 'User updated successfully.');
    }
}
