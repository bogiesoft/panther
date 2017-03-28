<?php

use App\Models\Stay;
use App\Models\Hotel;
use Illuminate\Database\Seeder;


class StaysTableSeeder extends Seeder
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

        foreach ($hotels as $hotel) {

            $rooms = $hotel->rooms;

            foreach($rooms as $room)
            {
                $is_checked_in = $faker->optional(0.8)->randomDigit;
                $is_checked_out = $faker->optional(0.8)->randomDigit;
                $is_room_booked = $faker->optional(0.8)->randomDigit;

                $beds = $room->beds;

                foreach($beds as $bed)
                {
                    $start = $faker->dateTimeThisDecade();
                    $end = clone $start;
                    $end->add(new DateInterval('P'.$faker->randomDigit(1,7).'D'));
                    Stay::create([
                        'hotel_id' => $hotel->id,
                        'bed_id' =>  is_null($is_room_booked) ? null : $bed->id,
                        'start' => $start,
                        'end' => $end,
                        'checkin' => is_null( $is_checked_in) ? $start : null,
                        'checkout' => (is_null($is_checked_in) && is_null($is_checked_out)) ? $end : null
                    ]);
                }
            }
        }
    }
}
