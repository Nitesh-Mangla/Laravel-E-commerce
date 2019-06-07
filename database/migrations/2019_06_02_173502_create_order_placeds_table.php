<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPlacedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_placeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer( 'proudct_id' );
            $table->String('transaction_no');
            $table->string( 'order_no' );
            $table->string( 'order_status' );
            $table->string( 'payment_mode' );
            $table->integer( 'quantity' );
            $table->integer( 'price' );
            $table->integer( 'totalPrice' );
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
        Schema::dropIfExists('order_placeds');
    }
}
