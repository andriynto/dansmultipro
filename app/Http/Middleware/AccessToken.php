<?php namespace App\Http\Middleware;


use Closure;
use App\Services\AccessToken as Token;

class AccessToken
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
        $auth_service     = new Token;
        $checking         = $auth_service->check();
        
        if(isset($checking['statusCode']) && $checking['statusCode'] == 401 ) {
            return redirect('logout');
        }
    
        else if(is_null($checking) || $checking['token_expired'] != false) {
            return redirect('logout');
        }
        
        return $next($request);
    }

}