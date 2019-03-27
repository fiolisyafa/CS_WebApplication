<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $faker = new Faker\Generator();
        // $faker->addProvider(new Faker\Provider\en_US\Address($faker));
        
        // for ($i=1; $i<=5; $i++) {
        //     factory(App\City::class)->create([
        //         'city' => $faker->unique()->state,
        //         'country' => 'united states',
        //     ]);
        // }

        // $fak = new Faker\Generator();
        // $fak->addProvider(new Faker\Provider\en_AU\Address($fak));
        
        // for ($i=1; $i<=5; $i++) {
        //     factory(App\City::class)->create([
        //         'city' => $fak->unique()->state,
        //         'country' => 'australia',
        //     ]);
        // }

        factory(App\City::class)->create([
            'country' => 'lorem'
        ]);

        factory(App\City::class)->create([
            'country' => 'ipsum'
        ]);       
    }
}
