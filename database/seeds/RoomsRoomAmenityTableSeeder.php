<?php

use App\Models\Room;
use App\Models\Hotel;
use App\Models\RoomAmenity;
use Illuminate\Database\Seeder;


class RoomsRoomAmenityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $hotels = Hotel::all();

        foreach ($hotels as $hotel)
        {
            $roomIds = $hotel
                ->rooms
                ->pluck('id')
                ->all();

            $roomAmenityIds = RoomAmenity::pluck('id')->all();

            foreach ($roomIds as $roomId)
            {
                for ($i = 0; $i < $faker->randomDigit(4,count($roomAmenityIds)); ++$i)
                {
                    DB::table('room_room_amenity')->insert([
                        'room_id' => $roomId,
                        'room_amenity_id' => $roomAmenityIds[$i],
                    ]);
                }
            }
        }
    }
}
