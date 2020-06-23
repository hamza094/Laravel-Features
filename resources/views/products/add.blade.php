@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header text-center bg-secondary"><h5>Add New Product</h5></div>
    <div class="card-body">
      <form action="{{route('products.store')}}" method="post">
      {{ csrf_field() }}
       <div class="form-group">
           <label for="title">Name:</label>
           <input type="text" class="form-control" name="name" value="{{old('name')}}">
       </div>
          <div class="form-group">
           <label for="img">Image:</label>
           <input type="text" class="form-control" name="image" value="{{old('image')}}">
       </div>
           <div class="form-group">
           <label for="price">Price:</label>
           <input type="text" class="form-control" name="price" value="{{old('price')}}">
       </div>
           <div class="form-group">
           <label for="item_qty">Item Quantity:</label>
           <input type="text" class="form-control" name="item_qty" value="{{old('item_qty')}}">
       </div>
         <div class="form-group">
                           <label for="Category">Pick A Desired Category:</label>
                           <select name="category_id" id="category" class="form-control">
                           @foreach($category as $cats)
                           <option value="{{$cats->id}}">{{$cats->title}}</option>
                           @endforeach
                           </select>
                       </div>
                            
       <div class="form-group">
           <label for="content">Description:</label>
           <textarea name="description" id="" cols="30" rows="10" class="form-control">{{old('description')}}</textarea>
       </div>
       <div class="form-group">
       <button type="submit" class="btn btn-block btn-secondary">Add</button>
          </div>
        </form>
    </div>
</div>

@endsection