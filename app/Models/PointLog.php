<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointLog extends Model
{
    protected $fillable = [
        'agent_id',
        'type',
        'direction',
        'points',
        'reference_type',
        'reference_id',
        'remark',
    ];

    protected $casts = [
        'points' => 'decimal:2',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
