@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header text-center bg-secondary"><h5>Edit Profile:<b>{{$user->name}}</b></h5></div>
    <div class="card-body">
      <form action="{{route('users.update',['users'=>$user->id])}}" method="post">
      {{ csrf_field() }}
      {{method_field('PUT')}}
       <div class="form-group">
           <label for="title">Name:</label>
           <input type="text" class="form-control" name="name" value="{{$user->name}}">
       </div>
          <div class="form-group">
           <label for="profile">Profile Pic:</label>
           <input type="text" class="form-control" name="img" value="{{$user->img}}">
       </div>
          <div class="form-group">
           <label for="img">Email:</label>
           <input type="email" class="form-control" name="email" value="{{$user->email}}">
       </div>
       <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password">
            </div>
        <div class="form-group">
       <button type="submit" class="btn btn-block btn-secondary">Update Profile</button>
          </div>
        </form>
    </div>
</div>

@endsection