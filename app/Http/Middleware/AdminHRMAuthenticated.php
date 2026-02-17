<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHRMAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2 && Auth::user()->status == "active"){
                return $next($request);
            } else{
                $request->session()->flush();
                return redirect('/');
            }
        } else{
            $request->session()->flush();
            return redirect('/');
        }
    }
}
