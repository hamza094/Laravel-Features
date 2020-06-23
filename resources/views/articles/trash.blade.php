@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header text-center bg-secondary"><h5>Trashed Articles</h5></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Deleted_at</th>
                        <th>Revert</th>
                        <th>Delete</th>
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
                        <td>{{$art->deleted_at->diffForHumans()}}</td>
                        <td><a href="{{route('articles.revert',['articles'=>$art->id])}}" class="btn btn-sm btn-success">Revert</a></td>
                        <td><a href="{{route('articles.destroy',['id'=>$art->id])}}" class="btn btn-sm btn-danger">Delete</a></td>
                       
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection