<?php

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Database\Seeder;


class RoomsTableSeeder extends Seeder {

	/**
	 *
     */
	public function run()
	{
		$faker = Faker\Factory::create();
		$hotelIds = Hotel::pluck('id')->all();

		foreach ($hotelIds as $hotelId) {

			$numRooms = $faker->numberBetween(4,16);

			for ($i = 0; $i < $numRooms; $i++) {
				Room::create([
					'hotel_id' => $hotelId,
					'name' => $faker->word(),
					'number' => $i + 1,
					'floor' => 1,
					'size' => $faker->numberBetween(300, 2500),
					'capacity' => $faker->numberBetween(1,20),
					'price' => $faker->numberBetween(1,100),
					'private' => $faker->boolean(50),
					'suite' => $faker->boolean(20)
				]);
			}
		}
	}
}