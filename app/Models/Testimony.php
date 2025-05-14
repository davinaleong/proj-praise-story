<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getHumanStatus(): string
    {
        return Status::getHumanName($this->status);
    }

    public function getHumanPublishedDate(): string
    {
        return DateFormatter::toDisplay($this->published_date);
    }
}
