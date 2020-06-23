<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Cart;
use Session;
use App\Product;
use Auth;
use App\Category;
use Stripe\Stripe;
use Stripe\Charge;
use App\Shop;
use App\Address;
use App\Order;

class ShopController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function addcart(){
        
        $pdt=Product::find(request()->pdt_id);
       if($pdt->item_qty<request()->qty){
        Session::flash('info','Please Select Limited items from Stock');
           
        return redirect()->back();
        }else{
            $cartItem=Cart::add([
            'id'=>$pdt->id,
            'name'=>$pdt->name,
            'qty'=>request()->qty,
            'price'=>$pdt->price,
            
        ]);
        Cart::associate($cartItem->rowId,'App\Product');
        Session::flash('success','Product Added To You Cart Successfully');
        return redirect()->route('cart');
        }
         }
     
        
    
    
    public function cart(){
        if(Cart::content()->count()==0){
            Session::flash('info','Your cart is empty!Buy some products');
            return redirect()->route('shop');
            
        }
         
        $categories=Category::all();
        return view('cart')->with('category',$categories);
       
    }
    
    public function cartdelete($id){
        Cart::remove($id);
        return redirect()->back();
    }
    
    public function cartreduce($id,$qty){
        Cart::update($id,$qty-1);
        return redirect()->back();
    }
    
    public function cartincr($id,$qty){
        $pdt=Product::find(request()->pdt_id);
        Cart::update($id,$qty+1);
        if($qty>=$pdt->item_qty){
            Session::flash('info','Select linited amount of quantity');
            Cart::update($id,$qty);
            return redirect()->back();
            
        }
        return redirect()->back();
    }
    
    public function paymentcheckout(){
        $categories=Category::all();
        
          $cartItems=Cart::content();
          foreach($cartItems as $item){
            $product=Product::find($item->model->id);
            if($item->qty>$product->item_qty){
                Session::flash('info','Please Select Limited items from Stock');
                return redirect()->back();
            }
          }
        
        
        return view('checkout')->with('category',$categories);
    }
    
    
    public function checkout(){
        
        Stripe::setApiKey(env('STRIPE_SECRET'));
       $charge=Charge::create([
       'amount' => Cart::total()*100,
       'currency' => 'usd',
       'description' => 'Laravel Features Shopping Charge',
       'source' => request()->stripeToken,
]);
    
          $user=Auth::user();
          $order=$user->orders()->create([
          'total'=>Cart::total(),
          'zip'=>request()->stripeShippingAddressZip,
          'country'=>request()->stripeShippingAddressCountry,
          'city'=>request()->stripeShippingAddressCity,
          'address'=>request()->stripeShippingAddressLine1,
          ]);
          
          $cartItems=Cart::content();
          foreach($cartItems as $cartItem){
              $order->orderItems()->attach($cartItem->id,[
                  'qty'=>$cartItem->qty,
                  'total'=>$cartItem->qty*$cartItem->price
              ]);
          }
        
          foreach(Cart::content() as $item){
            $product=Product::find($item->model->id);
            $product->update(['item_qty'=>$product->item_qty - $item->qty]);
        }
        
        Session::flash('success','Purchase Successfull ! wait for mail');
        Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchasedMail);
        Cart::destroy();
        return redirect()->route('shop');
      
        }
    
    public function ordercancel(){
        Cart::destroy();
        Session::flash('info','Order canceled!');
        return redirect()->route('shop');
    }
}
