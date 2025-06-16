<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpecialContentItem extends Model
{
    use HasUuid, HasFactory, SoftDeletes;

    /**
     * Indicates that the primary key is auto-incrementing.
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'uuid',
        'group_id',
        'title',
        'type',
        'content',
        'media_url',
        'link_url',
        'button_text',
        'status',
        'sort_order',
        'starts_at',
        'ends_at',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    /**
     * Boot function to assign UUID automatically.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Relationship: belongs to a content group.
     */
    public function specialContentGroup(): BelongsTo
    {
        return $this->belongsTo(SpecialContentGroup::class, 'group_id');
    }
}
