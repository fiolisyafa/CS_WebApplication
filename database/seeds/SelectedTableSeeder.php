<?php

use App\User;
use App\Itinerary;
use App\Preference;
use App\SuggestedActivity;
use Illuminate\Database\Seeder;

class SelectedTableSeeder extends Seeder
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
        		$activity_type_ids = Preference::where('itinerary_id', $itinerary_id)->pluck('activity_type_id');
        		$city_id = Itinerary::where('id', $itinerary_id)->pluck('city_id');
        		

        		foreach ($activity_type_ids as $activity_type_id) {
        			$activity_ids = SuggestedActivity::where('activity_type_id', $activity_type_id)->where('city_id', $city_id)->get()->random(1)->pluck('id');
        			

        			foreach ($activity_ids as $activity_id) {
						factory(App\SelectedActivity::class)->create([
	        				'user_id' => $user_id,
	        				'itinerary_id' => $itinerary_id,
	        				'activity_id' => $activity_id
        				]);
        			}
        		}
        	}
        }
    }
}
