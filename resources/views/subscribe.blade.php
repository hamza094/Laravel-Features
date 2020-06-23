@include('includes.header')


<div class="container text-center">
<h2 class="text-center">Subscibe the plan which best suites you!</h2>
<hr>
           @if(Auth::user()->subscribed('primary') && Auth::user()->subscription('primary')->onTrial())
        <div class="alert alert-info">
            You are enjoying your 14 days free trial!
        </div>
  @endif
        @if(Auth::user()->subscribed('primary') && Auth::user()->subscription('primary')->onGracePeriod())
        <div class="alert alert-danger">
            You Subscription will not renew,You have canceled but you can still enjoy grace period!
        </div>
  @endif
   @if(Auth::user()->subscribed('primary'))
       <p>Status:<span class="badge badge-success">Subscribed</span></p>
       <a href="https://www.youtube.com/watch?v=Q-MEHEllHTA" target="_blank">Get Access to subscription link</a>
      @else
        <p>Status:<span class="badge badge-primary"> Not Subscribed</span></p>
        @endif
<br><br>    
<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Monthly</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Yearly</a></li>
    </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane  active" id="home">
       <br>
        <h3>$10 per Month</h3>
        @if(Auth::user()->subscribedToPlan('plan_E85LLvj3QgSAf0','primary'))
        <p class="lead">You Already Subscribed this plan!</p>
         @if(!Auth::user()->subscription('primary')->onGracePeriod())
        <a href="/pay/plan_E85O92CZtaiDy6" class="btn btn-secondary">Upgrade to Annual</a>
        <a href="/cancel" class="btn btn-danger">Cancel Subscription</a>
        @endif
        @elseif(Auth::user()->subscribedToPlan('plan_E85O92CZtaiDy6','primary'))
           <p class="lead">Already Subscribed Annual Plan! Downgrade Annual to Monthly Plan</p>
           @else
         Subscribe:
             <form action="/pay/plan_E85LLvj3QgSAf0" method="POST">
          {{csrf_field()}}
           <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_luEwCAtmk9BJHxd7ivRA5kDy"
                data-amount="1000"
                data-name="Laravel Features"
                data-description="Subscription charge"
                data-image="https://i.ibb.co/ChjhPhX/logo.jpg"
                data-locale="auto"
                data-label="Subscribe Monthly"
                data-panel-label="Subscribe">
              
               
  </script>
</form>
        @endif
    </div>
    <div role="tabpanel" class="tab-pane fade" id="profile"><br>
        <h3>$100 per Year</h3>
               
                @if(Auth::user()->subscribedToPlan('plan_E85O92CZtaiDy6','primary'))
         <p class="lead">You Already Subscribed this plan!</p>
         @if(!Auth::user()->subscription('primary')->onGracePeriod())
         <a href="/pay/plan_E85LLvj3QgSAf0" class="btn btn-secondary">Downgrade to Monthly</a>
         <a href="/cancel" class="btn btn-danger">Cancel Subscription</a>
            @endif
             @elseif(Auth::user()->subscribedToPlan('plan_E85LLvj3QgSAf0','primary'))
           <p class="lead">Already Subscribed Monthly Plan! Upgrade Monthly to Annual Plan</p>
           @else
    Subscribe:                 
                  <form action="/pay/plan_E85O92CZtaiDy6" method="POST">
          {{csrf_field()}}
           <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_luEwCAtmk9BJHxd7ivRA5kDy"
                data-amount="10000"
                data-name="Laravel Features"
                data-description="Subscription charge"
                data-image="https://i.ibb.co/ChjhPhX/logo.jpg"
                data-locale="auto"
                data-label="Subscribe Annually"
                data-panel-label="Subscribe">
                
               
  </script>
</form>
       @endif
        
 </div>
      </div>
    </div>
    <br>
     @if(Auth::user()->subscribed('primary'))
    <p class="lead">Your Invoices:</p>
       <table class="table">
           <thead>
               <tr>
               <td>Invoice Date</td>
               <td>Total</td>
               <td>Download</td>
               </tr>
               
           </thead>
           <tbody>
               @foreach(Auth::user()->invoices() as $invoice)
               <tr>
               <td>{{$invoice->date()->toFormattedDateString()}}</td>
               <td>{{$invoice->total()}}</td>
               <td><a href="/user/invoice/{{ $invoice->id }}">Download</a></td>
               </tr>
                @endforeach
           </tbody>
       </table>
    @endif
</div>


@include('includes.footer')
