<?php

use App\Models\Hotel;
use App\Models\PurchaseProduct;
use Illuminate\Database\Seeder;


class PurchaseProductsTableSeeder extends Seeder
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
        $products = $hotel->products;
        $stays = $hotel->stays->where("checkout", null);

        foreach($stays as $stay)
        {
            $guests = $stay->guests;

            foreach($guests as $guest)
            {
                foreach($guest->purchases as $purchase)
                {
                    $numProductsPurchased = $faker->numberBetween(1,3);
                    for($i = 0; $i < $numProductsPurchased; $i++ )
                    {
                        $purchasedProduct = $products[mt_rand(0, count($products) - 1)];

                        PurchaseProduct::create([
                            'purchase_id' => $purchase->id,
                            'name' => $purchasedProduct->name,
                            'image_name' => $purchasedProduct->image_name,
                            'image_path' => $purchasedProduct->image_path,
                            'image_extension' => $purchasedProduct->image_extension,
                            'image_name_small' => $purchasedProduct->image_name_small,
                            'image_path_small' => $purchasedProduct->image_path_small,
                            'image_extension_small' => $purchasedProduct->image_extension_small,
                            'price' => $purchasedProduct->price,
                            'quantity' => $faker->numberBetween(1,4)
                        ]);
                    }
                }
            }
        }

    }
}
