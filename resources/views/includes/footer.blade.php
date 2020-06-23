</body>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
      <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{asset('js/iziToast.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/handleCounter.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/script.js') }}"></script>
              <script>
        @if(Session::has('success'))
        iziToast.success({
            message:"{{Session::get('success')}}"
        });        
        @endif
        
          @if(Session::has('info'))
          iziToast.info({
            message:"{{Session::get('info')}}"
        });      
        @endif
                  
                  
    </script>
      </html>
      