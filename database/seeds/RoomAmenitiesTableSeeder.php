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
        $hotelIds = Hotel::pluck('id')->all();

        foreach($hotelIds as $hotelId)
        {
            foreach (range(1, 10) as $index)
            {
                RoomAmenity::create([
                    'name' => $faker->word(),
                    'hotel_id' => $hotelId
                ]);
            }
        }
    }
}
