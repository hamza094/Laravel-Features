<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['title'];
    
    
     public function articles(){
        return $this->hasMany('App\Article');
    }
     public function products(){
        return $this->hasMany('App\Product');
    }
}
