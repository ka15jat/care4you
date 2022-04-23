<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Owner
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
        if (Auth::guard('Owner')->check()) {
            return $next($request);
        }else{
            return Redirect(Route('login'))->withErrors("You aren't the owner and therefore you can't access that page.");
        }
    }
}
