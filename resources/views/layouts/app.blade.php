<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
     
     <meta name="description" content="Laravel Portfolio WebApp with laravel features included while using html5,css3,Jquery & bootstrap framwork">
    <meta name="keyword" content="Laravel, WebApp, ThirdParty, Bootstrap, Web Development, Backend Development, Ecommerce">

     <title>Laravel Features | App for future</title>
    
   
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
<!-- Styles -->
   
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
 
     <link rel="stylesheet" href="{{asset('css/iziToast.min.css')}}">   
     
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
     <link rel="shortcut icon" type="image/png" href="{{asset('img/image.png')}}">
   

    <!-- Styles -->
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel Features 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                   
                                    <a class="dropdown-item" href="{{ route('users.show',['id'=>Auth::user()->id]) }}">
                                    <img src="{{Auth::user()->img}}" alt="" width="15px" height="15px">  Profile
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('users.edit',['id'=>Auth::user()->id]) }}">
                                     <i class="fa fa-cogs" aria-hidden="true"></i> Settings
                                    </a>
                                   
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}
                                    </a>
                                    
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
            <br><br>
                   <div class="container">
         @if($errors->count()>0)
           <ul class="list-group-item">
             @foreach($errors->all() as $error)
            <li class="list-group-item text-danger">
                {{$error}}
            </li>
             @endforeach
          </ul>
    
    @endif
        </div>
          <br><br>
           <div class="container">
        <div class="row">
        @if(Auth::user() && Auth::user()->admin==1)
         <div class="col-md-4">
          <a href="/home" class="btn btn-success btn-block"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a>
          <ul class="list-group">
              <a href="{{route('users.index')}}"><li class="list-group-item list-group-item-action"><i class="fa fa-users" aria-hidden="true"></i> Users</li></a>
               <a href="/category"><li class="list-group-item list-group-item-action"> <i class="fa fa-clipboard" aria-hidden="true"></i> Categories</li></a>
               <a href="/tag"><li class="list-group-item list-group-item-action"> <i class="fa fa-file-code-o" aria-hidden="true"></i> Tags</li></a>
               <div class="btn-group">
  <button type="button" class="btn btn-secondary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-list" aria-hidden="true"></i> Articles
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item " href="{{route('articles.index')}}">View All Articles</a>
    <a class="dropdown-item" href="{{route('articles.create')}}">Add Article</a>
    <a class="dropdown-item" href="{{route('trash.view')}}">Trashed Articles</a>
    </div>
</div>
          <hr>
                         <div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-shopping-bag" aria-hidden="true"></i> Product & Orders
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item " href="{{route('products.index')}}">View All Products</a>
    <a class="dropdown-item" href="{{route('products.create')}}">Add Product</a>
    <a class="dropdown-item" href="{{route('order')}}">All Orders</a>
    </div>
</div>
          
           </ul>
          </div>
          
           <div class="col-md-8">
               @yield('content')
           </div>
           @else
           <div class="col-md-2">
               
           </div>
           <div class="col-md-8">
               @yield('content')
           </div>
           @endif
       </div> 
           </div>
     
               
    </div>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
       <script src="{{asset('js/iziToast.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
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
</body>
</html>
