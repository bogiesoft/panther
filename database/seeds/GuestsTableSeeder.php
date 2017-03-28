<?php

use App\Models\Guest;
use Illuminate\Database\Seeder;


class GuestsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(5,20) as $index) 
        { 
            Guest::create([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'country' => $faker->country(),
            ]);
        }
    }
}