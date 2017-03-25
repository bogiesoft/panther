
<?php

use Illuminate\Database\Seeder;

use App\Models\Guest;
use App\Models\Hotel;


class GuestStayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $guestIds = Guest::pluck('id')->all();

        $hotels = Hotel::all();

        foreach ($hotels as $hotel)
        {
            $stays = $hotel->stays;

            foreach ($stays as $stay)
            {
                DB::table('guest_stay')->insert([
                    'stay_id' => $stay->id,
                    'guest_id' => $faker->randomElement($guestIds)
                ]);
            }
        }
    }
}

