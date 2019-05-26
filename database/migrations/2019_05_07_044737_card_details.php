<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CardDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('card details', function(Blueprint $table){
            $table->increments('id');
            $table->string('email');
            $table->integer('product id');
            $table->integer('quantity');
            $table->integer('price');
            $table->string('coupon no');
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
        schema::dropIfExists('card details');
    }
}
