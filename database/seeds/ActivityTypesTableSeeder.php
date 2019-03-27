<?php

use Illuminate\Database\Seeder;

class ActivityTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activity_types = ['theme parks', 'beaches', 'shopping', 'cafes', 'traditional', 'mountain', 'nightlife', 'food', 'hot springs', 'walking', 'casino', 'scenic'];
        
        foreach ($activity_types as $activity_type) {
        	factory(App\ActivityType::class)->create([
        		'type' => $activity_type
        	]);
        }        
    }
}
