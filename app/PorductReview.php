<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PorductReview extends Model
{
    protected $fillable=['user_id','product_id','description','headline','rating'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
