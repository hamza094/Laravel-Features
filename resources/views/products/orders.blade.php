@extends('layouts.app') @section('content')


<div class="card">
    <div class="card-header text-center bg-secondary">
        <h5>View All Orders</h5>
    </div>
    <div class="card-body">
        @foreach($orders as $order)
        <div class="bg-primary order text-center">
        <h4 class="text-center">Order No: {{$order->id}}</h4>
        <h3 class="text-center">Ordered By: <b>{{$order->user->name}}</b></h3>
        <h4 class="text-center">Total Amount: <b>${{$order->total}}</b></h4>
        </div>
        @if($order->status==0)
        <p class="pull-right">
            <span class="badge badge-danger">Not Delivered</span>
            <a href="{{route('order.deliver',['id'=>$order->id])}}"><i class="fa fa-check-circle-o" aria-hidden="true"></i></a>
        </p>
        @else
        <p class="pull-right">
            <span class="badge badge-success">Delivered</span>
        </p>
        @endif
        <h4>Cart Info:</h4>
        <table class="table table-striped table-bordered">
            <tr class="thead-dark">
               <th>Item Pic</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>

            @foreach($order->orderItems as $item)
            <tr>
               <td><img src="{{$item->image}}" alt="" width="90px" height="60px"></td>
                <td>{{$item->name}}</td>
                <td>{{$item->pivot->qty}}</td>
                <td>${{$item->pivot->total}}</td>
            </tr>
            @endforeach

        </table>
        <br>
        <h4>Shipping Info:</h4>
        <table class="table">
            <tr class="thead-dark">
                <th>Mailing Adress</th>
                <th>Country</th>
                <th>Zip Code</th>
                <th>City</th>
                <th>Address</th>
            </tr>


            <tr class="bg-primary table-ship">
                <td>{{$order->user->email}}</td>
                <td>{{$order->country}}</td>
                <td>{{$order->zip}}</td>
                <td>{{$order->city}}</td>
                <td>{{$order->address}}</td>
                </tr>
    </table>
      <br>
       <hr>
        @endforeach
      </div>
</div>


@endsection