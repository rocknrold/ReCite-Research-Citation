<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UriDirectAccess
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
        
        $method = $request->method();
        //  this is a middleware for accessing the route directly as a GET request
        // this is to solve the error for support methods.

        if (request()->isMethod('get')){ //if the request is GET
            return abort(404);          // the middleware will throw a 404 response. 
        }

        return $next($request); //if not just return the callback/next request 
    }
}
