<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;


class Product extends Model
{
    protected $fillable=['name','image','price','description','category_id','item_qty'];
    
    public function category(){
    return $this->belongsTo('App\Category');
    }
    public function reviews(){
        return $this->hasMany('App\PorductReview');
    }
    
    /*public function getStarRating(){
        $count=$this->reviews()->count();
        if(empty($count)){
            return 0;
        }
        $starCountSum=$this->reviews()->sum(number_format('cast(rating as float)'));
        $average=$starCountSum/$count;
        return $starCountSum;
    }*/
    
       public function is_reviewed_by_auth_user(){
        $id=Auth::id();
        $reviewers=array();
        foreach($this->reviews as $review):
        array_push($reviewers,$review->user_id);
        endforeach;
        if(in_array($id,$reviewers)){
            return true;
        }
        else{
            return false;
        }
    }   
}





