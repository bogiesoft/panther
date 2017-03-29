<?php

use Illuminate\Database\Seeder;

use App\Models\Facility;

class FacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        foreach (range(1, 20) as $index)
        {
            Facility::create([
                'name' => $faker->word()
            ]);
        }
    }
}
