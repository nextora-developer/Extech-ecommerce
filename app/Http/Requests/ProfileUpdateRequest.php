<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->user();

        return [
            'name' => $user->name && !$user->is_admin
                ? ['sometimes']
                : ['required', 'string', 'max:255'],

            'email' => $user->email && !$user->is_admin
                ? ['sometimes']
                : ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],

            'phone' => $user->phone && !$user->is_admin
                ? ['sometimes']
                : ['nullable', 'string', 'max:30'],

            'ic_number' => $user->ic_number && !$user->is_admin
                ? ['sometimes']
                : ['nullable', 'string', 'max:30'],

            'birth_date' => $user->birth_date && !$user->is_admin
                ? ['sometimes']
                : ['nullable', 'date', 'before:today'],

            'ic_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ];
    }
}
