<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Oauth\OauthClient;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectForToken
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
        $hasAccessToken = OauthClient::where([
            'user_id'   => auth()->user()->id,
            'password_client' => 1
        ])->first();
        
        if(!$hasAccessToken) {
            flash('Create token api first')->error();
            return redirect('auth/access-token');
        }

        return $next($request);
    }
}
