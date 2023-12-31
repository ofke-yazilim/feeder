<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OneSessionForPerUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(\Auth::check()){
            $session_id = \Session::getId();
            // The only login for per user
            if(\Session::get('userhash') != \Auth::user()->session_id){
                \Auth::logout();
                $feeder_response                = new \App\Helpers\Response();
                $feeder_response->status        = 401;
                $feeder_response->messages      = ['message'=>'You logined on another place.','type'=>'error'];
                return \Helper::render_response($feeder_response);
            }
        }

        return $next($request);
    }
}
