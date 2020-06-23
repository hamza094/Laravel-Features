@include('includes.header')
<div class="container">
    <div class="jumbotron">
  <h6 class="display-4 text-center">{{$scat->title}}</h6>
  <p class="text-center"><emp>Articles Related to this Category:</emp></p>
  <hr>
   @if($scat->articles->count()>0)
    <div class="row">
           
            @foreach($scat->articles as $art)
             <div class="col-md-4">
            <div class="card text-center" style="width: 18rem;">
          <img class="card-img-top" src="{{$art->img}}" alt="Card image cap">
            <div class="card-body">
         <h4 class="card-title">{{$art->title}}</h4>
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
           @else       
          <h2 class="text-center">Opps!No Article Found To Related Category</h2>        
           @endif
        
</div>
</div>
@include('includes.footer')