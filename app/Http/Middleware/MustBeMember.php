<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MustBeMember
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
        Auth::shouldUse('member');
        if (!Auth::guard('member')->check()) {
            return redirect('/home');
        }else{
                return $next($request);
        }
    }
}
