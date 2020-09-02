<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniqueProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unique_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            // option1
            $table->unsignedBigInteger('product_variant_option1_id');
            $table->foreign('product_variant_option1_id')->references('id')->on('product_variant_options');
           // option2 
            $table->unsignedBigInteger('product_variant_option2_id');
            $table->foreign('product_variant_option2_id')->references('id')->on('product_variant_options');
            $table->decimal('price', 8, 2);
            $table->integer('qnt');
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
        Schema::dropIfExists('unique_products');
    }
}
