<html>
    <head>
        <title>
            Purchase successfully
        </title>
    </head>
    <body>
       <img src="{{asset('img/logo.jpg')}}" alt="">
        <h1 class="text-center">Purchase Successfull!</h1>
            
            <table width="600" style="border:1px solid #333">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach(Cart::content() as $pdt)
                    <tr>
                       <td><img src="{{$pdt->model->image}}" alt="" width="120px" height="90px"></td>
                       <td>{{$pdt->name}}</td>
                       <td>${{$pdt->price}}</td>
                       <td>{{$pdt->qty}} </td>
                       <td>${{$pdt->total}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
       
        
        <p class="text-center">Thanks for shopping from us we deiliver your products as soon as posible!We hope you will again <a href="https://laravelfeatures.herokuapp.com/shop">visit us</a> Thanks. </p>
    </body>
</html>