<?php

use App\User;
use App\Itinerary;
use App\ActivityType;
use Illuminate\Database\Seeder;

class PreferencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();
        foreach ($user_ids as $user_id) {
        	$itinerary_ids = Itinerary::where('user_id', $user_id)->pluck('id')->toArray();
    		foreach ($itinerary_ids as $itinerary_id) {
    			$activity_type_ids = ActivityType::get()->random(3)->pluck('id')->toArray();
    			foreach ($activity_type_ids as $activity_type_id) {
	    			factory(App\Preference::class)->create([
						'user_id' => $user_id,
	        			'itinerary_id' => $itinerary_id,
	        			'activity_type_id' => $activity_type_id
	    			]);
    			}
    		}
        }
    }
}
