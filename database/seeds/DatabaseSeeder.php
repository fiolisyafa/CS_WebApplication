<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ActivityTypesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(SuggestedTableSeeder::class);
        $this->call(ItinerariesTableSeeder::class);
        $this->call(PreferencesTableSeeder::class);
        $this->call(SelectedTableSeeder::class);
        $this->call(CustomTableSeeder::class);
    }
}
