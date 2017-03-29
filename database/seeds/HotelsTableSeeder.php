<?php

use Illuminate\Database\Seeder;

use App\Models\Hotel;
use App\User;
use App\Models\HotelType;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $hotel_types = HotelType::all();
        $user_ids = User::pluck('id')->all();

        foreach ($user_ids as $user_id)
        {
            $num_hotels = $faker->numberBetween(1,4);

            for ($i = 0; $i < $num_hotels; ++$i)
            {
                Hotel::create([
                    'user_id' => $user_id,
                    'type_id' => $hotel_types[$faker->numberBetween($min = 0, $max = sizeof($hotel_types) - 1)]->id,
                    'name' => $faker->company(),
                    'country' => $faker->country(),
                    'city' => $faker->city(),
                    'address' => $faker->address(),
                    'postal' => $faker->postcode(),
                    'phone' => $faker->phoneNumber(),
                    'fax' => $faker->phoneNumber(),
                    'email' => $faker->companyEmail(),
                    'rating' => ($faker->numberBetween($min = 0, $max = 50) / 10),
                    'longitude' => $faker->longitude(),
                    'latitude' => $faker->latitude(),
                ]);
            }
        }
    }
}
