<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestStayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_stay', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('stay_id')
                ->unsigned();
            $table->integer('guest_id')
                ->unsigned();

            $table->foreign('guest_id')
                ->references('id')
                ->on('guests');

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
        Schema::drop('guest_stay');
    }
}
