<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
 use Laravel\Scout\Searchable;

class Comment extends Model
{
    
    public $with=['user','likes'];
    
    protected $appends=['LikesCount','isLiked'];
    
    use Searchable;
    protected $fillable=['user_id','article_id','content'];
    
    public function article(){
        return $this->belongsTo('App\Article');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function likes(){
        return $this->hasMany('App\Like'); 
    }
    public function getLikesCountAttribute(){
        return $this->likes->count();
    }
    
       public function is_liked_by_auth_user(){
        $id=Auth::id();
        $likers=array();
        foreach($this->likes as $like):
        array_push($likers,$like->user_id);
        endforeach;
        if(in_array($id,$likers)){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function isLiked(){
    return !! $this->likes->where('user_id', Auth::id())->count();
    }
    
    public function getIsLikedAttribute()
    {
        return $this->isLiked();
    }
    
}
