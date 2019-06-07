<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product details extends Model
{
    public function card_details()
    {
    	return $this->belongsTo('App\card_details');
    }
}
