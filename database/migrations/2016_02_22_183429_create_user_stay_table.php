<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_stay', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('stay_id')
                ->unsigned();
            $table->integer('user_id')
                ->unsigned();

            $table->foreign('stay_id')
                ->references('id')
                ->on('stays');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

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
        Schema::drop('user_stay');
    }
}
