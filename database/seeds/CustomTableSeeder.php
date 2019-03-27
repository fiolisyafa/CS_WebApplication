<?php

use App\User;
use App\Itinerary;
use Illuminate\Database\Seeder;

class CustomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::all()->pluck('id');

        foreach ($user_ids as $user_id) {
        	$itinerary_ids = Itinerary::where('user_id', $user_id)->pluck('id');
        	foreach ($itinerary_ids as $itinerary_id) {
        		$city_ids = Itinerary::where('id', $itinerary_id)->pluck('city_id');
        		foreach ($city_ids as $city_id) {
        			factory(App\CustomActivity::class)->create([
        				'user_id' => $user_id,
        				'itinerary_id' => $itinerary_id,
        				'city_id' => $city_id
        			]);
        		}
        	}
        }
    }
}
