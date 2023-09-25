<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Services\Interfaces\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserInterface $user_interface;

    public function __construct(UserInterface $user_interface){
        $this->user_interface = $user_interface;
    }

    public function login(Response $response){
        $response->view          = 'user.login';
        $response->data['title'] = 'Giriş Yap';
        try{
            return \Helper::render_response($response);
        } catch (\Exception $e){
            return \Helper::catch_error($response,$e);
        }
    }

    public function create(Response $response){
        $response->view  = 'user.register';
        $response->data['title'] = 'Kayıt Ol';
        try{
            return \Helper::render_response($response);
        } catch (\Exception $e){
            return \Helper::catch_error($response,$e);
        }
    }

    public function store(Request $request,Response $response,UserStoreRequest $store_request){
        $store_request->validated();
        $response->view          = 'user.register';
        $response->status        = 200;
        $response->data['title'] = 'Kayıt Ol';
        try{
            //$user = User::create($request->all());
            $user = new User();
            $user->fill($request->all());
            $this->user_interface->store($user);
            $response->redirect         = route('web.login.get');
            if($request->is('api/*')){
                $verified_link              = \env('APP_URL').'/api/v1/validate?validate_token='.$request->validate_token.'&email='.$user->email;
            } else{
                $verified_link              = \env('APP_URL').'/validate?validate_token='.$request->validate_token.'&email='.$user->email;
            }
            $response->messages         = [
                'message'=>'Registration Successful. <br>Mail adresinize gönderilen link ile hesabınızı onaylayabilirsiniz: '.$verified_link."<br>Twtlerinizi editlemek için mailinizi onaylamanız gerekmektedir.",
                'type'=>'success',
                'verified_link'=>$verified_link
            ];
            return \Helper::render_response($response);
        } catch (\Exception $e){
            return \Helper::catch_error($response,$e);
        }
    }

    public function show(Response $response){
        $response->view          = 'user.show';
        $response->data['title'] = 'My Profile';
        try{
            $user = $this->user_interface->show();
            $response->data['profile'] = $user;
            return \Helper::render_response($response);
        } catch (\Exception $e){
            return \Helper::catch_error($response,$e);
        }
    }
}
