<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TwitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i=0;$i<100;$i++){
            \DB::table('twits')->insert([
                'twitter_id'      => $i.date('Hm'),
                'twitter_title'   => $faker->sentence(3),
                'twitter_text'    => $faker->sentence(rand(5,10)),
                'created_at'      => $faker->date('Y-m-d H:i:s'),
                'status'          => 0,
            ]);
        }

    }
}
