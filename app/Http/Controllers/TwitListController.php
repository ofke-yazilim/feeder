<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\TwitUpdateRequest;
use App\Models\Twit;
use App\Services\FeederService;
use App\Services\Interfaces\TwitListInterface;
use Illuminate\Http\Request;

class TwitListController extends Controller
{
    private TwitListInterface $twit_list_interface;

    public function __construct(TwitListInterface $twit_list_interface){
        $this->twit_list_interface = $twit_list_interface;
    }

    public function index(Response $response,Request $request){
        try{
            $response->view          = 'twit.list';
            $response->status        = 200;
            $response->data['title'] = 'Twitter Listesi';
            $response->data['twits'] = $this->twit_list_interface->get_twit_model([['user_id',\Auth::user()->id]],'paginate',5);
            return \Helper::render_response($response);
        } catch (\Exception $e){
            return \Helper::catch_error($response,$e);
        }
    }

    public function edit(Response $response,$id){
        try{
            $response->view          = 'twit.edit';
            $response->status        = 200;
            $response->data['title'] = 'Twitter Edit or Show('.$id.')';
            $response->data['twit'] = $this->twit_list_interface->get_twit_model([['user_id',\Auth::user()->id],['id',$id]],'first');
            return \Helper::render_response($response);
        } catch (\Exception $e){
            return \Helper::catch_error($response,$e);
        }
    }

    public function update(Request $request,Response $response,TwitUpdateRequest $update_request,$id){
        $update_request->validated();
        $response->status        = 200;
        $response->data['title'] = 'Twitter Update('.$id.')';
        try{
            //$response->data['result']   = Twit::where('id',$id)->update($request->all());
            $response->data['result'] = $this->twit_list_interface->update($update_request,$id);
            $response->messages         = [
                'message'=>'Update is succesfully.',
                'type'=>'success',
            ];
            $response->redirect         = route('web.twit.edit',['id'=>$id]);
            return \Helper::render_response($response);
        } catch (\Exception $e){
            return \Helper::catch_error($response,$e);
        }
    }


    public function get_twits(Response $response,FeederService $service){
        $date                       = date('Y-m-d H:i:s');
        $response->data['result']   = $service->get_list(20,\Auth::user()->id,1);
        $response->messages         = [
            'message'=>'Last 20 Twits was get. Yeni Kayıt :'.Twit::where('created_at','>',$date)->count(),
            'type'=>'success',
        ];
        $response->redirect         = route('web.twit.index');
        try{
            return \Helper::render_response($response);
        } catch (\Exception $e){
            return \Helper::catch_error($response,$e);
        }
    }

    public function destroy(){

    }
}
