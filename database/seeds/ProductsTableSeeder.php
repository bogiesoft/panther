<?php

use App\Models\Product;
use App\Models\Hotel;
use Illuminate\Database\Seeder;


class ProductsTableSeeder extends Seeder
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
            $numProducts = $faker->numberBetween(3, 10);

            for ($i = 0; $i < $numProducts; $i++) {
                Product::create([
                    'name' => $faker->word(),
                    'hotel_id' => $hotelId,
                    'image_name' => $faker->word(),
                    'image_path' => '/' . $faker->word(),
                    'image_extension' => $faker->fileExtension(),
                    'image_name_small' => $faker->word(),
                    'image_path_small' => '/' . $faker->word(),
                    'image_extension_small' => $faker->fileExtension(),
                    'inventory' => $faker->randomDigit(),
                    'price' => $faker->numberBetween(0, 20),
                    'available' => $faker->boolean(95)
                ]);
            }
        }
    }
}