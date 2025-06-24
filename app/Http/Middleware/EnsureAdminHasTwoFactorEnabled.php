<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminHasTwoFactorEnabled
{
    if (!auth('admin')->check()) {
        return redirect()->route('admins.login');
    }

    $admin = auth('admin')->user();

    if ($admin->two_factor_secret && !session('admin.2fa_passed')) {
        return redirect()->route('admins.2fa.challenge');
    }

    return $next($request);
}
