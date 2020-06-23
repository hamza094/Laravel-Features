@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header text-center bg-secondary"><h5>Edit Product:<b>{{$product->name}}</b></h5></div>
    <div class="card-body">
      <form action="{{route('products.update',['products'=>$product->id])}}" method="post">
      {{ csrf_field() }}
      {{method_field('PUT')}}
       <div class="form-group">
           <label for="name">Name:</label>
           <input type="text" class="form-control" name="name" value="{{$product->name}}">
       </div>
          <div class="form-group">
           <label for="img">Image:</label>
           <input type="text" class="form-control" name="image" value="{{$product->image}}">
       </div>
         <div class="form-group">
           <label for="price">Price:</label>
           <input type="text" class="form-control" name="price" value="{{$product->price}}">
       </div>
         <div class="form-group">
           <label for="item_qty">Item Quantity:</label>
           <input type="text" class="form-control" name="item_qty" value="{{$product->item_qty}}">
       </div>
         <div class="form-group">
                           <label for="Category">Pick A Desired Category:</label>
                           <select name="category_id" id="category" class="form-control">
                           @foreach($category as $cats)
                           <option value="{{$cats->id}}"
                            @if($product->category->id==$cats->id)
                            selected
                            @endif
                               >{{$cats->title}}</option>
                           @endforeach
                           </select>
                       </div>
              <div class="form-group">
           <label for="content">Description:</label>
           <textarea name="description" id="" cols="30" rows="10" class="form-control">{{$product->description}}</textarea>
       </div>
       <div class="form-group">
       <button type="submit" class="btn btn-block btn-secondary">Update Product</button>
          </div>
        </form>
    </div>
</div>

@endsection