<?php
namespace App\Services;

use Faker\Factory as Faker;

class FeederService
{
    /**
     * Son 20 twitt alınır.
     * @return void
     */
    public function get_list($limit=20,$user_id=null,$status=0){
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

    /**
     * İstenilen Feed Güncellenir.
     * @return void
     */
    public function update(){

    }

    /**
     * Son 20 twitt alınır.
     * @return void
     */
    public static function get_list_static($limit=20,$user_id=null,$status=0){
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
}
