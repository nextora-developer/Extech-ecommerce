<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Models\User;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agent_code',
        'referral_code',
        'status',
        'approved_by',
        'approved_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function referredUsers()
    {
        return $this->hasMany(User::class, 'referred_by_agent_id');
    }
}
