<?php

namespace App\Http\Middleware;

use Closure;

class IsActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->is_active_user) {
            abort(403);
        }

        return $next($request);
    }
}
