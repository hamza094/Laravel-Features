@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header text-center bg-secondary"><h5>Edit Article:<b>{{$article->title}}</b></h5></div>
    <div class="card-body">
      <form action="{{route('articles.update',['articles'=>$article->id])}}" method="post">
      {{ csrf_field() }}
      {{method_field('PUT')}}
       <div class="form-group">
           <label for="title">Title:</label>
           <input type="text" class="form-control" name="title" value="{{$article->title}}">
       </div>
          <div class="form-group">
           <label for="img">Image:</label>
           <input type="text" class="form-control" name="img" value="{{$article->img}}">
       </div>
         <div class="form-group">
                           <label for="Category">Pick A Desired Category:</label>
                           <select name="category_id" id="category" class="form-control">
                           @foreach($category as $cats)
                           <option value="{{$cats->id}}"
                            @if($article->category->id==$cats->id)
                            selected
                            @endif
                               >{{$cats->title}}</option>
                           @endforeach
                           </select>
                       </div>
                       <div class="form-group">
                           <label for="tags">Select Tags:</label>
                           @foreach($tag as $t)
                           <div class="checkbox">
                               <label><input type="checkbox" name="tags[]" value="{{$t->id}}"
                               @foreach($article->tags as $ta)
                               @if($t->id==$ta->id)
                               checked
                               @endif
                               @endforeach
                               > {{$t->name}}
                               </label>
                           </div>
                           @endforeach
                       </div>
      
       <div class="form-group">
           <label for="content">Content:</label>
           <textarea name="content" id="" cols="30" rows="10" class="form-control">{{$article->content}}</textarea>
       </div>
       <div class="form-group">
       <button type="submit" class="btn btn-block btn-secondary">Update Post</button>
          </div>
        </form>
    </div>
</div>

@endsection