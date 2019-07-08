<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;

class Mechanic extends Authenticatable
{
	use HasMultiAuthApiTokens, Notifiable;
	
	protected $appends = ['rating'];

	protected $hidden = ['password', 'remember_token'];

	public function getRatingAttribute()
    {
        return Review::where('mechanic_id', $this->id)->where('reviewer', 'user')->avg('star');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
    
    public function offers()
    {
        return $this->hasMany('App\Offer');
    }
}
