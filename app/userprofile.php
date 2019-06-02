<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userprofile extends Model
{
    protected $fillable = [ 'user_id', 'image', 'phone_no', 'status', 'address', 'city', 'state' ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}

