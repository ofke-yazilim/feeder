<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Services\Interfaces\AuthInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthInterface $auth_interface;

    public function __construct(AuthInterface $auth_interface){
        $this->auth_interface = $auth_interface;
    }

    public function login(Request $request,Response $response,UserLoginRequest $login_request){
        return \Helper::render_response($this->auth_interface->login($request,$response,$login_request));
    }

    public function logout(Response $response){
        try{
            $logout = $this->auth_interface->logout();
            $response->redirect = route('web.home');
            if($logout == true){
                return \Helper::render_response($response);
            } else{
                return \Helper::catch_error($response,$logout);
            }
        } catch (\Exception $e){
            return \Helper::catch_error($response,$e);
        }
    }

    public function validate_user(Request $request,Response $response){
        try{
            $response->status   = 401;
            $response->messages = ['message'=>'Token is incorrect or you verifed before.','type'=>'error'];
            $user = User::where([['validate_token',$request->validate_token],['email',$request->email]])->whereNull('email_verified_at')->first();
            $response->redirect = route('web.home');
            if($user) {
                $response->status   = 200;
                $response->messages = ['message'=>'Your account has been verified','type'=>'success'];
                $user->twits()->update(['status'=>1]);
                $user->email_verified_at = date("Y-m-d H:i:s");
                $user->save();
                return \Helper::render_response($response);
            }

            return \Helper::render_response($response);
        } catch (\Exception $e){
            return \Helper::catch_error($response,$e);
        }
    }

    public function get_token(){}
}
