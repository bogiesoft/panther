<?php

use Illuminate\Database\Seeder;
use App\Models\Bed;
use App\Models\Room;
use App\Models\Hotel;


class BedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $roomIds = Room::pluck('id')->all();

        $hotels = Hotel::all();

        foreach ($hotels as $hotel)
        {
            $rooms = $hotel->rooms;
            $bed_types = $hotel->bed_types;

            foreach ($rooms as $room)
            {
                $numBeds = $faker->numberBetween(1,5);

                for($i = 0; $i < $numBeds; $i++)
                {
                    $bed_type = $bed_types[$faker->numberBetween(0, sizeof($bed_types) - 1)];

                    Bed::create([
                        'room_id' => $room->id,
                        'name' => $i,
                        'bed_type_id' => $bed_type->id,
                    ]);
                }
            }
        }
    }
}
