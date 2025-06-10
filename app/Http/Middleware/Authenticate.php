<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            $prefix = ltrim(config('admin.prefix', 'admins'), '/');

            if ($request->is($prefix) || $request->is("$prefix/*")) {
                return route('admins.login');
            }

            return route('me.login'); // fallback for web users
        }

        return null;
    }
}
