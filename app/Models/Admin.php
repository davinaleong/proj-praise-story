<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, HasFactory, SoftDeletes;

    protected $guard = 'admin';

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the admin's initials (e.g., "Davina Leong" → "DL").
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = collect($words)
            ->filter()
            ->map(fn($word) => strtoupper(mb_substr($word, 0, 1)))
            ->implode('');

        return $initials;
    }
}
