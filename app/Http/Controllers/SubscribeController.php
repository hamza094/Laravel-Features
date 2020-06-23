<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use Auth;
use Stripe\Stripe;
use Stripe\Charge;
use Session;
use App\User;

class SubscribeController extends Controller
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
        $categories=Category::all();
        return view('subscribe')->with('category',$categories);
        Session::flash('success','You subscribed Successfully');
      return redirect()->back();
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
    
    public function pay(Request $request,$plan){
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $user=Auth::user();
        if($user->subscribed('primary')){
            $user->subscription('primary')->swap($plan);
        }else{
         $user->newSubscription('primary',$plan)->trialDays(14)->create($request->stripeToken);
       }
        Session::flash('success','Subscribed you successfully!');
        return redirect()->back();
        
    }
    public function cancel(){
        Stripe::setApiKey(env('STRIPE_SECRET'));
        Auth::user()->subscription('primary')->cancel();
        Session::flash('info','Your subscription have been expired!');
        return redirect()->back();
    }
    
    public function invoice(Request $request,$invoiceId){
        Stripe::setApiKey(env('STRIPE_SECRET'));
        return $request->user()->downloadInvoice($invoiceId,[
            'vendor'=>'Laravel Features Inc.',
            'product'=>'Primary Subscription'
        ]);
    }
}

