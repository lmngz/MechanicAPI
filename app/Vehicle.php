<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
	public function users()
    {
    	return $this->hasMany('App\User');
    }

    public function problems()
    {
    	return $this->hasMany('App\Problem');
    }
}
