<?php
namespace App\Helpers;
class Helper
{
    /**
     * @param Response $response
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public static function render_response(Response $response){
        if(request()->is('api/*')){
            if(count($response->data)>0 && count($response->messages)==0){
                $response->messages = $response->data;
            }
            return response()->json($response->messages,$response->status);
        } else{
            if($response->redirect){
                return redirect($response->redirect)->with($response->messages);
            }
            return view($response->view, $response->data);
        }
    }

    public static function catch_error(Response $response,$e){
        $response->status   = $response->status??504;
        $response->messages = count($response->messages)>0?$response->messages:['message'=>'Hata Oluştu','type'=>'error'];
        $response->redirect = route('web.home');
        \Log::channel('error')->error($e->getMessage()." - ".$e->getFile()." - ".$e->getLine());
        return self::render_response($response);
    }

}
