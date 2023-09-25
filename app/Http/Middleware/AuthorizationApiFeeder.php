<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizationApiFeeder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->is('api/*')){
            $bearer_token = $request->bearerToken();
            $user         = \App\Models\User::where('access_token',$bearer_token)->first();
            if($user) {
                \auth()->login($user);
                if($request->json()->all()){
                    \request()->merge($request->json()->all());
                }
            } else{
                $feeder_response                = new \App\Helpers\Response();
                $feeder_response->status        = 401;
                $feeder_response->messages      = ['message'=>'Unauthorized attempt','type'=>'error'];
                return \Helper::render_response($feeder_response);
            }
        }
        return $next($request);
    }
}
