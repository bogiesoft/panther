<?php

use App\Models\Hotel;
use App\Models\Purchase;
use Illuminate\Database\Seeder;


class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $hotel = Hotel::first();

        $stays = $hotel->stays->where("checkout", null);

        foreach($stays as $stay)
        {
            $guests = $stay->guests;

            foreach($guests as $guest)
            {
                $numPurchases = $faker->numberBetween(0,4);

                for ($i = 0; $i < $numPurchases; $i++)
                {
                    Purchase::create([
                        'user_id' => $guest->id,
                        'stay_id' => $stay->id,
                        'purchased' => $faker->numberBetween(0,1) == 1 ? $faker->dateTime() : null,
                    ]);
                }
            }
        }
    }
}