@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header text-center bg-secondary"><h5>View All Users</h5></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>Usename</th>
                        <th>User Email</th>
                        <th>Created_at</th>
                        <th>User Role</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($users as $user)
                    <tr>
                        <td>
                            <img class="rounded-circle" src="{{$user->img}}" alt="" width="87px" height="77px">
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        @if($user->admin==1)
                        <td><a href="{{route('admin.not',['id'=>$user->id])}}" class="btn btn-sm btn-success">Non Admin</a></td>
                        @else
                        <td><a href="{{route('admin.make',['id'=>$user->id])}}" class="btn btn-sm btn-secondary">Make Admin</a></td>
                        @endif
                        <td>
                    <form action="{{route('users.destroy',['users'=>$user->id])}}" method="post">
                        {{csrf_field()}}
                       {{method_field('DELETE')}}
                        <button class="btn btn-danger btn-sm">Delete</button>
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