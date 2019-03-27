<?php

use App\User;
use App\City;
use Illuminate\Database\Seeder;

class ItinerariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();
        $city_ids = City::all()->pluck('id')->toArray();
        foreach ($user_ids as $user_id) {
        	foreach ($city_ids as $city_id) {
        		factory(App\Itinerary::class)->create([
        			'user_id' => $user_id,
        			'city_id' => $city_id
        		]);
        	}
        }
    }
}
