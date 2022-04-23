<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Staff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('Staff')->check()) {
            return $next($request);
        }else{
            return Redirect(Route('login'))->withErrors("You aren't a staff member and therefore you can't access that page.");
        }
    }
}
