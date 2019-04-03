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
        foreach ($user_ids as $user_id) {
            factory(App\Itinerary::class, 3)->create([
                'user_id' => $user_id,
            ]);  
        }
    }
}
