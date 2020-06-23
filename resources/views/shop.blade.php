@include('includes.header')

<div class="container-fluid" id="app">
  <div class="row">
     <div class="col-md-3 pdt-cat">
         <h3 class="text-center">Product Categories</h3>
         <ul class="list-group">
            @foreach($category as $cat)
             <li class="list-group-item"><a href="{{route('product.category',['id'=>$cat->id])}}">{{$cat->title}}</a><span class="pull-right badge">{{$cat->products->count()}}</span></li>
             @endforeach
         </ul>
     </div>
      <div class="col-md-9">
    <br><br>
   <h2 class="text-center"><b>Search For Product</b></h2>
   <form action="{{route('product.search')}}" method="GET" >
       <div class="form-group">
           <input type="text" class="form-control" name="query">
       </div>
   </form>
   <hr>
    <div class="row">
            @foreach($product as $pdt)
             <div class="col-md-4" style="margin-top:15px;">
            <div class="card text-center" style="width: 18rem;">
          <img class="card-img-top" src="{{$pdt->image}}" alt="Card image cap">
            <div class="card-body">
         <h4>{{$pdt->name}}</h4>
             <p class="card-text">{{str_limit($pdt->description,180)}}</p>
                <p><a href="{{route('products.show',['products'=>$pdt->id])}}" class="btn btn-primary">View Detail</a></p>
                 </div>
  <div class="card-footer">
        <span class="pull-left"><star-rating :star-size="20" :read-only="true" :increment="0.5" :rating="{{number_format($pdt->reviews->avg('rating'))}}"></star-rating></span>
      <emp><span class="pull-right">Price:${{$pdt->price}}</span></emp>
        <br>
        
  </div>
</div>
        </div>
           @endforeach
    </div>
            </div>
           </div>
</div>
 


@include('includes.footer')
