<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuthMiddleware
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
        if( $request->getUser() != env('API_USERNAME') || 
            $request->getPassword() != env('API_PASSWORD') 
        ){
            $headers = array('WWW-Authenticate' => 'Basic');
            return response('Unauthorized', 401, $headers);
        }
        
        if ( !empty( $_SERVER['HTTP_ORIGIN'] ) ) {
            return $next($request)
             ->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN'] )
             ->header('Access-Control-Allow-Methods', 'GET, PUT, POST')
             ->header('Access-Control-Allow-Headers', 'Accept, Content-Type, Authorization');
        } else {
            return $next($request);
        }
    }

}