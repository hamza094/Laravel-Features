@include('includes.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <div class="jumbotron">
        <h4 class="display-4 text-center">In Your Shopping Cart: {{Cart::content()->count()}} items</h4>
         <hr>
         <div class="row">
               <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach(Cart::content() as $pdt)
                    <tr>
                       <td><img src="{{$pdt->model->image}}" alt="" width="120px" height="90px"></td>
                       <td>{{$pdt->name}}</td>
                       <td>${{$pdt->price}}</td>
                       <td> 
                <a href="{{route('cart.reduce',['id'=>$pdt->rowId,'qty'=>$pdt->qty])}}" class="btn btn-secondary">-</a>
                <input type="text" value="{{$pdt->qty}}" name="qty" title="Qty" class="input-incr">
                <form  action="{{route('cart.incr',['id'=>$pdt->rowId,'qty'=>$pdt->qty])}}" class="plus">
                {{csrf_field()}}
                <button  class="btn btn-secondary" type="submit"> +</button>
                <input type="hidden" value="{{$pdt->id}}" name="pdt_id">
                  </form>
                </td>
                       <td>${{$pdt->total}}</td>
                        <td><a href="{{route('cart.delete',['id'=>$pdt->rowId])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>    
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
         </div>
     </div>
     <h2 class="text-center">Cart Total:${{number_format(Cart::total())}}</h2>
     <div class="text-center">
 <a href="{{route('checkout')}}" class="btn btn-primary">Proceed to checkout</a>
</div>



@include('includes.footer')