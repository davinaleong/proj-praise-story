<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Subscription extends Model
{
    use HasUuid;

    protected $fillable = [
        'user_id',
        'status',
        'stripe_subscription_id',
        'started_at',
        'ended_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

