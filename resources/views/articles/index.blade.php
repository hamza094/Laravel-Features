@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header text-center bg-secondary"><h5>View All Articles</h5></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Craeted_at</th>
                        <th>Update</th>
                        <th>Trash</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($article as $art)
                    <tr>
                        <td>
                            <img src="{{$art->img}}" alt="" width="100px" height="80px">
                        </td>
                        <td>{{$art->title}}</td>
                        <td>{{str_limit($art->content,20)}}</td>
                        <td>{{$art->created_at->diffForHumans()}}</td>
                        <td><a href="{{route('articles.edit',['articles'=>$art->id])}}" class="btn btn-sm btn-primary">Edit</a></td>
                        <td><a href="{{route('articles.trash',['id'=>$art->id])}}" class="btn btn-sm btn-warning">Trash</a></td>
                       
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection