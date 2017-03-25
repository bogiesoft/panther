<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id')
                ->unsigned();
            $table->string('name');
            $table->string('image_name');
            $table->string('image_path');
            $table->string('image_extension');
            $table->string('image_name_small');
            $table->string('image_path_small');
            $table->string('image_extension_small');
            $table->decimal('price');
            $table->integer('inventory');
            $table->boolean('available');
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
        Schema::drop('products');
    }
}
