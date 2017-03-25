<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stays', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('hotel_id')
                ->unsigned();
            $table->integer('bed_id')
                ->unsigned()
                ->nullable();

            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();

            $table->timestamp('checkin')->nullable();
            $table->timestamp('checkout')->nullable();

            $table->timestamps();

            $table->foreign('hotel_id')
                ->references('id')
                ->on('hotels');
            $table->foreign('bed_id')
                ->references('id')
                ->on('beds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stays');
    }
}
