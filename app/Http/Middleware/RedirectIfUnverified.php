<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfUnverified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $unverified = auth()->user()->verify;
        
        if(!$unverified) {
            flash('Your account use default password, please change the password soon as posible before activity in apps.')->error();
            return redirect('auth/verify');
        }

        return $next($request);
    }
}
