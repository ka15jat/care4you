<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if (Auth::guard('Admin')->check()) {
            return $next($request);
        }else{
            return Redirect(Route('login'))->withErrors("You aren't the admin and therefore you can't access that page.");
        }
    }
}
