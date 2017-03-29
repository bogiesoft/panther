<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_hotel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id')
                ->unsigned();
            $table->integer('facility_id')
                ->unsigned();
            $table->foreign('hotel_id')
                ->references('id')
                ->on('hotels');
            $table->foreign('facility_id')
                ->references('id')
                ->on('facilities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('facility_hotel');
    }
}
