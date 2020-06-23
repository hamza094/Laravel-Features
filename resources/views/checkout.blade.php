@include('includes.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">

     <h2 class="text-center">Your Cart Total:${{number_format(Cart::total())}}</h2>
     <hr>
     <div class="text-center">
     <form action="{{route('cart.checkout')}}" method="POST">
          {{csrf_field()}}
           <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_luEwCAtmk9BJHxd7ivRA5kDy"
                data-amount="{{Cart::total()*100}}"
                data-name="Laravel Features"
                data-description="Shopping cart charge"
                data-image="https://i.ibb.co/ChjhPhX/logo.jpg"
                data-locale="auto"
                data-zip-code="true"
                data-billingAddress="false"
                 data-shippingAddress="true">
               
  </script>
</form>
   <a href="{{route('order.cancel')}}" class="btn btn-danger btn-lg">Cancel Order</a>
    </div>
</div>



@include('includes.footer')