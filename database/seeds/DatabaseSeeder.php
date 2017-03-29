<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @var array
     */
    private $tables = [
        'users',
        'hotel_types',
        'hotels',
        'room_room_amenity',
        'room_amenities',
        'room_types',
        'bed_types',
        'rooms',
        'beds',
        'products',
        'stays',
        'room_stay',
        'guest_stay',
        'employees',
        'purchases',
        'purchase_products',
        'facilities',
        'facility_hotel'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

        $this->call(UsersTableSeeder::class);
        $this->call(HotelTypesTableSeeder::class);
        $this->call(HotelsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(GuestsTableSeeder::class);
        $this->call(RoomTypesTableSeeder::class);
        $this->call(BedTypesTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(BedsTableSeeder::class);
        $this->call(RoomAmenitiesTableSeeder::class);
        $this->call(RoomsRoomAmenityTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(StaysTableSeeder::class);
        $this->call(RoomStayTableSeeder::class);
        $this->call(GuestStayTableSeeder::class);
        $this->call(PurchasesTableSeeder::class);
        $this->call(PurchaseProductsTableSeeder::class);
        $this->call(FacilitiesTableSeeder::class);
        $this->call(FacilityHotelTableSeeder::class);
    }

    /**
     * Cleans the database by iterating and truncating all db tables
     */
    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $tableName)
        {
            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
