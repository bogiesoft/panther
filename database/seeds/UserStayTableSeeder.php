
<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Models\Hotel;


class UserStayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $userIds = User::pluck('id')->all();

        $hotels = Hotel::all();

        foreach ($hotels as $hotel)
        {
            $stays = $hotel->stays;

            foreach ($stays as $stay)
            {
                DB::table('user_stay')->insert([
                    'stay_id' => $stay->id,
                    'user_id' => $faker->randomElement($userIds)
                ]);
            }
        }
    }
}

