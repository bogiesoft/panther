<?php

use Illuminate\Database\Seeder;

use App\Models\Employee;
use App\Models\Hotel;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $hotelIds = Hotel::pluck('id')
            ->all();

        foreach ($hotelIds as $hotelId)
        {
            $numEmployees = $faker->numberBetween(4,10);

            for ($i = 0; $i < $numEmployees; $i++) {
                Employee::create([
                    'hotel_id' => $hotelId,
                    'first_name' => $faker->firstName(),
                    'last_name' => $faker->lastName(),
                    'birth_date' => $faker->date(),
                    'email' => $faker->email(),
                    'phone' => $faker->phoneNumber(),
                    'country' => $faker->country(),
                    'city' => $faker->city(),
                    'address' => $faker->address(),
                    'postal' => $faker->postcode(),
                    'password' => $faker->numberBetween(1000,9999),
                    'active' => $faker->boolean(80),
                ]);
            }
        }
    }
}
