<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;

use App\Category;

use App\Tag;

use App\User;

use App\Comment;

use Auth;

use Session;

use App\Subcribe;

use Notification;

use App\Product;

class FrontController extends Controller
{
    
      public function welcome(){
          $articles=Article::orderBy('created_at', 'desc')->paginate(6);
          $categories=Category::all();
          return view('welcome')->with('article',$articles)
              ->with('category',$categories);
    }
    
    
    
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $articles=Article::where('slug',$slug)->first();
        
        $categories=Category::all();
        
         $related_articles= Article::where('category_id', '=', $articles->category->id)
            ->where('id', '!=', $articles->id)
            ->get();
                
        return view('single')->with('article',$articles)->with('category',$categories)->with('related_articles',$related_articles);
    }
     
     public function catshow($id)
    {
        $scats=Category::find($id);
        $categories=Category::all();
        return view('category')->with('scat',$scats)->with('category',$categories);
    }
    
      public function usershow($id)
    {
        $users=User::find($id);
        $categories=Category::all();
        return view('user')->with('user',$users)->with('category',$categories);
    }
    
    public function comment($id){
          $article=Article::find($id);
        
           $comment=Comment::create([
            'content'=>request()->content,
            'user_id'=>Auth::user()->id,
            'article_id'=>$id
            
        ]);
        
        $subscribers=array();
        foreach($article->subscribers as $subscribe):
        array_push($subscribers,User::find($subscribe->user_id));    
        endforeach;    
        Notification::send($subscribers,new \App\Notifications\NewCommentAdded($article));
        
        
        $comment->save();
       Session::flash('success','Comment created successfuly'); 
        return redirect()->back();
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function subscribe($id){
        $subscribe=Subcribe::create([
            'user_id'=>Auth::id(),
            'article_id'=>$id
        ]);
        Session::flash('success','You subscribed the article.');
        return redirect()->back();
    }
    public function unsubscribe($id){
        $subscribe=Subcribe::find($id);
        $subscribe->delete();
        Session::flash('info','You unsubscribed  the article successfully.');
        return redirect()->back();
    }
    public function search(){
         $categories=Category::all();
        return view('search')->with('category',$categories);;
    }
}
