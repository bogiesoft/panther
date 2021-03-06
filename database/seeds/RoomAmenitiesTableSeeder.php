<?php

use App\Models\RoomAmenity;
use App\Models\Hotel;
use Illuminate\Database\Seeder;


class RoomAmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(3, 15) as $index)
        {
            RoomAmenity::create([
                'name' => $faker->word()
            ]);
        }
    }
}
