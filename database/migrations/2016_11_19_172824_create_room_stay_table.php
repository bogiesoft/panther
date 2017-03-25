<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomStayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_stay', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('stay_id')
                ->unsigned();
            $table->integer('room_id')
                ->unsigned();

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms');

            $table->foreign('stay_id')
                ->references('id')
                ->on('stays');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('room_stay');
    }
}
