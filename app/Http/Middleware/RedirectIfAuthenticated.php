<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();
            switch ($user->role) {
                case 0:
                    return redirect()->route('publisher.dashboard');
                    break;
                case 1:
                    return redirect()->route('home');
                    break;
            }   
        }

        return $next($request);
    }
}
