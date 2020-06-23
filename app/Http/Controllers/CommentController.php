<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;

use App\Comment;

use Auth;

use Session;

use App\Like;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    
      public function cmntedit($id){
        $comment=Comment::find($id);
        return view('cedit',compact('comment'));
    }
    
    public function update(Request $request,$id)
    {
        $comment=Comment::find($id);
        $comment->update(['content'=>request('content')]);
    }
    
    public function destroy($id){
        $comment=Comment::find($id);
        $comment->delete();
        if(request()->expectsJson()){
            return response(['status'=>'Reply deleted']);
        }
    }
 
  
    public function like($id){
        $like=Like::create([
            'user_id'=>Auth::id(),
            'comment_id'=>$id
        ]);
       
    }
    
    public function unlike($id){
    $like=Like::where('comment_id',$id)->where('user_id',Auth::id())->first();
        $like->delete();
       
    }
    
  
}
