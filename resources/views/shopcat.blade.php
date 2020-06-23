@include('includes.header')
<div class="container">
    <div class="jumbotron">
  <h6 class="display-4 text-center">{{$pcat->title}}</h6>
  <p class="text-center"><emp>Product Related to this Category:</emp></p>
  <hr>
   @if($pcat->products->count()>0)
    <div class="row">
           
            @foreach($pcat->products as $pdt)
             <div class="col-md-4">
            <div class="card text-center" style="width: 18rem;">
          <img class="card-img-top" src="{{$pdt->image}}" alt="Card image cap">
            <div class="card-body">
         <h4 class="card-title">{{$pdt->name}}</h4>
             <p class="card-text">{{str_limit($pdt->description,100)}}</p>
              <a href="{{route('products.show',['products'=>$pdt->id])}}" class="btn btn-primary">View Detail</a>
  </div>
  <div class="card-footer">
        <span class="pull-left">{{$pdt->created_at->diffForHumans()}} </span>
        <span class="pull-right"><a href="">{{$pdt->category->title}}</a></span>
  </div>
</div>
        </div>
           @endforeach
       
    </div>
           @else       
          <h2 class="text-center">Opps!No Product Found To Related Category</h2>        
           @endif
        
</div>
</div>
@include('includes.footer')