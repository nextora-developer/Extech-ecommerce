<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentCommission extends Model
{
    protected $fillable = [
        'agent_id',
        'user_id',
        'order_id',
        'order_subtotal',
        'commission_percent',
        'commission_amount_rm',
        'point_rate',
        'points_awarded',
        'status',
        'credited_at',
    ];

    protected $casts = [
        'order_subtotal' => 'decimal:2',
        'commission_percent' => 'decimal:2',
        'commission_amount_rm' => 'decimal:2',
        'point_rate' => 'decimal:2',
        'points_awarded' => 'decimal:2',
        'credited_at' => 'datetime',
    ];

    public function agent()
    {
        return $this->belongsTo(\App\Models\Agent::class, 'agent_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id');
    }
}
