<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    

        
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                font-size: 1rem;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
      
   <div id="taglist">
       
   </div>
      
    <div id="modal">
        
    </div>  
       
        
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
      <script src="{{ asset('js/app.js') }}"></script>
      <script type="text/javascript">
          $(function(){
                  $.ajaxSetup({
                   headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
               $.get('{{route("tags.index")}}',function(data){
              $("#taglist").empty().append(data);
          }); 
              $("#taglist").on('click','#btnAddTag',function(){
                  $.get('{{route("tags.create")}}',function(data){
                      $("#modal").empty().append(data);
                      $("#addtags").modal("show");
                  });
                  event.preventDefault(); 
              });
              
              $('#modal').on('submit','#frmaddtag',function(e){
                   e.preventDefault();
                   var frmData=$(this).serialize();
                    $.ajax({
                     url:'{{route("tags.store")}}',
                     type:'POST',
                      data:frmData,
                      success:function(data){
                          $("#taglist").empty().append(data);
                          $('#addtags').modal('hide'); 
                      },
                      error:function(error){
                          var error=error.responseJSON;
                          $("#modal #erros").empty();
                          error.errors.name.forEach(function(element,index){
                           $("#modal #errors").append('<li class="alert alert-danger">'+element+'</li>');
                          });
                          
                      },
                      
                  });
                  
              });
              
              $("#taglist").on('click','#btn-func',function(){
                  var id=$(this).attr('data-task');
                  $.get('{{URL::to("tags/edit")}}/'+id,function(data){
                      $('#modal').empty().append(data);
                      $('#edittag').modal('show');
                  });
                   event.preventDefault() 
              });
             
              $("#modal").on("submit","#frmaedittag",function(e){
                e.preventDefault();
                  var frmData=$(this).serialize();
                  $.ajax({
                      url:'{{URL::to("tags/update")}}',
                      type:'POST',
                      data:frmData,
                      success:function(data){
                      $('#taglist').empty().append(data);
                      $('#edittag').modal('hide');
                  },
                    error:function(error){
                        var error=error.responseJSON;
                          $("#modal #erros").empty();
                         error.errors.name.forEach(function(element,index){
                           $("#modal #errors").append('<li class="alert alert-danger">'+element+'</li>');
                          });
                    },     
                  });
              });
              
              $("#modal").on("click","#tagdelete",function(){
                  var id=$(this).attr('data-task');
                  $.get('{{URL::to("tags/destroy")}}/'+id,function(data){
                     $('#taglist').empty().append(data);
                      $('#edittag').modal('hide');
                  });
                   event.preventDefault();
              });
              
              
          });
                  
        
        </script>
        
    </body>
</html>