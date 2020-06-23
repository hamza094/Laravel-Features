$(function(){
    $(".subcribed").mouseover(function(){
       $(".subcribed").html('UnSubscribe');
         $(".subcribed").addClass('badge-danger');
        $(".subcribed").removeClass('badge-success');
    });
    
    $(".subcribed").mouseleave(function(){
       $(".subcribed").html('Subscribed'); 
         $(".subcribed").addClass('badge-success');
        $(".subcribed").removeClass('badge-danger');
    });
    
    
     $('[data-toggle="tooltip"]').tooltip(); 
    
     $('#handleCounter').handleCounter();
    
 
    
    });


  $(document).ready(function(){
     setTimeout(function() {
       if(sessionStorage.getItem('#subscribeModal')!=='true'){
            $('#subscribeModal').modal('show');
            sessionStorage.setItem("#subscribeModal",'true');  
        }  
     },1500)
      
  });

$('.input-incr').attr('disabled', 'disabled');

$('.nav-tabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})




