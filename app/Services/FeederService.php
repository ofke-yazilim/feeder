<?php
namespace App\Services;

use App\Models\Twit;
use Faker\Factory as Faker;

class FeederService
{
    private $bearer_token = '1b3d600e6b35d6c60f3f4bd80de566c75c0c1a06301d18f82bd67310a0aa5377';
    private $api_url      = "https://fakedata.okesmez.com/api/v1/faker/";
    private $response     = null;
    private $method       = 'GET';

    public function __construct(){}

    /**
     * Son 20 twitt alınır.
     * @return void
     */
    public function get_list($limit=20,$user_id=null,$status=0){
        $this->api_url = $this->api_url.'data?count='.$limit."&user_id=".$user_id."&status=".$status;
        $data  = $this->curl();
        return $this->store();
        //$this->create_fake_data_for_twit($limit=20,$user_id=null,$status=0);
    }

    /**
     * İstenilen Feed Güncellenir.
     * @return void
     */
    public function update($id,$content){
        $this->method  = 'PUT';
        $this->api_url = $this->api_url.'update/'.$id;
        $data          = $this->curl(['twitter_text'=>$content]);
    }

    /**
     * @return array
     * Servisten alınan twitler altyapıya kayıt ediliyor.
     */
    private function store(){
        foreach (json_decode($this->response) as $twit) {
            $id = Twit::updateOrInsert(
                ['twitter_id'      => $twit->twitter_id],
                [
                    'user_id'         => $twit->user_id,
                    'twitter_title'   => $twit->twitter_title,
                    'twitter_text'    => $twit->twitter_text,
                    'created_at'      => $twit->created_at,
                    'status'          => $twit->status,
                ]
            );

            $ids[] = $id;
        }
        return $ids;
    }

    private function create_fake_data_for_twit($limit=20,$user_id=null,$status=0){
        $faker = Faker::create();
        $ids   = [];
        for($i=0;$i<20;$i++){
            $id = \DB::table('twits')->updateOrInsert(
                ['twitter_id'      => $user_id.($i>8?rand(1,12):date('hm').$i)],
                [
                    'user_id'         => $user_id,
                    'twitter_title'   => $faker->sentence(3),
                    'twitter_text'    => $faker->sentence(rand(5,10)),
                    'created_at'      => date("Y-m-d H:i:s"),
                    'status'          => $status,
                ]
            );

            $ids[] = $id;
        }

        return $ids;
    }

    private function curl($data = []){
        try{
            $curl = curl_init();
            $curl_opt = array(
                CURLOPT_URL => $this->api_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $this->method,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$this->bearer_token
                )
            );
            if(count($data)>0){
                $curl_opt[CURLOPT_POSTFIELDS] = json_decode($data);
            }

            curl_setopt_array($curl,$curl_opt);

            $this->response = curl_exec($curl);

            if ($this->response === false) {
                return "CURL Error: " . curl_error($curl);
            }

            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);
            return $this->response;

        } catch (\Exception $e){
            return $e;
        }
    }
}
