<?php

use Illuminate\Database\Seeder;

use App\Models\Hotel;
use App\User;

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
        $user_ids = User::pluck('id')->all();

        foreach ($user_ids as $user_id)
        {
            $num_hotels = $faker->numberBetween(2,3);

            for ($i = 0; $i < $num_hotels; ++$i)
            {
                Hotel::create([
                    'user_id' => $user_id,
                    'name' => $faker->company(),
                    'country' => $faker->country(),
                    'city' => $faker->city(),
                    'address' => $faker->address(),
                    'postal' => $faker->postcode(),
                    'phone' => $faker->phoneNumber(),
                    'fax' => $faker->phoneNumber(),
                    'email' => $faker->companyEmail(),
                    'longitude' => $faker->longitude(),
                    'latitude' => $faker->latitude(),
                ]);
            }
        }
    }
}
