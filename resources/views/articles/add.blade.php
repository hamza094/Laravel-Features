@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header text-center bg-secondary"><h5>Add New Article</h5></div>
    <div class="card-body">
      <form action="{{route('articles.store')}}" method="post">
      {{ csrf_field() }}
       <div class="form-group">
           <label for="title">Title:</label>
           <input type="text" class="form-control" name="title" value="{{old('title')}}">
       </div>
          <div class="form-group">
           <label for="img">Image:</label>
           <input type="text" class="form-control" name="img" value="{{old('title')}}">
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
                           <label for="tags">Select Tags:</label>
                           @foreach($tag as $t)
                           <div class="checkbox">
                               <label><input type="checkbox" name="tags[]" value="{{$t->id}}"> {{$t->name}}</label>
                           </div>
                           @endforeach
                       </div>
      
       <div class="form-group">
           <label for="content">Content:</label>
           <textarea name="content" id="" cols="30" rows="10" class="form-control">{{old('title')}}</textarea>
       </div>
       <div class="form-group">
       <button type="submit" class="btn btn-block btn-secondary">Post</button>
          </div>
        </form>
    </div>
</div>

@endsection