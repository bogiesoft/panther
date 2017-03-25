<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id')
                ->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('email')
                ->unique();
            $table->string('phone');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('postal');
            $table->string('password', 10);
            $table->boolean('active');
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
        Schema::drop('employees');
    }
}
