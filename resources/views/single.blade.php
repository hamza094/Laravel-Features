@include('includes.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container" id="app">
    <div class="jumbotron">
      @if(Auth::id())
       @if($article->is_subscribed_by_auth_user())
         <a href="{{route('article.unsubscribe',['id'=>$article->id])}}" class="badge badge-success pull-right subcribed">Subcribed</a>
        @else
         <a href="{{route('article.subscribe',['id'=>$article->id])}}" class="badge badge-primary pull-right" data-toggle="tooltip"  title="Notified with email about article activivty">Subcribe</a>
        @endif
        @endif
        <h3 class="display-4 text-center">{{$article->title}}</h3>
  <img src="{{$article->img}}" alt="" width="100%">
  <br><br>
  <p class="lead">{{$article->content}}</p>
        <p><small><span>Written by: <a href="{{route('article.user',['id'=>$article->user->id])}}">hamza ikram</a></span><span class="pull-right">Published at: <b>{{$article->created_at->diffForHumans()}}</b></span></small></p>
        <p><small><b>Tags:</b>
        @foreach($article->tags as $tag)
        <i>{{$tag->name}}. </i>
        @endforeach
            <span class="pull-right"><b>Category</b>:<a href="{{route('article.category',['id'=>$article->category->id])}}">{{$article->category->title}}</a></span></small></p>
            <hr>
          <h4 class="display-4 text-center">Comments</h4>
          <br>
          @foreach($article->comments as $comment) 
          <reply :attributes="{{$comment}}" inline-template v-cloak>    
        <div class="row">
            <div class="col-md-2">
            <img src="{{$comment->user->img}}" alt="" width="90px" height="80px" class="img-circle">
            <br>
            <span>By:{{$comment->user->name}}<strong></strong></span>
            <br>
            <span>{{$comment->created_at->diffforHumans()}}</span>
            <br>
            </div>
            <div class="col-md-10">
              @if(Auth::id())
            <like :comment="{{$comment}}"></like>
             @else
                <span class="pull-right badge badge-success"><span class="glyphicon glyphicon-heart"></span> {{$comment->likes->count()}}</span> 
              @endif              
               <div v-if="editing">
                  <div class="form-group">
               <textarea name="" id="" cols="30" rows="10" class="form-control" v-model="content"></textarea>
                 </div>
               <button class="btn btn-sm btn-secondary" @click="update">Update</button>
               <button class="btn btn-sm btn-primary" @click="editing = false">Cancel</button>
               </div>
               <div v-else>
                <p v-text="content"><small><i></i></small></p>
                     @if(Auth::user())
                   @if($comment->user->id==Auth::user()->id)
                   <p class="pull-left"><button class="btn btn-warning btn-sm" @click="editing=true">Edit</button> 
                 <button class="btn btn-sm btn-danger" @click="destroy">Delete</button></p>
                 @endif
                 @endif
                </div>
            </div>
        </div>
        </reply>
        <hr>
        @endforeach
        <br><br>
        <h2 class="text-center">Share your thought's</h2>
        @if(Auth::user())
        <form action="{{route('article.comment',['id'=>$article->id])}}" method="post">
           {{csrf_field()}}
            <label for="Comment">Comment:</label>
            <div class="form-group">
                <textarea name="content" id="" cols="30" rows="10" class="form-control" required>{{old('content')}}</textarea>
            </div>
            <button type="submit" class="btn btn-secondary pull-right">Submit</button>
        </form>
        @else
        <p class="text-center">To Subscribe Comment or Like!<a href="/login" class=""> Please Login Here</a></p>
        @endif
</div>
     <hr>
     <br>
    <h3 class="text-center"><b>Similar Articles</b></h3>
    <br>
     <div class="row">
     @foreach($related_articles as $art)
             <div class="col-md-4">
            <div class="card text-center" style="width: 18rem;">
          <img class="card-img-top" src="{{$art->img}}" alt="Card image cap">
            <div class="card-body">
         <h4>{{$art->title}}</h4>
             <p class="card-text">{{str_limit($art->content,150)}}</p>
                <p><a href="{{route('articles.slug',['slug'=>$art->slug])}}" class="btn btn-primary">Visit Article</a></p>
                 </div>
</div>
        </div>
        
             @endforeach
          </div>


</div>
      
   
@include('includes.footer')