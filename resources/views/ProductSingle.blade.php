@include('includes.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container" id="app">
    <div class="jumbotron">
         <h4 class="display-4 text-center">{{$product->name}}</h4>
        <span class="pull-right"><small><b>{{$product->created_at->diffForHumans()}}</b></small></span>
         <hr>
         <div class="row">
             <div class="col-md-4">
                  <img src="{{$product->image}}" alt="" width="100%">
                  <br>
                  <p class="text-center" style="margin-top:10px">Price: <b>${{$product->price}}</b></p>
                  
                  <p class="text-center" style="margin-top:10px">Items In Stock: 
                   @if($product->item_qty<=0)
                   <b>0</b>
                   @else
                  <b>
                  {{$product->item_qty}}
                  </b>
                  @endif
                  </p>
                  @if($product->item_qty!=0)
                 <form action="{{route('add.cart')}}" method="post">
                      {{csrf_field()}}
                      <p>Select Quantity:</p>
                 <div class="handle-counter" id="handleCounter">
                <a href="#" class="counter-minus btn btn-primary">-</a>
                <input type="text" value="1" name="qty" title="Qty">
                     <a href="#" class="counter-plus btn btn-primary">+</a>
                </div>
                <input type="hidden" name="pdt_id" value="{{$product->id}}">
                <br>
                <button class="btn btn-primary">Add Into Cart</button>
                </form>
                @else
                <h3>Out of stock</h3>
                @endif
                 <div class="item-wraper">
                     <star-rating :increment="0.5" :read-only="true" :rating="{{number_format($product->reviews->avg('rating'))}}"></star-rating>
                     <br>
                     @if($product->is_reviewed_by_auth_user())
                     <p></p>
                     @else
                 <a href="" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#reviewModal">Write a Review</a>
                    @endif
                     @include('review_form')
                  </div>
                  <br>
                 </div>
             <div class="col-md-8">
                 <h3><b>Description:</b></h3>
                 <p class="lead">{{$product->description}}</p>
                 <hr>
                 <h3 class="text-center">Reviews</h3>
                 @foreach($product->reviews as $review)
                 <div class="row no-gutter">
                     <div class="col-md-6">
                         <img class="img-circle pull-left" src="{{$review->user->img}}" alt="" height="70px" width="80px" class="img-circle">
                         <div class="pull-left">
                         <span>{{$review->user->name}}</span>
                         <p><star-rating :star-size="20" inactive-color="#e1bad9" active-color="#cc1166" :read-only="true" :show-rating="false" :rating="{{$review->rating}}"></star-rating></p>   
                         <span><small><b>{{$product->created_at->diffForHumans()}}</b></small></span>
                         </div>                        
                     </div>
                     <div class="col-md-6">
                         <h4 class="text-center"><b>{{$review->headline}}</b><span></span></h4>
                         <p>{{$review->description}}</p>
                    @if($review->user->id==Auth::user()->id)
                    <form action="{{route('review.destroy',['review'=>$review->id])}}" method="post">
                     {{ csrf_field() }}
                     {{method_field('DELETE')}}
                    <button class="btn btn-sm btn-danger pull-right"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                        @endif
                 </div>
                 </div>
                 <hr>
                 
                 @endforeach
             </div>
         </div>
     </div>
    </div>
 @include('includes.footer')