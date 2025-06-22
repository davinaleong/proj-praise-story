<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Like;
use App\Traits\HasUuid;
use App\Helpers\DateFormatter;
use App\Helpers\Status;

class Testimony extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'content',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getHumanStatus(): string
    {
        return Status::getHumanName($this->status);
    }

    public function getHumanPublishedAt(): string
    {
        return $this->published_at
            ? DateFormatter::toDisplay($this->published_at)
            : 'Not published';
    }

    public function getInputPublishedAt(): string
    {
        return $this->published_at
            ? DateFormatter::toInput($this->published_at)
            : '';
    }

}
