<?php

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Hotel;


class RoomStayTableSeeder extends Seeder
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
            $stays = $hotel->stays;
            $room_ids = $hotel->rooms->pluck('id')->all();

            foreach ($stays as $stay)
            {
                if(is_null($stay['bed_id']))
                {
                    DB::table('room_stay')->insert([
                        'stay_id' => $stay->id,
                        'room_id' => $faker->randomElement($room_ids)
                    ]);
                }
            }
        }
    }
}
