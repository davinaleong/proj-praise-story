<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasUuid;
use Laravel\Fortify\TwoFactorAuthenticatable;

class Admin extends Authenticatable
{
    use Notifiable, HasUuid, HasFactory, SoftDeletes, TwoFactorAuthenticatable;

    protected $guard = 'admin';

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime'
        ];
    }

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
