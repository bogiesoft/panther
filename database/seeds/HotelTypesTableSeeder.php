<?php

use Illuminate\Database\Seeder;
use App\Models\HotelType;

class HotelTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $num_types = 10;

        for ($i = 0; $i < $num_types; ++$i)
        {
            HotelType::create([
                'type' => $faker->word()
            ]);
        }
    }
}
