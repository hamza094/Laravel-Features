<?php

namespace App\Http\Controllers;

use App\PorductReview;
use Illuminate\Http\Request;
use App\Product;
use Auth;
use Session;
class PorductReviewController extends Controller
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
    public function store(Request $request)
    {
        auth()->user()->review()->create($request->all());
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PorductReview  $porductReview
     * @return \Illuminate\Http\Response
     */
    public function show(PorductReview $porductReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PorductReview  $porductReview
     * @return \Illuminate\Http\Response
     */
    public function edit(PorductReview $porductReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PorductReview  $porductReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PorductReview $porductReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PorductReview  $porductReview
     * @return \Illuminate\Http\Response
     */
    public function destroy($porductReview)
    {
          $review=PorductReview::find($porductReview);
        $review->delete();
        Session::flash('info','Review have been Deleted');
        return redirect()->back();
    }
}
