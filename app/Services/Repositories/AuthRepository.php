<?php
namespace App\Services\Repositories;

use App\Helpers\Response;
use App\Http\Requests\UserLoginRequest;
use App\Services\Interfaces\AuthInterface;
use Illuminate\Http\Request;

class AuthRepository implements AuthInterface {

    public function login(Request $request, Response $response,UserLoginRequest $login_request){
        $login_request->validated();
        $response->status   = 401;
        $response->messages = ['message'=>'Login is not successful','type'=>'error'];
        if(\Auth::attempt($request->only(['email','password']))){
            // Session one for per user
            $hash = bcrypt(auth()->user()->getKey().microtime());
//            if($request->is('api/*')){
//                \Cache::put('userhash', $hash);
//            } else{
//                \Session::put('userhash', $hash);
//            }
            \Session::put('userhash', $hash);

            \Auth::user()->session_id    = $hash;
            \Auth::user()->access_token  = hash('sha256', time().implode('',$request->all()));
            \Auth::user()->save();
            // Session one for per user

            $response->redirect = route('web.twit.index');
            $response->status   = 200;
            $response->messages = ['message'=>'Login successful','type'=>'success','access_token'=>\Auth::user()->access_token];
            return $response;
        }

        $response->redirect = route('web.home');
        return $response;
    }

    public function logout(){
        try {
            //\Auth::user()->access_token = null;
            \Auth::user()->save();
            \Auth::logout();
            return true;
        } catch (\Exception $e){
            return $e;
        }
    }
}
