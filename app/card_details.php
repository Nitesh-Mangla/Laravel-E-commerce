<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class card_details extends Model
{
    public function proudct_details()
    {
    	return $this->hasMany('App\product details');
    }
}
