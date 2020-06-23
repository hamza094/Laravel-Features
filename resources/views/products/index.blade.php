@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header text-center bg-secondary"><h5>View All Products</h5></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created_at</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($product as $pro)
                    <tr>
                        <td>
                            <img src="{{$pro->image}}" alt="" width="100px" height="80px">
                        </td>
                        <td>{{$pro->name}}</td>
                        <td>{{str_limit($pro->description,20)}}</td>
                        <td>{{$pro->created_at->diffForHumans()}}</td>
                        <td><a href="{{route('products.edit',['products'=>$pro->id])}}" class="btn btn-sm btn-warning">Edit</a></td>
                        <td>
                        <form action="{{route('products.destroy',['products'=>$pro->id])}}" method="post">
                         {{ csrf_field() }}
                       {{method_field('DELETE')}}
                        <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        </td>    
                        
                        
                       
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection