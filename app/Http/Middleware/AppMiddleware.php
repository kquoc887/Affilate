<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AppMiddleware
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

        if (Auth::check()) {
           if (Auth::user()->active == 1) {
                return $next($request);
           } else {
                return redirect()->route('getLogin')->with(['message' => 'Tài khoản chưa được kích hoạt', 'text-alert' => 'alert-danger']);
           }
        }

        return redirect()->route('getLogin');
    }
}
