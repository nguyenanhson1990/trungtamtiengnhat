<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Closure;

class CheckAuthenticated
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
        if(Sentinel::check())
        {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
