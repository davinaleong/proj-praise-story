<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'testimony_id',
        'type',
    ];

    /**
     * Get the testimony this like belongs to.
     */
    public function testimony()
    {
        return $this->belongsTo(Testimony::class);
    }
}
