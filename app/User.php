<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_activated','api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
      public function articles(){
        return $this->hasMany('App\Article');
    }
    
      public function accounts() {
      return $this->hasMany('App\SocialAccount');
    }
    
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function likes(){
        return $this->hasMany('App\Like'); 
    }
     public function subscribers(){
        return $this->hasMany('App\Subcribe');
    }
    public function address(){
        return $this->hasMany(Address::class);
    }
    public function orders(){
        return $this->hasMany('App\Order');
    }
    public function review(){
        return $this->hasOne('App\PorductReview');
    }
    
       public function getemailAttribute($value)
    {
            return ucwords($value);
    }
        public function getnameAttribute($value)
    {
            return ucwords($value);
    }
    
}
