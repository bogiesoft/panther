<?php

use Illuminate\Database\Seeder;

use App\Models\BedType;
use App\Models\Hotel;


class BedTypesTableSeeder extends Seeder
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

        foreach ($hotelIds as $hotelId)
        {
            for($i = 0; $i < $faker->numberBetween(3,7); $i++)
            {
                BedType::create([
                    'hotel_id' => $hotelId,
                    'type' => $faker->word(),
                ]);
            }
        }

    }
}
