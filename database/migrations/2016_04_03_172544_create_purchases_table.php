<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guest_id')
                ->unsigned();
            $table->integer('stay_id')
                ->unsigned();
            $table->timestamp('purchased')->nullable();
            $table->timestamps();

            $table->foreign('guest_id')
                ->references('id')
                ->on('guests');

            $table->foreign('stay_id')
                ->references('id')
                ->on('stays');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('purchases');
    }
}
