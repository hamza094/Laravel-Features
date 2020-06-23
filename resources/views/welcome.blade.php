@include('includes.header')

<!-- Modal -->

<div class="modal fade in" id="subscribeModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Subscribe to Our mailing List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/subscribe" method="post">
      {{csrf_field()}}
      <div class="modal-body">
      <label for="mailing">Mailing Address</label>
      <div class="form-group">
      <input type="email" name="email" class="form-control" required>  
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Subscribe</button>
      </div>
        </form>
    </div>
  </div>
</div>
<div class="container">
   <br><br>
   <h2 class="text-center" style="margin-bottom:20px;"><b>Read Our Latest Blogs</b></h2>
    <div class="row">
            @foreach($article as $art)
             <div class="col-md-4" style="margin-bottom:5px;">
            <div class="card text-center" style="width: 18rem;">
          <img class="card-img-top" src="{{$art->img}}" alt="Card image cap">
            <div class="card-body">
         <h5 class="card-title main-title">{{$art->title}}</h5>
             <p class="card-text">{{str_limit($art->content,200)}}</p>
                <p><a href="{{route('articles.slug',['slug'=>$art->slug])}}" class="btn btn-primary">View Full Post</a></p>
                <p class="label label-info cmnt-label pull-right">Comments:{{$art->comments->count()}}</p>
  </div>
  <div class="card-footer">
        <span class="pull-left">{{$art->created_at->diffForHumans()}} </span>
        <span class="pull-right"><a href="{{route('article.category',['id'=>$art->category->id])}}">{{$art->category->title}}</a></span>
        <br>
        
  </div>
</div>
        </div>
           @endforeach
    </div>
    <div style="position:absolute; left:50%;">
     {{ $article->links() }}
    </div>
    
</div>
 


@include('includes.footer')

