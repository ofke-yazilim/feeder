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
                return \redirect('/')->with(['message'=>'You logined on another place.','type'=>'error']);
            }
        }

        return $next($request);
    }
}
