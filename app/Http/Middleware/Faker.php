<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Faker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->is('api/*/faker/*')){
            $bearer_token = $request->bearerToken();
            if($bearer_token == "1b3d600e6b35d6c60f3f4bd80de566c75c0c1a06301d18f82bd67310a0aa5377"){

            } else{
                return \response()->json(['message'=>'Unauthorized user.'],401);
            }
        }
        return $next($request);
    }
}
