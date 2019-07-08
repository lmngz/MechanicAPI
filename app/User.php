<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;

class User extends Authenticatable
{
    use HasMultiAuthApiTokens, Notifiable;

    protected $appends = ['rating'];

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function getRatingAttribute()
    {
        return Review::where('user_id', $this->id)->where('reviewer', 'mechanic')->avg('star');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function offers()
    {
        return $this->hasMany('App\Offer');
    }

    public function vehicle()
    {
        return $this->hasOne('App\Vehicle');
    }
}
