<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contactDetails extends Model
{
    protected $fillable = ['name', 'email', 'phoneNo', 'message', 'created_at', 'updated_at'];
}
