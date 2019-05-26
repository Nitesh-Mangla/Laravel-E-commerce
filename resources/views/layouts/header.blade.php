     <script src="{{ asset('js/jquery.js') }}" defer></script>
      <script src="{{ asset('js/ajax.js') }}" defer></script>
      <script src="{{ asset('js/app.js') }}" defer></script>
      <script src="{{ asset('js/paypalCheckout.js') }}" defer></script>
     <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <li><a href="#"><i class="fa fa-user"></i> My Account</a></li>
                            <li><a href="#"><i class="fa fa-heart"></i> Wishlist</a></li>
                            <li><a href="{{url('card')}}"><i class="fa fa-user"></i> My Cart</a></li>
                            @if(Auth::check())
                            <li><a href="{{url('checkout')}}"><i class="fa fa-user"></i> Checkout</a></li>
                            @endif
                            @guest
                            <li><a href="{{url('login')}}"><i class="fa fa-user"></i> Login</a></li>
                            @endguest
                             @auth
                            <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                       
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  
                                     <a class="dropdown-item" href="{{ route('userProfile') }}">Profile
                                    </a>  
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

                       
                    </ul>
                     @endauth   
                        </ul>
                    </div>
                </div>
                
               
            </div>
        </div>
    </div> 