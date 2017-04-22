<?php

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\User;
use App\Models\Hotel;

class CompanyEmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder assigns employees to companies and in turn hotels
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $companies = Company::all();

        foreach ($companies as $company)
        {
            $hotels = $company->hotels;

            foreach($hotels as $hotel)
            {
                $num_employees = $faker->numberBetween(2,4);

                for ($i = 0; $i < $num_employees; $i++) 
                {
                    $user = User::create([
                        'first_name' => $faker->firstName(),
                        'last_name' => $faker->lastName(),
                        'email' => $faker->email(),
                        'password' => Hash::make('philip1234'),
                        'country' => $faker->country(),
                        'phone' => $faker->phoneNumber(),
                        'city' => $faker->city(),
                        'verified' => true
                    ]);

                    DB::table('company_employee')->insert([
                        'company_id' => $company->id,
                        'user_id' => $user->id,
                        'hotel_id' => $hotel->id
                    ]);
                }
            }
        }
    }
}
