<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('product details', function(Blueprint $table){
         $table->increments('id');
        $table->string('product name');
        $table->text('description');
        $table->integer('quantity');
        $table->integer('price');
        $table->string('image');
        $table->integer('discount');
        $table->string('category');
        $table->string('type');
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
        schema::dropIfExists('product details');
    }
}
