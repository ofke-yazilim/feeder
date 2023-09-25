<?php

namespace App\Http\Controllers;

use App\Models\TempProduct;
use App\Models\Twit;
use Faker\Factory as Faker;
use http\Env\Response;
use Illuminate\Http\Request;

class FakerController extends Controller
{
    public function index(Request $request){
        try {
            $faker = Faker::create();
            $data  = [];
            for($i=0;$i<$request->count;$i++){
                $data[] = [
                    'twitter_id'      => $request->user_id.($i>8?rand(1,12):date('hm').$i),
                    'user_id'         => $request->user_id,
                    'twitter_title'   => $faker->sentence(3),
                    'twitter_text'    => $faker->sentence(rand(5,10)),
                    'created_at'      => date("Y-m-d H:i:s"),
                    'status'          => $request->status,
                ];
            }
            return \response()->json($data,200);
        } catch (\Exception $e){
            return \response()->json(['message'=>'Unexpected error.'],504);
        }
    }

    public function update(Request $request){
        $data = $request->json()->all();
        try {
            return \response()->json(['message'=>'Update is successfully'],200);
        } catch (\Exception $e){
            return \response()->json(['message'=>'Unexpected error.'],504);
        }

    }
}
