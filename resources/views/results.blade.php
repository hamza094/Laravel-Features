@include('includes.header')
<div class="container" id="app">
    <div class="jumbotron">
  <h2 class="text-center">Search Result for: {{$query}}</h2>
   <hr>
    <div class="row">
            @if($product->count()>0)
            @foreach($product as $pdt)
             <div class="col-md-4">
            <div class="card text-center" style="width: 18rem;">
          <img class="card-img-top" src="{{$pdt->image}}" alt="Card image cap">
            <div class="card-body">
                <h4><b>{{$pdt->name}}</b></h4>
             <p class="card-text">{{str_limit($pdt->description,150)}}</p>
                <p><a href="{{route('products.show',['products'=>$pdt->id])}}" class="btn btn-primary">View Detail</a></p>
                 </div>
  <div class="card-footer">
        <emp><span class="pull-right">Price:${{$pdt->price}}</span></emp>
        <br>
        
  </div>
</div>
        </div>
           @endforeach
           @else
           <h3 class="text-center">Sorry no product found of related search</h3>
           @endif
    </div>
@include('includes.footer')