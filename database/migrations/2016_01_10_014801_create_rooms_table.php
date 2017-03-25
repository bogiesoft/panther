<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id')
                ->unsigned();
            $table->string('name');
            $table->string('number');
            $table->string('floor');
            $table->string('size');
            $table->integer('capacity');
            $table->decimal('price')
                ->nullable();
            $table->boolean('private');
            $table->boolean('suite');
            $table->timestamps();

            $table->foreign('hotel_id')
                ->references('id')
                ->on('hotels');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rooms');
    }
}
