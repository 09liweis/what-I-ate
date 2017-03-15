<?php

use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'weisen.li@hotmail.com',
            'password' => bcrypt('kanamemadoka2017'),
            'role' => 'admin',
            'publicity' => 'public',
        ]);
        
        DB::table('locations')->insert([
            'name' => '云尚过桥米线 （Oriental Rice Noodle House)',
            'google_place_id' => 'ChIJdwC3V4bT1IkRWJyD4KmwU94',
            'photo_url' => '',
            'address' => '7060 Warden Ave c1, Markham, ON L3R 5V1, Canada',
            'lat' => '43.821128',
            'lng' => '-79.326735',
        ]);
        
        DB::table('foods')->insert([
            'name' => 'Oriental Rice Noodle',
            'photo_url' => 'https://s3-media1.fl.yelpcdn.com/bphoto/c4hUpMGGUVTXH4cPYAiGjA/348s.jpg',
            'price' => 8.49,
            'rating' => 8.3,
            'user_id' => 1,
            'location_id' => 1,
        ]);
    }
}
