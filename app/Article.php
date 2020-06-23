<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Article extends Model
{
     use Searchable;
    
    use SoftDeletes;
    
    protected $fillable=['title','content','slug','img','category_id','user_id'];
    
    protected $dates=['deleted_at'];
        
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
    
    public function category(){
        return $this->belongsTo('App\Category'); 
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    
    public function subscribers(){
        return $this->hasMany('App\Subcribe');
    }
    
           public function is_subscribed_by_auth_user(){
        $id=Auth::id();
        $subscribers=array();
        foreach($this->subscribers as $subscribe):
        array_push($subscribers,$subscribe->user_id);
        endforeach;
        if(in_array($id,$subscribers)){
            return true;
        }
        else{
            return false;
        }
    }
    
    
}
