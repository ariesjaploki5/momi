<?php

namespace App\Http\Middleware\Users;

use Closure;
use Illuminate\Support\Facades\Auth;

class MidwifeMiddleware
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
        if(Auth::user()->type == 'midwife')
        {
            return $next($request);
        }
    }
}
