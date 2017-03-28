<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $num_users = 35;

        $faker = Faker\Factory::create();

        User::create([
            'first_name' => 'Philip',
            'last_name' => 'Blaquiere',
            'email' => 'philipblaquiere@gmail.com',
            'password' => Hash::make('philip1234')
        ]);

        for ($i=0; $i < $num_users; $i++) { 
            User::create([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $faker->email(),
                'password' => Hash::make('philip1234')
            ]);
        }
    }
}
