<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Feedback extends Model
{
    use HasFactory, HasUuid, SoftDeletes;
    protected $guarded = [];
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'subject',
        'email',
        'message',
    ];
}

