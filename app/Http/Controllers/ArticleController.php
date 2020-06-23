<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;

use App\Category;

use Auth;

use App\Article;

use Session;

use Notification;

class ArticleController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article=Article::all();
        return view('articles.index',compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags=Tag::all();
        $categories=Category::all();
        
        return view('articles.add')->with('tag',$tags)->with('category',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'img'=>'required|url',
            'category_id'=>'required',
            'tags'=>'required'
            
        ]);
        
        $article=Article::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'img'=>$request->img,
            'category_id'=>$request->category_id,
            'slug'=>str_slug($request->title),
            'user_id'=>Auth::id()
            ]);
        
        $article->tags()->attach($request->tags);
        
        Session::flash('success','Article Created Successfully');
            
        return redirect()->route('articles.index');
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
        $articles=Article::find($id);
        
         $tags=Tag::all();
        $categories=Category::all();
        
        return view('articles.edit')->with('article',$articles)
            ->with('tag',$tags)
            ->with('category',$categories);
        
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
         $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'img'=>'required|url',
            'category_id'=>'required',
            'tags'=>'required'
            
        ]);
        
       $article=Article::find($id);
        
        $article->title=$request->title;
        $article->img=$request->img;
        $article->category_id=$request->category_id;
        $article->content=$request->content;
        $article->save();
        
        $article->tags()->sync($request->tags);
        
        Session::flash('success','Article Updated Successfully');
            
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $article=Article::withTrashed()->where('id',$id)->first();
        $article->forceDelete();
        Session::flash('success','Article Deleted Successfully');
        return redirect()->back();
    }
    
    public function trash($id){
        $article=Article::find($id);
        $article->delete();
        Session::flash('info','Article Trased Successfully');
        return redirect()->back();
    }
            
    public function trashed(){
        $articles=Article::onlyTrashed()->get();
        return view('articles.trash')->with('article',$articles);
    }
    
    public function revert($id){
        $articles=Article::withTrashed()->where('id',$id)->first();
        $articles->restore();
        Session::flash('success','Article Reverted Successfully');
        return redirect()->route('articles.index');
    }
}
