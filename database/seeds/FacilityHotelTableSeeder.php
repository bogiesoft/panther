<?php

use Illuminate\Database\Seeder;

use App\Models\Hotel;
use App\Models\Facility;

class FacilityHotelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $hotel_ids = Hotel::pluck('id')->all();
        $facilities = Facility::pluck('id')->all();

        foreach ($hotel_ids as $hotel_id)
        {
            $num_facilities = $faker->numberBetween(3, 5);

            for ($i = 0; $i < $num_facilities; $i++) {
                DB::table('facility_hotel')->insert([
                    'hotel_id' => $hotel_id,
                    'facility_id' => $facilities[$faker->numberBetween(0, sizeof($facilities) - 1 )],
                ]);
            }
        }
    }
}
