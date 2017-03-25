<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id')
                ->unsigned();
            $table->integer('bed_type_id')
                ->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms');
            $table->foreign('bed_type_id')
                ->references('id')
                ->on('bed_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('beds');
    }
}
