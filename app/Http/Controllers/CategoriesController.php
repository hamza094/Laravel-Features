<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoriesController extends Controller
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
        $category=Category::all();
        
        return view('categories.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.new');
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
            "title"=>"required"
        ]);
        
          $category=Category::create($request->all());
        $category=Category::all();
        return view('categories.index',compact('category'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=Category::find($id);
        return view('category',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::find($id);
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            "title"=>"required"
        ]);
        $cat=Category::find($request->id);
        $cat->title=$request->title;
        $cat->save();
        $category=Category::all();
        return view('categories.index',compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat=Category::find($id);
        foreach($cat->articles as $art){
         $art->forceDelete();
        }
         foreach($cat->products as $pdt){
         $pdt->forceDelete();
        }
        $cat->delete();
        $category=Category::all();
        return view('categories.index',compact('category'));
    }
    
    public function search(Request $request){
        $category=Category::where('title','LIKE',"%$request->term%")->pluck('title');
        if(empty($category->all())){
            return['No Task Found....'];
        }else{
            return $category;
        }
    }
}
