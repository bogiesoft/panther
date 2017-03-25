<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsRoomAmenityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_room_amenity', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id')
                ->unsigned();
            $table->integer('room_amenity_id')
                ->unsigned();
            $table->foreign('room_id')
                ->references('id')
                ->on('rooms');
            $table->foreign('room_amenity_id')
                ->references('id')
                ->on('room_amenities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('room_room_amenity');
    }
}
