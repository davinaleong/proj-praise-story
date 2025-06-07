<?php

namespace App\Models;

use App\Traits\HasUuid;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasUuid, HasFactory, SoftDeletes;
    protected $fillable = [
        'uuid',
        'subject',
        'body',
        'context_type',
        'context_id',
        'user_id',
        'admin_id',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function context()
    {
        return $this->morphTo();
    }
}
