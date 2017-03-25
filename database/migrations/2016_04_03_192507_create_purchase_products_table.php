<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_id')
                ->unsigned();
            $table->string('name');
            $table->string('image_name');
            $table->string('image_path');
            $table->string('image_extension');
            $table->string('image_name_small');
            $table->string('image_path_small');
            $table->string('image_extension_small');
            $table->integer('quantity');
            $table->decimal('price');
            $table->timestamps();

            $table->foreign('purchase_id')
                ->references('id')
                ->on('purchases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('purchase_products');
    }
}
