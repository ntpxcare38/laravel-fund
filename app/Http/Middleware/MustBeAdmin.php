<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MustBeAdmin
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
        Auth::shouldUse('personnel');
        if (!Auth::guard('personnel')->check()) {
            return redirect('/home');
        }else{

            if(Auth::user()->type_pid==1){
                return $next($request);
            }
            return redirect('/home');
        }

    }

}
