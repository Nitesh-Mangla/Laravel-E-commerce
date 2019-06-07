@extends('welcome')

@push('css')
@include( 'layouts.resource' )
@endpush

@section('header')
@include('layouts.header')
@endsection

@section('body')
 <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="./">Mangla Store</a></h1>
                    </div>
                </div>
                
            
            </div>
        </div>
    </div> <!-- End site branding area -->
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"><a href="{{url('shop')}}">Shop page</a></li>
                        <li><a href="{{ url('card') }}">Cart</a></li>
                        @auth
                        <li><a href="{{url('checkout')}}">Checkout</a></li>
                        @endauth
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Others</a></li>
                        <li><a href="{{url('contact')}}">Contact</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    
   
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                @if(isset($products))
                    @for($i=0; $i<$size; $i++)
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="img/{{$products[$i]->image}}" alt="">
                        </div>
                        <h2><a href="">{{$products[$i]->product_name}}</a></h2>
                        <div class="product-carousel-price">
                            <ins>${{$products[$i]->price}}</ins> <del>${{$products[$i]->discount}}</del>
                        </div>  
                        
                        <div class="product-option-shop">
                            <a href="{{ url('card') }}?id={{ $products[$i]->id }}" class="add_to_cart_button"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                            <!-- <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a> -->
                        </div>                       
                    </div>
                </div>
                @endfor
                @endif
               
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">
                        <nav>
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')
@include('layouts.footer')
@endsection

