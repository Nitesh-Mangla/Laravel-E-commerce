<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class newsletter extends Model
{
    protected $fillable = [ 'email', 'created_at', 'updated_at', 'status' ];
}
