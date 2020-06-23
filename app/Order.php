<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Order extends Model
{
     protected $fillable=['product_id','order_id','qty','total','user_id','address','status','city','zip','country'];
    
    
    public function orderItems(){
        return $this->belongsToMany('App\Product')->withPivot('qty','total');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    
      public function getAddressAttribute($value)
    {
            return ucwords($value);
    }
    
      public function getCityAttribute($value)
    {
            return ucwords($value);

    }
 
}
