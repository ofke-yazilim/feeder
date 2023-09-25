<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\Twit;

class HomeController extends Controller
{
    //
    public function index(Response $response){
        try{
            $response->view          = 'home';
            $response->status        = 200;
            $response->data['title'] = 'All Twitter List';
            $response->data['twits'] = Twit::orderByDesc('created_at')->paginate(5);
            return \Helper::render_response($response);
        } catch (\Exception $e){
            return \Helper::catch_error($response,$e);
        }
    }
}
