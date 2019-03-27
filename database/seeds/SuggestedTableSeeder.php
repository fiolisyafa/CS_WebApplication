<?php

use App\City;
use App\ActivityType;
use Illuminate\Database\Seeder;

class SuggestedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$city_ids = City::all()->pluck('id')->toArray();
    	$activity_type_ids = ActivityType::all()->pluck('id')->toArray();
    	foreach ($city_ids as $city_id) {
    		foreach($activity_type_ids as $activity_type_id) {
    			factory(App\SuggestedActivity::class)->create([
    				'city_id' => $city_id,
    				'activity_type_id' => $activity_type_id
    			]);
    		}
    	}
    }
}
