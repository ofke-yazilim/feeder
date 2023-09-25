<?php

namespace App\Http\Middleware;

use App\Services\FeederService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateFeeder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!\Auth::check()){
            $feeder_response = new \App\Helpers\Response();
            $feeder_response->redirect      = route('web.home');
            $feeder_response->status        = 401;
            $feeder_response->data['title'] = 'Anasayfa';
            $feeder_response->messages      = ['message'=>'Unauthorized attempt (AuthenticateFeeder)','type'=>'error'];
            return \Helper::render_response($feeder_response);
        }
        return $next($request);
    }
}
