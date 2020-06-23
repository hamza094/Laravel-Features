<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

use Auth;

use App\Product;

use Session;

use App\Order;

use Notification;

use App\User;
class ProductController extends Controller
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
         $products=Product::all();
        return view('products.index')->with('product',$products);
        

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $categories=Category::all();
        return view('products.add')->with('category',$categories);
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
            'name'=>'required',
            'description'=>'required',
            'image'=>'required|url',
            'category_id'=>'required',
            'price'=>'required',
            'item_qty'=>'required'   
        ]);
        
        $product=Product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$request->image,
            'category_id'=>$request->category_id,
            'price'=>$request->price,
            'item_qty'=>$request->item_qty
            ]);
        
            
        Session::flash('success','Product Created Successfully');
            
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products=Product::where('id',$id)->first();
        $categories=Category::all();
        return view('ProductSingle')->with('product',$products)->with('category',$categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products=Product::find($id);
       $categories=Category::all();
       return view('products.edit')->with('product',$products)
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
            'name'=>'required',
            'description'=>'required',
            'image'=>'required|url',
            'category_id'=>'required',
            'price'=>'required',
            'item_qty'=>'required'  
        ]);
        
       $product=Product::find($id);
        
        $product->name=$request->name;
        $product->image=$request->image;
        $product->category_id=$request->category_id;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->item_qty=$request->item_qty;
        $product->save();
        Session::flash('success','Product Updated Successfully');
       return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
        Session::flash('info','Product Deleted Successfully');
        return redirect()->back();
    }
    
    public function shop(){
     $products=Product::paginate(4);
      $categories=Category::all();
      return view('shop')->with('product',$products)
      ->with('category',$categories);
        
      }
    
    public function pdtcat($id){
         $pcats=Category::find($id);
        $categories=Category::all();
        return view('shopcat')->with('pcat',$pcats)->with('category',$categories);
    }
    
    public function order(){
        $orders=Order::all();
        return view('products.orders')->with('orders',$orders);
    }
    public function deliver($id){
        $order=Order::find($id);
        $user=User::find($id);
        $order->increment('status');
        $email=$order->user;
        Notification::send($email,new \App\Notifications\ProductDelivered);
        Session::flash('success','Order Deliverd! Notification send to customer');
        return redirect()->back();
    }
    public function search(){
        $product=Product::where('name','like','%'.request('query').'%')->get();
         $categories=Category::all();
        return view('results')->with('product',$product)->with('category',$categories)->with('query',request('query'));
    }
}

