<style>
    .hada:hover {
        background-color:  #DF7857   ;
        border-radius: 10px;
        color: #fff
    }
    a {
  text-decoration: none;
}

  </style>
  
<div class="main-navbar shadow-sm sticky-top">
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                    <a href="{{url('/')}}" class="brand-name my-2 h2 "><i class="fas fa-shopping-basket"></i> Your Market</a>
                </div>
                <div class="col-md-4 my-auto">
                    <form action="{{url('search')}}" method="GET" role="search">
                        <div class="input-group">
                            <input type="search" name="search" value="{{ Request::get('search')}}" placeholder="Search your product" class="form-control" />
                            <button class="btn bg-white" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 my-auto">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            
                            <a class="nav-link" href="{{ url('/') }}">
                                {{-- <i class="fa fa-home"> --}}
                                <i class="fa fa-home menu-icon"></i>
                                    
                                    Home
                                </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('cart')}}">
                                <i class="fa fa-shopping-cart"></i> Cart (<livewire:frontend.cart.cart-count />)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('wishlist')}}">
                                <i class="fa fa-heart"></i> Wishlist (<livewire:frontend.wishlist-count />)
                            </a>
                        </li>
                        
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user"></i>  {{ Auth::user()->name }} 
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{url('profile')}}"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-list"></i> My Orders</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-heart"></i> My Wishlist</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </a>
                                </li>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="#"><i class="fas fa-shopping-basket"></i>  Your Market</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ url('/collections') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            All Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                           
                            @php
                                $categories = \App\Models\Category::where('status','0')->get();
                            @endphp
                            @if( $categories->count() > 0)
                                @foreach ($categories as $category )
                                    <li><a class="dropdown-item hada" style="height: 45px;display: flex; align-items: center;justify-content: center;" href="{{url('/collections/'.$category->slug)}}">{{$category->name_category}}</a></li>
                                @endforeach
                            @else
                                <li><a class="dropdown-item" href="#"> No Data Found</a></li>
                            @endif
                            
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tranding">Tranding Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#allproducts">All Products</a>
                    </li> --}}
                </ul> 
            </div>
        </div>
    {{-- </nav> --}} 
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



