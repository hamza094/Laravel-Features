@extends('layouts.app')

@section('content')

<div class="profile">
<h3 class="text-center">User's Profile</h3>
<div class="row">
    <div class="col-md-6">
        <img src="{{$user->img}}" alt="" width="150px" height="130px" class="rounded-circle">
        <p class="set"><span>
        <form action="{{route('users.destroy',['users'=>$user->id])}}" method="post">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button class="btn btn-danger btn-sm">Delete Profile</button>
        </form>
        </span>
        </p>
    </div>
    <div class="col-md-6 text">
        <p class="lead">Name:<strong>{{$user->name}}</strong></p>
    <p class="lead">Email:<i>{{$user->email}}</i></p>
    </div>
</div>
</div>

@endsection


