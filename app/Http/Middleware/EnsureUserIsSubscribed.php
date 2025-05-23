<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsSubscribed
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()?->is_subscribed) {
            return redirect()->route('premium.testimonies.index');
        }

        return $next($request);
    }
}
