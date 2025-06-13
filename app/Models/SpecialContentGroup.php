<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialContentGroup extends Model
{
    use HasUuid, HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'slug',
        'title',
        'description',
        'visibility',
        'status',
        'sort_order',
        'created_by',
    ];

    /**
     * Relationship: items in the group.
     */
    public function items()
    {
        return $this->hasMany(SpecialContentItem::class, 'group_id');
    }
}
