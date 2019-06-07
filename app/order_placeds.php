<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_placeds extends Model
{
    protected $fillable = [ 'user_id', 'product_id', 'transaction_no', 'order_no', 'order_statuis', 'payment_mode', 'quantity', 'price', 'totalPrice', 'created_at', 'updated_at' ];
}
