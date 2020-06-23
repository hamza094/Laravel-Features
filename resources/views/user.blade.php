@include('includes.header')
<div class="container">
    <div class="jumbotron">
    <div class="text-center">
    <img src="{{$user->img}}" class="img-circle" alt="" width="100px" height="90px">
        </div>
  <h6 class="display-4 text-center">{{$user->name}}</h6>
  <p class="text-center">Mailling Address:<emp>{{$user->email}}</emp></p>
  <p class="text-center"><emp>Posts Created by this User:</emp></p>
  <hr>
    <div class="row">
            @foreach($user->articles as $art)
             <div class="col-md-4">
            <div class="card text-center" style="width: 18rem;">
          <img class="card-img-top" src="{{$art->img}}" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title"><b>{{$art->title}}</b></h4>
             <p class="card-text">{{str_limit($art->content,100)}}</p>
              <a href="{{route('articles.slug',['slug'=>$art->slug])}}" class="btn btn-primary">View Full Post</a>
  </div>
  <div class="card-footer">
        <span class="pull-left">{{$art->created_at->diffForHumans()}} </span>
        <span class="pull-right"><a href="{{route('article.category',['id'=>$art->category->id])}}">{{$art->category->title}}</a></span>
  </div>
</div>
        </div>
           @endforeach
    </div>
        
</div>
</div>
@include('includes.footer')