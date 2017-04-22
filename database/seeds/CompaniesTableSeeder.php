<?php

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\User;

class CompaniesTableSeeder extends Seeder
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
            Company::create([
                'user_id' => $user_id,
                'name' => $faker->company(),
                'country' => $faker->country(),
                'city' => $faker->city(),
                'address' => $faker->address(),
                'postal' => $faker->postcode(),
                'phone' => $faker->phoneNumber(),
                'email' => $faker->companyEmail(),
            ]);
        }
    }
}
