<?php

use App\Models\RoomType;
use App\Models\Hotel;
use Illuminate\Database\Seeder;


class RoomTypesTableSeeder extends Seeder
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
            foreach (range(1,$faker->numberBetween(5,10)) as $index) {

                RoomType::create([
                    'name' => $faker->word(),
                    'hotel_id' => $hotelId
                ]);
            }
        }
    }
}
