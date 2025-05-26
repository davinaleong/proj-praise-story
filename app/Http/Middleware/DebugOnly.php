<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DebugOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!config('app.debug')) {
            abort(403, 'This route is only available in debug mode.');
        }

        return $next($request);
    }
}
