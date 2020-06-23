
          <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <main class="py-4">
            <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View All Tags <span class="btn btn-success btn-xs pull-right" id="btnAddTag"><i class="fa fa-plus"></i></span></div>
                <div class="card-body">
                 <table class="table">
                 <thead>
                    <tr>
                     <th>
                         Tags 
                     </th>
                     <th>
                         Created_at
                     </th>
                     <th>
                         Functionality
                     </th>
                     <tr>
                 </thead>
                      <tbody>
                      @foreach($tag as $t)
                      <tr>
                          <td>{{$t->name}}</td>
                      
                          <td>{{$t->created_at->diffForHumans()}}</td>
                          <td>
                              <button class="btn btn-xs btn-primary" data-task="{{$t->id}}" id="btn-func"><i class="fa fa-plus-circle"></i></button>
                          </td>
                          </tr>
                        @endforeach
                     </tbody>
                  </table>
                 
                </div>
                 
            </div>
            
        </div>
    </div>
</div>
        </main>
    </div>