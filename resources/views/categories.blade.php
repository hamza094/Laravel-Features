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
      
       <div id="catlist">
           
       </div>
       <div id="modals">
           
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
               
               $.get('{{route("categories.index")}}',function(data){
                  $('#catlist').empty().append(data);
                 
              });
               $("#catlist").on('click',"#btnAddTask",function(){
                   
                   
                    $.get('{{route("categories.create")}}',function(data){
                     $('#modals').empty().append(data);
                    $('#addcategory').modal('show');     
              }); 
                     event.preventDefault() 
               });
               
                $("#catlist").on('click',"#btnfunc",function(){
                    var id=$(this).attr('data-task');
                    $.get('{{URL::to("categories/edit")}}/'+id,function(data){
                     $('#modals').empty().append(data);
                    $('#editcategory').modal('show');     
              }); 
                     event.preventDefault() 
               });
               
               
               
               $('#modals').on('submit','#frmaddcat',function(e){
                   e.preventDefault();
                   var frmData=$(this).serialize();
                   //$.post('{{route("categories.store")}}',frmData,function(data,xhrStatus,xhr){
                     //  $('#catlist').empty().append(data);
                       //$('#addcategory').modal('hide'); 
                   //});
                   $.ajax({
                       url:'{{route("categories.store")}}',
                       type:'POST',
                        data:frmData,
                    success:function(data){
                    $('#catlist').empty().append(data);
                    $('#addcategory').modal('hide'); 
                    },
                    error:function(error){
                    var error=error.responseJSON;
                    $("#modals #errors").empty();
                    error.errors.title.forEach(function(element,index){
                        $("#modals #errors").append('<li class="alert alert-danger">'+element+'</li>');
                    });   
                   },
                   });
                   });
               
               
               $("#modals").on('click',"#btnDelete",function(){
                   var id=$(this).attr('data-task');
                   $.get('{{URL::to("categories/delete")}}/'+id,function(data){
                    $('#catlist').empty().append(data);
                    $('#addcategory').modal('hide'); 
                 });
                    event.preventDefault();
               });
               
               
                 $('#modals').on('submit','#frmaeditcat',function(e){
                   e.preventDefault();
                   var frmData=$(this).serialize();
                   $.post('{{URL::to("categories/update")}}',frmData,function(data,xhrStatus,xhr){
                       $('#catlist').empty().append(data);
                       $('#editcategory').modal('hide'); 
                   });
               });
               /*$('#catlist').on('click','.pagination a',function(e){
                   e.preventDefault();
                   var url=$(this).attr('href');
                     $.get(url,function(data){
                  $('#catlist').empty().append(data);
                   
               });
               });*/
             /*  $('#catlist').on('keyup',"#searchCat",function(){
          $(this).autocomplete({
            source: "{{URL::to('categories/search/')}}"
             });
               
        });   */    
               });
          
          
          
        
        </script>
        
    </body>
</html>