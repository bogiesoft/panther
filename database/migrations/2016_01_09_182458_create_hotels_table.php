<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->softDeletes();

            $table->increments('id');
            $table->integer('user_id')
                ->unsigned();
            $table->string('name');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('postal');
            $table->string('phone');
            $table->string('fax')
                ->nullable();
            $table->string('email')
                ->nullable();
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hotels');
    }
}
